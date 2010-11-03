<?php
	/*      ccategories.php - this file is part of Micro CMS
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

	lloader_load("users");
	lloader_load("input");
	lloader_load_conf("content");
	lloader_load_helper("form");
	lloader_load_model("categories");

	/* Handles creating category
	 */
	function ccategories_create()
	{
		lusers_require("categories/create");

		$post_data = linput_post();
		$post_data = linput_post_checkbox($post_data, "content");
		$content = $post_data["content"];

		if (hform_validate(array("name", "link", "parentid")))
		{
			$cat_created = mcategories_create($post_data);
			if ($content) $content_created = mcontent_create($post_data);
			else $content_created = false;

			if (($cat_created && !$content) || ($content && $cat_created && $content_created))
			{
				lcache_delete_all();
				hmessage_set(l("Category successfully created."));
			}
			else
			{
				if ($cat_created) mcategories_delete($post_data["link"]);
				if ($content_created) mcontent_delete($post_data["link"]);
				hmessage_set(l("Category create error.") . " " . l("Link already in use."));
			}

			luri_redirect("main/user/admin/categories");
		}
		else luri_redirect("main/user/admin/categories_create", l("All fields marked with * are required."));
	}

	/* Handles updating
	 */
	function ccategories_update()
	{
		lusers_require("categories/update");

		$post_data = linput_post();

		if (hform_validate(array("name", "link", "parentid")))
		{
			$content = mcategories_get_content($post_data["id"]);
			mcategories_update($post_data["id"], $post_data);
			// Check if link is default uri and change default uri too if needed
			if ($content["link"] == lconf_dbget("default_uri")) lcrud_update(llang_table("settings"), array("name" => "default_uri"), array("value" => $post_data["link"]));
			// Do not update name for content from here
			unset($post_data["name"]);
			mcontent_update($content["id"], $post_data);
			// Update comments too
			lcrud_update(llang_table("comments"), array("module" => CONT, "module_item" => $content["link"]), array("module_item" => $post_data["link"]));

			lcache_delete_all();

			luri_redirect("main/user/admin/categories", l("Category successfully updated."));
		}
		else
		{
			$category = mcategories_read($post_data["id"]);
			luri_sredirect(lroute_get_uri("main/user_item/admin/categories_update") . "/" . $category[0]["link"], l("All fields marked with * are required."));
		}
	}

	/* Handles deleting category
	 */
	function ccategories_delete($category)
	{
		lusers_require("categories/delete");

		$content = mcategories_get_content($category);
		mcategories_delete($category);
		mcontent_delete($content["id"]);

		lcache_delete_all();

		luri_redirect("main/user/admin/categories", l("Category successfully deleted."));
	}

	/* Handles reordering categories
	 */
	function ccategories_order()
	{
		lusers_require("categories/order");

		$post_data = linput_post();
		$order = $post_data["order"];

		$order = split("\|", $order);

		for ($i = 0; $i < count($order); $i++)
		{
			lcrud_update(lconf_get("lang") . "_categories", array("id" => $order[$i]), array("orderid" => $i));
		}

		lcache_delete_all();
	}
?>
