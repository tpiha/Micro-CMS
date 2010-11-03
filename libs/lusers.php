<?php
	/*      lusers.php - this file is part of Micro CMS
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

	lloader_load_model("users");
	lloader_load_helper("message");

	/* Logins user (on database and cookies level)
	 * <param> <string> user - username
	 * <param> <string> pass - password
	 * <return> <boolean> - true on success, else false
	 */
	function lusers_login($user, $pass)
	{
		$result = musers_read($user);

		if ($result && md5($pass) == $result["password"])
		{
			setcookie("id", $result["id"], 0, "/");

			// For demo site purposes - TODO
			//if (isset($result["key"]))$key = $result["key"];
			//else
			//{
			//	srand(time());
			//	$key = md5((rand()%1000000000));
			//}
			srand(time());
			$key = md5((rand()%1000000000));

			setcookie("key", $key, 0, "/");

			return musers_update($user, array("key" => $key));
		}
		return false;
	}

	/* User logout (on cookie level)
	 */
	function lusers_logout($redirect_uri = false)
	{
		setcookie ("id", "", time() - 3600, "/");
		setcookie ("key", "", time() - 3600, "/");
		luri_sredirect("");
	}

	/* Requires user to be logged in
	 * <return> <boolean> - true if user is logged in else redirects with message
	 */
	function lusers_require($path)
	{
		hmessage_set(lroute_get_uri($path), "redirect");

		$id = NULL;
		$key = NULL;
		$user = NULL;
		$pass = NULL;

		if (isset($_COOKIE["id"])) $id = $_COOKIE["id"];
		if (isset($_COOKIE["key"])) $key = $_COOKIE["key"];

		if (!lusers_check($id, $key))
		{
			luri_redirect("main/index/admin/login");
		}

		hmessage_unset("redirect");
	}

	/* Checks if user is logged in
	 * <param> <string> id - user's id
	 * <param> <string> key - user's key
	 * <return> <boolean> - true if is logged in, else false
	 */
	function lusers_check($id, $key)
	{
		$result = musers_read((int) $id);

		if ($result && $key == $result["key"]) return true;
		else return false;
	}

	/* Gets user id from his cookie
	 * <return> <string> - user id
	 */
	function lusers_get_cookie_id()
	{
		if (isset($_COOKIE["id"])) return $_COOKIE["id"];
		else return false;
	}

	/* Checks if user is logged in
	 * <return> <boolean> - true if user logged in, else false
	 */
	function lusers_is_logged_in()
	{
		$id = NULL;
		$key = NULL;

		if (isset($_COOKIE["id"])) $id = $_COOKIE["id"];
		if (isset($_COOKIE["key"])) $key = $_COOKIE["key"];

		if (lusers_check($id, $key)) return true;
		else return false;
	}

	/* Returns logged in user's username
	 * <return> <string/boolean> - username or false if not logged in
	 */
	function lusers_get_user()
	{
		$id = lusers_get_cookie_id();
		if ($id)
		{
			$result = musers_read((int) $id);
			if ($result && strlen($result["username"])) return $result["username"];
			else return false;
		}
		else return false;
	}

	/* Checks username and password without logging in
	 * <param> <string> user - username
	 * <param> <string> pass - password
	 * <return> <string/boolean> - username or false if not logged in
	 */
	function lusers_check_password($user, $pass)
	{
		$result = musers_read($user);

		if ($result && md5($pass) == $result["password"]) return true;
		else return false;
	}
?>
