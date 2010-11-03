<?php
	/*      csettings.php - this file is part of Micro CMS
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
	lloader_load("crud");
	lloader_load("cache");
	lloader_load_helper("form");

	/* Handles updating settings
	 */
	function csettings_update()
	{
		lusers_require("settings/update");

		$post_data = linput_post();
		$post_data = linput_post_checkbox($post_data, array("caching", "tools"));

		if (hform_validate(array("tools", "caching", "default_uri"), $post_data))
		{
			foreach ($post_data as $name => $value)
			{
				$data["value"] = $value;
				lcrud_update(lconf_get("lang") . "_settings", array("name" => $name), $data);
			}

			lcache_delete_all();

			luri_redirect("main/user/admin/configuration", l("Settings successfully saved."));
		}
		else luri_redirect("main/user/admin/settings", l("All fields marked with * are required."));
	}
?>
