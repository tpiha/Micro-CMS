<?php
	/*      c***NAME***.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2008 Micro CMS
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

	lloader_load_model("***NAME***");
	lloader_load_helper("anchor");
	lloader_load_helper("form");

	/* Lists items
	 */
	function c***NAME***_index()
	{
		$data["***NAME***"] = m***NAME***_read();
		$data["subview"] = "***NAME***_index";
		lloader_load_view("***NAME***", $data);
	}

	/* Reads item
	 */
	function c***NAME***_read($item)
	{
		$data["***NAME***"] = m***NAME***_read($item);
		$data["subview"] = "***NAME***_read";
		lloader_load_view("***NAME***", $data);
	}

	/* Creates item
	 */
	function c***NAME***_create()
	{
		$post_data = linput_post();
		$post_data = lcontroller_prepare_input($post_data, m***NAME***_get_table_structure());
		$data["subview"] = "***NAME***_create";
		if ($post_data !== false)
		{
			m***NAME***_create($post_data);
			luri_redirect(lroute_get_uri("***NAME***"));
		}
		else lloader_load_view("***NAME***", $data);
	}

	/* Updates item
	 */
	function c***NAME***_update($item)
	{
		$post_data = linput_post();
		$post_data = lcontroller_prepare_input($post_data, m***NAME***_get_table_structure());
		$data["***NAME***"] = m***NAME***_read($item);
		$data["subview"] = "***NAME***_update";
		if ($post_data !== false)
		{
			m***NAME***_update($item, $post_data);
			luri_redirect(lroute_get_uri("***NAME***"));
		}
		else lloader_load_view("***NAME***", $data);
	}

	/* Deletes item
	 */
	function c***NAME***_delete($item)
	{
		m***NAME***_delete($item);
		luri_redirect(lroute_get_uri("***NAME***"));
	}
?>
