<?php
	/*      cgalleries.php - this file is part of Micro CMS
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

	lloader_load('input');
	lloader_load('image');
	lloader_load('users');
	lloader_load_helper('form');
	lloader_load_model('galleries');
	lloader_load_model('categories');


	/* Handles gallery creating
	 */
	function cgalleries_create()
	{
		lusers_require('galleries/create');
		$post_data = linput_post();

		if (hform_validate(array('name', 'link', 'parentid')))
		{
			$table = llang_table('galleries');
			$table_category = llang_table('categories');

			$post_data = linput_post_checkbox($post_data, 'published');

			if (mgalleries_create($post_data) && mcategories_create($post_data))
			{
				$gallery = mgalleries_read($post_data['link']);
				luri_redirect('main/user_item/admin/galleries_update', l('Gallery successfully created.'), $gallery['id']);
			}
			else luri_redirect('main/user/admin/galleries_create', l('Gallery or category with same link already exists.'));
		}
		else luri_redirect('main/user/admin/galleries_create', l('Fields marked with * are neccessary.'));
	}

	/* Handles gallery update
	 */
	function cgalleries_update()
	{
		lusers_require('galleries/update');
		$post_data = linput_post();

		if (hform_validate(array('name', 'link', 'parentid')))
		{
			$table = llang_table('galleries');
			$table_category = llang_table('categories');

			$gallery_id = $post_data['id'];
			$gallery = mgalleries_read($gallery_id);

			$post_data = linput_post_checkbox($post_data, 'published');

			if (mgalleries_update($gallery_id, $post_data) && mcategories_update($gallery['link'], $post_data)) luri_redirect('main/user/admin/galleries', l('Gallery successfully updated.'));
			else luri_redirect('main/user_item/admin/galleries_update', l('Gallery with same link is already existing.'), $gallery['id']);
		}
		else
		{
			$gallery = mgalleries_read($post_data['id']);
			luri_redirect('main/user_item/admin/galleries_update', l('All fields marked with * are required.'), $gallery['id']);
		}
	}

	/* Handles gallery deleting
	 */
	function cgalleries_delete($item)
	{
		lusers_require('galleries/delete');
		$gallery = mgalleries_read($item);

		mgalleries_delete($item);
		mcategories_delete($gallery['link']);

		luri_redirect('main/user/admin/galleries', l('Gallery successfully deleted.'));
	}

	/* Handles gallery images listing (ajax)
	 */
	function cgalleries_images($item)
	{
		$gallery = mgalleries_read($item);
		$data['images'] = mgalleries_read_images($gallery['id']);
		$data['gal'] = $gallery;
		lloader_load_view('admin/subs/gallery_images', $data);
	}

	/* Handles gallery images reordering
	 */
	function cgalleries_order()
	{
		lusers_require('galleries/order');

		$post_data = linput_post();
		$order = $post_data['order'];

		$order = split('\|', $order);

		for ($i = 0; $i < count($order); $i++)
		{
			lcrud_update(lconf_get('lang') . '_images', array('id' => $order[$i]), array('orderid' => $i));
		}

		lcache_delete_all();
	}

	/* Handles gallery image update
	 */
	function cgalleries_image_update()
	{
		lusers_require('galleries/image_update');
		$post_data = linput_post();

		if (hform_validate(array('name', 'link')))
		{
			$table = llang_table('images');
			$id = $post_data['id'];
			unset($post_data['id']);
			unset($post_data['captcha']);
			$image = lcrud_read_simple($table, $id);
			$gallery = mgalleries_read($image['gallery_id']);

			if ($image['link'] != $post_data['link'])
			{
				$path_old = 'data/galleries/' . $gallery['link'] . '/' . $image['link'] . '.jpg';
				$path_new = 'data/galleries/' . $gallery['link'] . '/' . $post_data['link'] . '.jpg';
				lfile_move($path_old, $path_new);
				$path_old = 'data/galleries/' . $gallery['link'] . '/' . $image['link'] . '_thumb.jpg';
				$path_new = 'data/galleries/' . $gallery['link'] . '/' . $post_data['link'] . '_thumb.jpg';
				lfile_move($path_old, $path_new);
				$path_old = 'data/galleries/' . $gallery['link'] . '/' . $image['link'] . '_real.jpg';
				$path_new = 'data/galleries/' . $gallery['link'] . '/' . $post_data['link'] . '_real.jpg';
				lfile_move($path_old, $path_new);
			}

			lcrud_update_simple($table, $id, $post_data);
			luri_sredirect('admin/publishing/galleries/update', l('Image successfully updated.'), $post_data['gallery_id']);
		}
		else luri_sredirect('admin/publishing/galleries/image_update', l('All fields marked with * are required.'), $post_data['id']);
	}

	/* Handles gallery image delete
	 */
	function cgalleries_image_delete($item)
	{
		lusers_require('galleries/image_delete');
		$table = llang_table('images');
		$image = lcrud_read_simple($table, $item);
		lcrud_delete_simple($table, $item);
		luri_sredirect('admin/publishing/galleries/update/' . $image['gallery_id'], l('Image successfully deleted.'));
	}
?>
