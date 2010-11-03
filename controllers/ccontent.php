<?php
	/*      ccontent.php - this file is part of Micro CMS
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
	lloader_load('users');
	lloader_load('image');
	lloader_load('string');
	lloader_load_conf('content');
	lloader_load_helper('form');
	lloader_load_model('content');

	/* Handles creating content
	 */
	function ccontent_create()
	{
		lusers_require('content/create');

		$post_data = linput_post();
		$post_data['time'] = date('Y-m-d', strtotime($post_data['date'])) . ' ' . date('H:i:s', strtotime($post_data['time']));

		if (hform_validate(array('name', 'link', 'body')))
		{
			$content_created = mcontent_create($post_data);
			$cat_created = mcategories_create($post_data);

			if ($content_created && $cat_created)
			{
				limage_upload_many(lconf_get('content', 'images'), $post_data['link']);
				lcache_delete_all();
				hmessage_set(l('Content successfully created.'));
			}
			else
			{
				if ($content_created) mcontent_delete($post_data['link']);
				if ($cat_created) mcategories_delete($post_data['link']);
				hmessage_set(l('Content create error.') . ' ' . l('Link already in use.'));
			}

			luri_redirect('main/user/admin/content');
		}
		else luri_redirect('main/user/admin/content_create', l('All fields marked with * are required.'));
	}

	/* Handles updating content
	 */
	function ccontent_update()
	{
		lusers_require('content/update');

		$post_data = linput_post();
		$post_data['time'] = date('Y-m-d', strtotime($post_data['date'])) . ' ' . date('H:i:s', strtotime($post_data['time']));

		if (hform_validate(array('name', 'link', 'body')))
		{
			$cat = mcontent_get_cat($post_data['id']);

			limage_upload_many(lconf_get('content', 'images'), $post_data['link']);

			mcontent_update($post_data['id'], $post_data);
			// Check if link is default uri and change default uri too if needed
			if ($cat['link'] == lconf_dbget('default_uri')) lcrud_update(llang_table('settings'), array('name' => 'default_uri'), array('value' => $post_data['link']));
			// Do not update name for category from here
			unset($post_data['name']);
			mcategories_update($cat['id'], $post_data);
			// Update comments too
			lcrud_update(llang_table('comments'), array('module' => CONT, 'module_item' => $cat['link']), array('module_item' => $post_data['link']));

			lcache_delete_all();

			luri_redirect('main/user/admin/content', l('Content successfully updated.'));
		}
		else
		{
			$content = mcontent_read($post_data['id']);
			luri_sredirect(lroute_get_uri('main/user_item/admin/content_update') . '/' . $content['link'], l('All fields marked with * are required.'));
		}
	}

	/* Handles deleting content
	 */
	function ccontent_delete($content)
	{
		lusers_require('content/delete');

		$cat = mcontent_get_cat($content);
		mcontent_delete($content);
		mcategories_delete($cat['id']);

		lcache_delete_all();

		luri_redirect('main/user/admin/content', l('Content successfully deleted.'));
	}

	/* Handles searcing content
	 */
	function ccontent_search()
	{
		$post_data = linput_post();
		$table = llang_table('content');
		$cols = array('body', 'name');
		$keywords = $post_data['keywords'];

		if (strlen($keywords) >= 3)
		{
			$data['content'] = lcrud_search($table, $cols, $keywords, 'AND `published`=\'1\' ORDER BY `updated` DESC');

			for ($i = 0; $i < count($data['content']); $i++)
			{
				$data['content'][$i]['title'] = $data['content'][$i]['name'];
				$data['content'][$i]['link'] = mcategories_read_path($data['content'][$i]['link'], false);
			}

			if (!count($data['content'])) hmessage_set(l('No results.'));

			lloader_load_view('search', $data);
		}
		else
		{
			$data['content'] = array();
			hmessage_set(l('Keyword must be at least 3 characters long'));
			lloader_load_view('search', $data);
		}
	}

	/* Handles content images deleting
	 */
	function ccontent_images_delete($item)
	{
		lusers_require('images/delete');

		$item = luri_split($item);
		lloader_load_conf($item[0]);

		limage_delete_many(lconf_get($item[0], 'images'), $item[1]);

		luri_redirect('main/user/admin/content', l('Images successfully deleted.'));
	}
?>
