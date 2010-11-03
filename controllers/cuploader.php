<?php
	/*      cuploader.php - this file is part of Micro CMS
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

	lloader_load('users');
	lloader_load('input');
	lloader_load('image');
	lloader_load_helper('anchor');
	lloader_load_helper('form');
	lloader_load_model('galleries');

	function cuploader_index($item)
	{
		lusers_require('uploader');
		$data['gal'] = $item;
		lloader_load_view('admin/html/iframe_uploader', $data);
	}

	function cuploader_upload()
	{
		lusers_require('uploader/upload');
		$post_data = linput_post();

		if (hform_validate(array('name', 'link', 'gallery_id')))
		{
			$table = llang_table('images');
			$images = mgalleries_read_images($post_data['gallery_id']);
			$post_data['orderid'] = count($images);

			if (lcrud_create($table, $post_data))
			{
				$gallery = mgalleries_read($post_data['gallery_id']);
				$image = lcrud_read($table, array('link' => $post_data['link']));
				$image = $image[count($image) - 1];

				if (!lfile_upload('upload', 'image.jpg', 'data/files/'))
				{
					lcrud_delete_simple($table, $post_data['link']);
					lerror_log('Error in file upload.');
					luri_sredirect('iframe_uploader/' . $post_data['gallery_id'], l('Error in file upload. Check \'data/error_log.txt\' log.') . '<br />');
				}

				lfile_copy('data/files/image.jpg', 'data/galleries/' . $gallery['link'] . '/' . $post_data['link'] . '_real_' . (string) $image['id'] . '.jpg');

				lloader_load_conf('images');
				$dimensions = lconf_get('gallery_image', 'dimensions');
				$real_dimensions = lconf_get('gallery_image', 'real_dimensions');
				$image_uploaded = limage_open('data/files/image.jpg');
				$image_thumb = limage_crop_resize($image_uploaded, $dimensions[0], $dimensions[1]);
				$image_real = limage_crop_resize($image_uploaded, $real_dimensions[0], $real_dimensions[1]);
				imagejpeg($image_thumb, 'data/galleries/' . $gallery['link'] . '/' . $post_data['link'] . '_thumb_' . (string) $image['id'] . '.jpg', 100);
				imagejpeg($image_real, 'data/galleries/' . $gallery['link'] . '/' . $post_data['link'] . '_' . (string) $image['id'] . '.jpg', 100);

				lfile_delete('data/files/image.jpg');

				luri_sredirect('admin/publishing/galleries/iframe_uploader/' . $post_data['gallery_id'], l('Image successfully uploaded.') . '<br />');
			}
			else luri_sredirect('iframe_uploader/' . $post_data['gallery_id'], l('Image with same link already added.') . '<br />');
		}
		else luri_sredirect('iframe_uploader/' . $post_data['gallery_id'], l('All fields neccessary.') . '<br />');
	}
?>
