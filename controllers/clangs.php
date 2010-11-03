<?php
	/*      clangs.php - this file is part of Micro CMS
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

	lloader_load("uri");
	lloader_load_helper("message");

	/* Handles changing language
	 */
	function clangs_change($lang)
	{
		hmessage_set($lang, "lang");
		luri_sredirect("");
	}

	/* Handles clearing language variable
	 */
	function clangs_clear()
	{
		hmessage_get("lang");
		luri_sredirect("");
	}

	/* Handles changing language for admin interface
	 */
	function clangs_change_admin($lang)
	{
		hmessage_set($lang, "lang");
		luri_redirect("main/user/admin/admin");
	}
?>
