<?php
	/*      mcategories.php - this file is part of Micro CMS
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

	lloader_load('crud');
	lloader_load_model('content');

	/* Cleans input post data (arrat) from unwanted keys
	 * <param> <array> post_data - post data in associative array
	 * <return> <array> - returns array with result
	 */
	function mcategories_clean_data($post_data)
	{
		$fields = array('link', 'name', 'url', 'published', 'orderid', 'parentid');

		return larray_clean($post_data, $fields);
	}

	/* Reads one entry from categories table (depending on selected language)
	 * <param> <string/integer> cat - link or id
	 * <return> <array> - returns array with result or false on error
	 */
	function mcategories_read($cat)
	{
		$table = llang_table('categories');
		$custom = 'ORDER BY `orderid`';

		return lcrud_read_simple($table, $cat, $custom);
	}

	/* Reads array containing entries from categories table
	 * (depending on selected language)
	 * <param> <string/integer> parent - parent link or id
	 * <param> <boolean> published_only - true to return only published
	 * <return> <array> - returns array with result or false on error
	 */
	function mcategories_read_group($parent, $published_only = true)
	{
		$table = llang_table('categories');

		if (is_numeric($parent))
		{
			$where = array('parentid' => $parent);
			if ($published_only) $where['published'] = 1;
			return lcrud_read($table, $where, 'ORDER BY `orderid`');
		}
		else
		{
			$cat = mcategories_read($parent);
			if ($cat)
			{
				$where = array('parentid' => $cat['id']);
				if ($published_only) $where['published'] = 1;
				return lcrud_read($table, $where, 'ORDER BY `orderid`');
			}
			else return array();
		}
	}

	/* Reads path joined from links (category itself and all of its parents)
	 * <param> <string/integer> item - category id or link
	 * <param> <boolean> slash - put trailing slash or not
	 * <return> <string> - returns path as string
	 */
	function mcategories_read_path($item, $slash = true)
	{
		$cat = mcategories_read($item);

		$path = '';

		while ($cat)
		{
			if ($cat['parentid'] != 0 || mcontent_read($cat['link'])) $path = $cat['link'] . '/' . $path;
			$cat = mcategories_read($cat['parentid']);
		}

		if (!$slash) $path = substr_replace($path, '', -1);

		return $path;
	}

	/* Reads children of some category
	 * <param> <string/integer> parent_item - parent item link or id
	 * <param> <array> categories - array of categories to add children to (defaults to empty array)
	 * <return> <array> - returns array with result
	 */
	function mcategories_read_children($parent_item, $categories = array())
	{
		$item = mcategories_read($parent_item);
		$children = mcategories_read_group($item['id']);

		foreach($children as $child)
		{
			array_push($categories, $child);
			$categories = mcategories_read_children($child['id'], $categories);
		}

		return $categories;
	}

	/* Reads all categories ordered by id and returns array
	 * <return> <array> - returns array containing categories
	 */
	function mcategories_read_all()
	{
		return lcrud_read(lconf_get('lang') . '_categories', '', 'ORDER BY `id`');
	}

	/* Reads all categories ordered by orderid and parentid and returns array
	 * <return> <array> - returns array containing categories
	 */
	function mcategories_read_all_ordered($published_only = true)
	{
		$cats = array();
		$cat = null;
		$cats_temp = mcategories_read_group(0);
		$count = count(mcategories_read_all());
		$unfinished = array();

		while (count($cats_temp))
		{
			$cat = array_shift($cats_temp);
			array_push($cats, $cat);
			$ct = mcategories_read_group($cat['id'], $published_only);
			if (count($ct))
			{
				if (count($cats_temp)) array_push($unfinished, $cats_temp);
				$cats_temp = $ct;
			}
			else if (count($cats_temp)) continue;
			else if (count($unfinished)) $cats_temp = array_pop($unfinished);
			else $cats_temp = array();
		}

		return $cats;
	}

	/* Checks if some category is in some parent's path
	 * <param> <integer> id_to_check - id of a category to check
	 * <param> <integer> parent_id - id of a parent category
	 * <return> <boolean> - returns true if parent_id is direct or indirect parent of id
	 */
	function mcategories_check_parent($id, $parent_id)
	{
		$ids = '';
		while ($id != 0)
		{
			if ($id == $parent_id) return true;
			$cat = mcategories_read($id);
			$ids .= $cat['parentid'] . ' ';
			$id = $cat['parentid'];
		}
		return false;
	}

	/* Updates category
	 * <param> <string/integer> - id or link of category entry
	 * <param> <array> data - array containing data
	 * <return> <boolean> - returns true on success, false on error
	 */
	function mcategories_update($cat, $data)
	{
		$table = llang_table('categories');
		$data = linput_post_checkbox($data, 'published');
		$data = mcategories_clean_data($data);
		return lcrud_update_simple($table, $cat, $data);
	}

	/* Reads content belonging to category
	 * <param> <string/integer> - id or link of category entry
	 * <return> <array> - returns array containing content
	 */
	function mcategories_get_content($cat)
	{
		$cat = mcategories_read($cat);
		$content = mcontent_read($cat['link']);
		return $content;
	}

	/* Deletes category entry
	 * <param> <string/integer> - id or link of category entry
	 * <return> <boolean> - returns true on success, false on error
	 */
	function mcategories_delete($cat)
	{
		$table = llang_table('categories');
		return lcrud_delete_simple($table, $cat);
	}

	/* Creates category entry
	 * <param> <array> data - array containing data
	 * <return> <boolean> - returns true on success, false on error
	 */
	function mcategories_create($data)
	{
		$table = llang_table('categories');
		$data = linput_post_checkbox($data, 'published');
		$data = mcategories_clean_data($data);
		return lcrud_create($table, $data);
	}
?>
