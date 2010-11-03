<?php
	/*      cusers.php - this file is part of Micro CMS
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

	lloader_load("users");
	lloader_load("input");
	lloader_load_helper("form");
	lloader_load_model("users");

	/* Just loads user template
	 */
	function cusers_index()
	{
		
	}

	/* Submits user and redirects (called from login form)
	 */
	function cusers_submit()
	{
		if (hform_validate(array("user", "pass", "captcha")))
		{
			$post_data = linput_post();
			if (lusers_login($post_data["user"], $post_data["pass"]))
			{
				luri_sredirect(hmessage_get("redirect"));
			}
			else luri_redirect("main/index/admin/login", l("Username or password incorrect!"));
		}
		else luri_redirect("main/index/admin/login", l("All fields are required."));
	}

	/* User logout
	 */
	function cusers_logout()
	{
		lusers_logout();
	}

	/* Handles updating user profile
	 */
	function cusers_update()
	{
		lusers_require("users/update");

		$post_data = linput_post();

		if (hform_validate(array("pass0", "pass1", "pass2")))
		{
			if ($post_data["pass1"] != $post_data["pass2"]) luri_redirect("main/user/admin/profile", l("New passwords don't match."));
			else
			{
				$user = musers_read(lusers_get_cookie_id());

				if (lusers_check_password($user["username"], $post_data["pass0"]))
				{
					musers_update($user["username"], array("password" => md5($post_data["pass1"])));
					luri_redirect("main/user/admin/configuration", l("Profile successfully saved."));
				}
				else luri_redirect("main/user/admin/profile", l("Old password not correct."));
			}
		}
		else luri_redirect("main/user/admin/profile", l("If you're changing password, you must enter old and repeat new."));
	}
?>
