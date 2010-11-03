<?php
	/*      ccomments.php - this file is part of Micro CMS
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

	lloader_load("input");
	lloader_load("users");
	lloader_load_model("comments");
	lloader_load_helper("form");

	/* Handles sending comment
	 */
	function ccomments_send()
	{
		$post_data = linput_post();

		if (hform_validate(array("name", "body", "captcha")))
		{
			$post_data["time"] = date("Y-m-d H:i:s", time());
			unset($post_data["captcha"]);
			lcrud_create(llang_table("comments"), $post_data);
			if ($post_data['module_item'] != lconf_dbget('default_uri')) luri_sredirect(lroute_get_uri("main/index/content") . "/" . $post_data["module_item"], l("Comment successfully added."));
			else luri_sredirect(lconf_get('uri'), l("Comment successfully added."));
		}
		else luri_sredirect(lroute_get_uri("main/index/content") . "/" . $post_data["module_item"], l("All fields marked with * are required."));
	}

	function ccomments_delete($item)
	{
		lusers_require('comments/delete');
		$comment = lcrud_read_simple(llang_table('comments'), $item);
		lcrud_delete_simple(llang_table('comments'), $item);
		$data['comments'] = mcomments_read(CONT, $comment['module_item']);
		$data['item'] = $comment['module_item'];
		lloader_load_view('subs/comments', $data);
	}
?>
