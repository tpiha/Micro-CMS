<?php
	/*      hbreadcrumbs.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2007-PRESENT Micro CMS
	 * 
	 * 	Authors:
	 * 		- Tihomir Piha <tpiha@kset.org>
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

	lloader_load_model("categories");

	/* Returns breadcrumbs html
	 * <return> <string> - html for breadcrumbs
	 */
	function hbreadcrumbs()
	{
		$uri = luri_get();
		$html = "";

		$cat = lconf_dbget("default_uri");
		$cat = mcategories_read($cat);
		$html = $cat["name"];

		if (strlen($uri[0]))
		{
			$html = '<a href="' . hanchor_shref() . '">' . $html . '</a>';

			for($i = 0; $i < count($uri); $i++)
			{
				$cat = mcategories_read($uri[$i]);
				if ($i < count($uri) - 1 && $cat) $html .= ' &gt; <a href="' . hanchor_href("main/index/content", mcategories_read_path($uri[$i], false)) . '">' . $cat["name"] . '</a>';
				else if ($cat) $html .= ' &gt; <span>' . $cat["name"] . '</span>';
			}
		}
		else $html = '<span>' . $html . '</span>';

		return $html;
	}

	/* Returns admin breadcrumbs html
	 * <return> <string> - html for admin breadcrumbs
	 */
	function hbreadcrumbs_admin()
	{
		$names = array("admin" => l("Admin"), "configuration" => l("Configuration"), "settings" => l("Settings"), "profile" => l("Profile"), "publishing" => l("Publishing"), "categories" => l("Categories"), "content" => l("Content"), "login" => l("Login"), "galleries" => l("Galleries"));
		$links = array("admin" => hanchor_href("main/user/admin/admin"), "configuration" => hanchor_href("main/user/admin/configuration"), "settings" => hanchor_href("main/user/admin/settings"), "profile" => hanchor_href("main/user/admin/profile"), "publishing" => hanchor_href("main/user/admin/publishing"), "categories" => hanchor_href("main/user/admin/categories"), "content" => hanchor_href("main/user/admin/content"), "login" => hanchor_href("main/index/admin/login"), "galleries" => hanchor_href("main/user/admin/galleries"));
		$uri = luri_get();
		$html = "";

		if (count($uri) == 1) $html = '<span>' . $names[$uri[0]] . '</span>';
		else
		{
			for ($i = 0; $i <= 2; $i++)
			{
				if (isset($uri[$i + 1]) && $i != 2) $html .= '<a href="' . $links[$uri[$i]] . '">' . $names[$uri[$i]] . '</a> &gt; ';
				else if (isset($uri[$i + 1])) $html .= '<a href="' . $links[$uri[$i]] . '">' . $names[$uri[$i]] . '</a>';
				else if (isset($uri[$i])) $html .= '<span>' . $names[$uri[$i]] . '</span>';
			}
		}

		return $html;
	}
?>
