<?php
	/*      lerror.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2008 Micro CMS
	 * 
	 * 	Authors:
	 * 		- Tihomir Piha <tpiha@kset.org>
	 * 		- Nikola Dušak <vampyr@kset.org>
	 *      
	 *      This program is free software; you can redistribute it and/or modify
	 *      it under the terms of the GNU Lesser General Public License as published by
	 *      the Free Software Foundation; either version 2 of the License, or
	 *      (at your option) any later version.
	 *      
	 *      This program is distributed in the hope that it will be useful,
	 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *      GNU Lesser General Public License for more details.
	 *      
	 *      You should have received a copy of the GNU Lesser General Public License
	 *      along with this program; if not, write to the Free Software
	 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
	 *      MA 02110-1301, USA.
	 *
	 *      Original license: http://www.gnu.org/licenses/lgpl.html
	 */

	lloader_load("conf");
	lloader_load("uri");
	lloader_load("route");

	/* Generates HTML anchor
	 * <param> <string> uri - uri string
	 * <param> <string> text - text of the HTML link
	 * <param> <array> attributes - array containing HTML attributes name/value
	 * <return> <string> - returns HTML anchor string
	 */
	function hanchor($uri, $text, $attributes = false)
	{
		$a_uri = hanchor_href($uri);
		
		$attributes_string = "";
		
		foreach ($attributes as $name => $value)
		{
			if ($name != "class" && $name != "class_active") $attributes_string .= ' ' . $name . '="' . $value . '"';
		}
		
		$class_attributes = "";

		if (isset($attributes["class"])) $class_attributes = ' class="' . $attributes["class"] . '"';
		if (isset($attributes["class_active"]) && isset($attributes["class"])) $class_attributes = ' class="' . hanchor_class($uri, $attributes["class"], $attributes["class_active"]) . '"';
		
		$attributes_string .= $class_attributes;
		
		return '<a href="' . $a_uri . '"' . $attributes_string . '>' . $text . '</a>';
	}

	/* Generates an absolute uri from a relative one (stupid hanchor_href)
	 * <param> <string> uri - uri string
	 * <return> <string> - returns absolute uri string
	 */
	function hanchor_shref($uri = "", $slash = true)
	{
		if (stripos($uri, "javascript:") !== false) return $uri;
		$uri_href = lconf_get("url");
		if (strlen($uri))
		{
			$uri_href .= $uri;
			if ($slash) $uri_href .= "/";
		}
		return $uri_href;
	}

	/* Generates an absolute uri from controller path
	 * <param> <string> <path> - path to the controller function
	 * <return> <string> - uri string
	 */
	function hanchor_href($path, $item = "", $slash = true)
	{
		$uri = lroute_get_uri($path);
		if (strlen($item))
		{
			if (strlen($uri)) return hanchor_shref($uri . "/" . $item, $slash);
			else
			{
				if ($item == lconf_dbget("default_uri")) return hanchor_shref();
				else return hanchor_shref($item, $slash);
			}
		}
		else return hanchor_shref(lroute_get_uri($path), $slash);
	}

	/* Returns active CSS class if consistent with the current link, else returns inactive CSS class
	 * <param> <string> link - string containing anchor link
	 * <param> <string> inactive_class - string containing inactive link class name
	 * <param> <string> active_class - string containing active link class name
	 * <return> <string> - returns active link class name if link is active, else returns inactive link class name
	 */
	function hanchor_class($link, $inactive_class, $active_class, $item = "")
	{
		$uri = luri_get(true);
		$link = lroute_get_uri($link);
		if (strlen($item) && strlen($link)) $link .= "/" . $item;
		else if (strlen($item)) $link .= $item;

		if ($uri)
		{
			if ($uri == $link) return $active_class;
			else if (stripos($uri, $link) !== false) return $active_class;
			else return $inactive_class;
		}
		else if ($item == lconf_dbget("default_uri")) return $active_class;
		else return $inactive_class;
	}

	/* Generates an absolute path for relative in some theme (view)
	 * <param> <string> <path> - path to the file
	 * <return> <string> - absolute path
	 */
	function hanchor_theme($path)
	{
		$theme = lconf_get("theme");
		return hanchor_shref("views/" . $theme . "/" . $path, false);
	}
?>
