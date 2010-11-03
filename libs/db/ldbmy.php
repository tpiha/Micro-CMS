<?php
	/*      lcache.php - this file is part of Micro CMS
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

	$glink = null;

	/* Database library initialization
	 */
	function ldb_init()
	{
		global $glink;
		if (!$glink)
		{
			$host = lconf_get('db_host');
			$user = lconf_get('db_user');
			$pass = lconf_get('db_pass');
			$dbname = lconf_get('db_name');

			$glink = @mysql_connect($host, $user, $pass)
			or die(l('Couldn\'t connect to mysql server.'));

			@mysql_select_db($dbname)
			or die(l('Couldn\'t select database.'));

			mysql_query('SET NAMES \'utf8\' COLLATE \'utf8_slovenian_ci\'')
			or die(l('Query failed: ').mysql_error());
		}
	}

	/* Sends mysql query
	 * <param> <string> query - query string
	 * <return> <resource> - returns mysql result resource if true, else mysql error
	 */
	function ldb_reinit($reinit_type = false)
	{
		ldb_init(true, $reinit_type);
	}

	/* Sends mysql query
	 * <param> <string> query - query string
	 * <return> <resource> - returns mysql result resource if true, else mysql error
	 */
	function ldb_query($query)
	{
		ldb_init();
		$result = mysql_query($query)
		or lerror_log(l('Query failed: ') . mysql_error() . '. Query: ' . $query);
		return $result;
	}

	/* Fetches query result
	 * <param> <resource> query_result - mysql query result
	 * <return> <array> - returns array containing result data
	 */
	function ldb_fetch_array($query_result)
	{
		$result_array = mysql_fetch_array($query_result);
		return $result_array;
	}

	/* Returns 2D array from query
	 * <param> <string> query - query string
	 * <return> <array> - returns 2D array if it exists, else false
	 */
	function ldb_query_array($query)
	{
		$result = ldb_query($query);
		$result_array = array();

		if ($result)
		{
			while ($row = mysql_fetch_array($result))
			{
				array_push($result_array, $row);
			}
		}

		return $result_array;
	}

	/* Closes mysql link
	 */
	function ldb_close()
	{
		global $glink;
		if (isset($glink)) return mysql_close($glink);
		else return mysql_close();
	}

	/* Check if config data correct
	 */
	function ldb_check()
	{
		$connected = true;

		$host = lconf_get('db_host');
		$user = lconf_get('db_user');
		$pass = lconf_get('db_pass');
		$dbname = lconf_get('db_name');

		if (!@mysql_connect($host, $user, $pass)) $connected = false;
		if (!@mysql_select_db($dbname)) $connected = false;

		return $connected;
	}
?>
