<?php
	/*      mcontent.php - this file is part of Micro CMS
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
	lloader_load('array');
	lloader_load('image');
	lloader_load_conf('content');
	lloader_load_model('categories');

	/* Cleans input post data (arrat) from unwanted keys
	 * <param> <array> post_data - post data in associative array
	 * <return> <array> - returns array with result
	 */
	function mcontent_clean_data($post_data)
	{
		$fields = array('link', 'name', 'body', 'updated', 'time', 'time_published', 'author', 'description', 'keywords', 'published');

		return larray_clean($post_data, $fields);
	}

	/* Reads one entry from content table (depending on selected language)
	 * <param> <string/integer> content - link or id
	 * <return> <array> - returns array with result or false on error
	 */
	function mcontent_read($content)
	{
		$table = llang_table('content');
		$result = lcrud_read_simple($table, $content);
		if ($result) $result['body'] = lstring_replace($result['body'], '*URL*', hanchor_shref());
		return $result;
	}

	/* Reads array containing entries from content table
	 * (depending on selected language)
	 * <param> <string/integer> item - parent link or id
	 * <param> <boolean> published_only - true to return only published
	 * <return> <array> - returns array with result or false on error
	 */
	function mcontent_read_group($item, $published_only = true)
	{
		$content = array();
		$category = mcategories_read_group($item, $published_only);

		for ($i = 0; $i < count($category); $i++)
		{
			$cont = mcontent_read($category[$i]['link']);
			if ($published_only && time() > strtotime($cont['time'])) array_push($content, $cont);
			else if (!$published_only) array_push($content, $cont);
		}

		return $content;
	}

	/* Reads children of some content depending on categories
	 * <param> <string/integer> parent_item - parent item link or id
	 * <return> <array> - returns array with result
	 */
	function mcontent_read_children($parent_item)
	{
		$cats = mcategories_read_children($parent_item);
		$content = array();

		foreach ($cats as $cat)
		{
			$cont = mcategories_get_content($cat['link']);
			if ($cont) array_push($content, $cont);
		}

		return $content;
	}

	/* Reads all content ordered by id and returns array
	 * <return> <array> - returns array containing categories
	 */
	function mcontent_read_all()
	{
		$table = llang_table('content');
		$custom = 'ORDER by `id`';

		return lcrud_read($table, false, $custom);
	}

	/* Reads all content ordered by orderid
	 * <return> <array> - returns array containing categories
	 */
	function mcontent_read_all_ordered($published_only = true)
	{
		$content = mcontent_read_all();
		$cats = mcategories_read_all_ordered($published_only);
		$new_content = array();

		foreach($cats as $cat)
		{
			foreach($content as $cont)
			{
				if ($cat['link'] == $cont['link']) array_push($new_content, $cont);
			}
		}

		return $new_content;
	}

	/* Updates content
	 * <param> <string/integer> - id or link of content entry
	 * <param> <array> data - array containing data
	 * <return> <boolean> - returns true on success, false on error
	 */
	function mcontent_update($content, $data)
	{
		$data = mcontent_clean_data($data);
		$data = linput_post_checkbox($data, 'published');

		$table = llang_table('content');
		$content = mcontent_read($content);

		if ($data['link'] != $content['link']) limage_update_many(lconf_get('content', 'images'), $content['link'], $data['link']);

		return lcrud_update_simple($table, $content['id'], $data);
	}

	/* Reads category belonging to content
	 * <param> <string/integer> content - id or link of content entry
	 * <return> <array> - returns array containing category
	 */
	function mcontent_get_cat($content)
	{
		$content = mcontent_read($content);
		$cat = mcategories_read($content['link']);
		return $cat;
	}

	/* Deletes content entry
	 * <param> <string/integer> content - id or link of content entry
	 * <return> <boolean> - returns true on success, false on error
	 */
	function mcontent_delete($content)
	{
		$table = llang_table('content');
		$content = mcontent_read($content);

		limage_delete_many(lconf_get('content', 'images'), $content['link']);

		return lcrud_delete_simple($table, $content['id']);
	}

	/* Creates content entry
	 * <param> <array> data - array containing data
	 * <return> <boolean> - returns true on success, false on error
	 */
	function mcontent_create($data)
	{
		$data = mcontent_clean_data($data);
		$table = llang_table('content');

		$data['time_published'] = date('Y-m-d H:i:s', time());
		$data['author'] = lusers_get_cookie_id();

		return lcrud_create($table, $data);
	}
?>