<?php
	/*      hcontent.php - this file is part of Micro CMS
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

	lloader_load_model("content");
	lloader_load_model("categories");
	lloader_load_model("settings");

	/* Gets content for some item (link)
	 * <param> <string> item - item to get content for
	 * <return> <array> - content data array
	 */
	function hcontent_get_content($item)
	{
		if (!strlen($item)) $item = lconf_dbget("default_uri");
		$item_array = luri_split($item);
		$content = mcontent_read($item_array[count($item_array) - 1]);
		$cat = mcategories_read($item_array[count($item_array) - 1]);

		if ($content)
		{
			$path = mcategories_read_path($item_array[count($item_array) - 1], false);
			if ($path == $item)
			{
				$content["title"] = lconf_dbget("title") . " / " . $content["name"];
				$content["item"] = $item;
				$content["content"] = true;
				return array_merge($content, $cat);
			}
		}

		if ($cat)
		{

			$cat["title"] = lconf_dbget("title") . " / " . $cat["name"];
			$cat["content"] = false;
			return $cat;
		}

		return array("content" => false);
	}

	/* Gets content group for some item (link)
	 * <param> <string> item - item to get content for
	 * <return> <array> - content data array
	 */
	function hcontent_get_cat($item)
	{
		if (!strlen($item)) $item = lconf_dbget("default_uri");
		$item_array = luri_split($item);
		$content["content"] = mcontent_read_group($item_array[count($item_array) - 1]);

		for ($i = 0; $i < count($content["content"]); $i++)
		{
			$content["content"][$i]["title"] = $content["content"][$i]["name"];
			if (isset($content["content"][$i]["link"])) $content["content"][$i]["link"] = mcategories_read_path($content["content"][$i]["link"], false);
		}

		if ($content["content"])
		{
			$content["cat"] = true;
			$cat = mcategories_read($item_array[count($item_array) - 1]);
			$cat["title"] = lconf_dbget("title") . " / " . $cat["name"];
			return array_merge($content, $cat);
		}

		return array("cat" => false);
	}
?>
