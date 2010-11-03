<?php
	/*      musers.php - this file is part of Micro CMS
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

	lloader_load("crud");

	/* Creates new user in database
	 * <param> <array> data - array containing user data in name/value pairs
	 * <return> <boolean> - true on success, else false
	 */
	function musers_create($data)
	{
		return lcrud_create("_users", $data);
	}

	/* Reads user data from database and returns it
	 * <param> <string/integer> user - string username or integer user id
	 * <return> <array> - array containing user data
	 */
	function musers_read($user)
	{
		if (!is_numeric($user)) $result = lcrud_read("_users", array("username" => $user));
		else $result = lcrud_read("_users", array("id" => (string) $user));
		if (isset($result) && count($result)) return $result[0];
		else return false;
	}

	/* Updates user data in database
	 * <param> <string/integer> user - string username or integer user id
	 * <param> <array> data - array containing user data in name/value pairs
	 * <return> <boolean> - true on success, else false
	 */
	function musers_update($user, $data)
	{
		if (is_string($user)) return lcrud_update("_users", array("username" => $user), $data);
		else if (is_int($user)) return lcrud_update("_users", array("id" => (string) $user), $data);
		else return false;
	}

	/* Deletes user from database
	 * <param> <string/integer> user - string username or integer user id
	 * <return> <boolean> - true on success, else false
	 */
	function musers_delete($user)
	{
		if (is_string($user)) return lcrud_delete("_users", array("username" => $user));
		else if (is_int($user)) return lcrud_delete("_users", array("id" => (string) $user));
		else return false;
	}
?>
