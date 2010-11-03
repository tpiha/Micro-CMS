<?php
	/*      mgalleries.php - this file is part of Micro CMS
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
	lloader_load('file');

	/* Cleans input post data (arrat) from unwanted keys
	 * <param> <array> post_data - post data in associative array
	 * <return> <array> - returns array with result
	 */
	function mgalleries_clean_data($post_data)
	{
		$fields = array('link', 'name', 'description', 'keywords');

		return larray_clean($post_data, $fields);
	}

	/* Reads all entries from galleries table (depending on selected language)
	 * <return> <array> - returns array with result or false on error
	 */
	function mgalleries_read_all()
	{
		$table = llang_table('galleries');
		return lcrud_read($table, false, 'ORDER BY id');
	}

	/* Reads gallery from database
	 * <param> <array> item - gallery id or link
	 * <return> <array> - returns array with result
	 */
	function mgalleries_read($item)
	{
		$table = llang_table('galleries');
		return lcrud_read_simple($table, $item);
	}

	/* Reads gallery images from database
	 * <param> <array> gallery - gallery id or link
	 * <return> <array> - returns array with result
	 */
	function mgalleries_read_images($gallery)
	{
		$table = llang_table('galleries');
		$table_images = llang_table('images');
		$gallery = lcrud_read_simple($table, $gallery);
		return lcrud_read($table_images, array('gallery_id' => $gallery['id']), 'ORDER BY `orderid');
	}

	function mgalleries_read_images_page($gallery, $page)
	{
		$table = llang_table('galleries');
		$table_images = llang_table('images');
		$gallery = lcrud_read_simple($table, $gallery);
		return lcrud_read_page($table_images, $page, 9, array('gallery_id' => $gallery['id']), 'orderid');
	}

	/* Updates gallery in database and filesystem
	 * <param> <integer/string> item - gallery id or link (old link)
	 * <param> <array> data - array with gallery data
	 */
	function mgalleries_update($item, $data)
	{
		$table = llang_table('galleries');
		$data = mgalleries_clean_data($data);
		$gallery = mgalleries_read($item);

		if ($data['link'] != $gallery['link']) lfile_move('data/galleries/' . $gallery['link'], 'data/galleries/' . $data['link']);

		return lcrud_update_simple($table, $item, $data);
	}

	/* Updates gallery in database and filesystem
	 * <param> <integer/string> item - gallery id or link (old link)
	 * <param> <array> data - array with gallery data
	 */
	function mgalleries_create($data)
	{
		$table = llang_table('galleries');
		$data = mgalleries_clean_data($data);

		lfile_create_dir('data/galleries/' . $data['link'] . '/');

		return lcrud_create($table, $data);
	}

	/* Deletes gallery from database and filesystem
	 * <param> <integer/string> item - gallery id or link (old link)
	 */
	function mgalleries_delete($item)
	{
		$images = mgalleries_read_images($item);
		$gallery = mgalleries_read($item);
		$images_table = llang_table('images');
		$galleries_table = llang_table('galleries');

		foreach($images as $image)
		{
			lfile_delete('data/galleries/' . $gallery['link'] . '.' . $image['link'] . '.jpg');
			lfile_delete('data/galleries/' . $gallery['link'] . '.' . $image['link'] . '_thumb.jpg');
			lfile_delete('data/galleries/' . $gallery['link'] . '.' . $image['link'] . '_real.jpg');
		}

		lfile_delete_dir('data/galleries/' . $gallery['link'] . '/');

		lcrud_delete($images_table, array('gallery_id' => $gallery['id']));
		lcrud_delete($galleries_table, array('id' => $gallery['id']));
	}

	function mgalleries_count_images($gallery)
	{
		$images = mgalleries_read_images($gallery);
		return count($images);
	}
?>