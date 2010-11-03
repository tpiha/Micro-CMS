<?php
	/*      hcategories.php - this file is part of Micro CMS
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
	lloader_load_helper("menu");

	/* Reads some menu (categories)
	 * <param> <string> item - categories parent link
	 * <param> <integer> top_parent - top parent for the menu
	 * <return> <array> - menu array
	 */
	function hcategories_menu($item, $top_parent)
	{
		$items = mcategories_read_group($item, true);
		$cat = mcategories_read($top_parent);
		$data = null;

		if (count($items) && mcategories_check_parent($items[0]["id"], $top_parent)) $data = $items;
		else
		{
			$item = luri_split($item);

			for ($i = count($item) - 1; $i >= 0; $i--)
			{
				$items = mcategories_read_group($item[$i], true);
				if (count($items) && mcategories_check_parent($items[0]["id"], $top_parent) && !isset($data)) $data = $items;
			}

			if (!isset($data))
			{
				$items = mcategories_read_group($top_parent, true);
				$data = $items;
			}
		}

		for ($i = 0; $i < count($data); $i++)
		{
			$path = mcategories_read_path($data[$i]["link"], false);
			$data[$i]["link"] = $path;
		}

		return $data;
	}

	/* Checks if category is first in its group
	 * <param> <array> cat - category array
	 * <param> <array> cats - array of ordered categories
	 * <return> <boolean> - true if it is first, else false
	 */
	function hcategories_is_first($cat, $cats)
	{
		$parentid = $cat["parentid"];

		for($i = 0; $i < count($cats); $i++)
		{
			if ($cats[$i] == $cat && isset($cats[$i - 1]) && $cat["parentid"] == $cats[$i - 1]["id"]) return true;
			else if ($cats[$i]["parentid"] == $parentid) return false;
		}
		return false;
	}

	/* Checks if category is last in its group
	 * <param> <array> cat - category array
	 * <param> <array> cats - array of ordered categories
	 * <return> <boolean> - true if it is last, else false
	 */
	function hcategories_is_last($cat, $cats)
	{
		$parentid = $cat["parentid"];
		$last = false;

		for($i = 0; $i < count($cats); $i++)
		{
			if ($cats[$i] == $cat && (!isset($cats[$i + 1]) || $cats[$i + 1]["parentid"] != $parentid)) $last = true;
			else if ($last && $cats[$i]["parentid"] == $parentid) $last = false;
		}

		return $last;
	}

	function hcategories_sitemap($cats, $cat)
	{
		$html = '<ul>';
		$new_cats = array();
		$start = false;

		for ($i = 0; $i < count($cats); $i++)
		{
			if ($cats[$i]["parentid"] == $cat["id"] && isset($cats[$i + 1]) && $cats[$i + 1]["parentid"] != $cats[$i]["id"]) $html .= '<li><a href="' . hmenu_href("main/index/content", $cats[$i]["link"], @$cats[$i]["url"]) . '">' . $cats[$i]["name"] . '</a></li>';
			else if ($cats[$i]["parentid"] == $cat["id"]) $html .= '<li><a href="' . hmenu_href("main/index/content", $cats[$i]["link"], @$cats[$i]["url"]) . '">' . $cats[$i]["name"] . '</a>' . hcategories_sitemap($cats, $cats[$i]) . '</li>';
		}

		$html .= '</ul>';
		return $html;
	}
?>
