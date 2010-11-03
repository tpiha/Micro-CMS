<?php
	/*      hlogin.php - this file is part of Micro CMS
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

	/* Generates login or logout link depending on whether is user logged in or not
 	 * <param> <string> css_class - login link css class
	 * <return> <string> - login link string
	 */
	function hlogin_link($css_class = "")
	{
		$login_link = "";
		$login_link_name = "";
		$login_link_href = "";		

		if (lusers_is_logged_in())
		{
			$login_link_href = hanchor_href("users/logout");
			$login_link_name = l("Logout") . " (" . lusers_get_user() . ")";
		}
		else
		{
			$login_link_href = hanchor_href("main/index/admin/login");
			$login_link_name = l("Login");
		}

		$login_link = '<a href="' . $login_link_href . '" title="' . $login_link_name . '"' . (strlen($css_class) ? (' class="' . $css_class . '"') : '') . '>' . $login_link_name . '</a>';

		return $login_link;
	}
?>
