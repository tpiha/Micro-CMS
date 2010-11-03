<?php
	/*      lcrud.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2008 Micro CMS
	 * 
	 * 	Authors:
	 * 		- Tihomir Piha <tpiha@kset.org>
	 * 		- Nikola Dušak <vampyr@kset.org>
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

	lloader_load("db");
	lloader_load("string");

	// CREATE FUNCTIONS //

	/* Creates record in database table
	 * <param> <string> table_name - name of the table
	 * <param> <array> data - array containing data in name/value pairs
	 * <return> <boolean> - true on success, else false
	 */
	function lcrud_create($table_name, $data)
	{
		$query = "INSERT INTO `" . $table_name . "` (";
		$query_second = " VALUES (";

		foreach ($data as $name => $value)
		{
			$query .= "`" . $name . "`, ";
			if ($value != "NULL") $query_second .= "'" . $value . "', ";
			else $query_second .= $value . ", ";
		}

		$query = substr($query, 0, count(strlen($query)) - 3);
		$query_second = substr($query_second, 0, count(strlen($query_second)) - 3);

		$query .= ")";
		$query_second .= ")";

		$query = $query . $query_second;

		return ldb_query($query);
	}

	// READ FUNCTIONS //

	/* Reads record(s) from database table
	 * <param> <string> table_name - name of the table
	 * <param> <array/string> where - array containing where part of query in name/value pairs (connecting with AND)
	 * <return> <array> - array containing select query result
	 */
	function lcrud_read($table_name, $where = false, $custom = "")
	{
		$query = "SELECT * FROM `" . $table_name . "`";
		$first_pass = true;

		if ($where)
		{
			if (is_array($where))
			{
				foreach ($where as $name => $value)
				{
					if ($first_pass)
					{
						$query .= " WHERE";
					}
					if ($first_pass) $query .= " `" . $name . "` = '" . $value . "'";
					else $query .= " AND `" . $name . "` = '" . $value . "'";
					$first_pass = false;
				}
			}
			else if (is_string($where))
			{
				$query .= " ".$where;
			}
		}
		//lerror_log($query . " " . $custom);
		return ldb_query_array($query . " " . $custom);
	}

	/* Reads single record from database table
	 * <param> <string> table_name - name of the table
	 * <param> <array/string> where - array containing where part of query in name/value pairs (connecting with AND)
	 * <return> <array> - array containing select query result or false
	 */
	function lcrud_read_single($table_name, $where = false, $custom = "")
	{
		$result = lcrud_read($table_name, $where, $custom);
		if (count($result)) return $result[0];
		else return false;
	}

	/* Simple read from database table (id or link)
	 * <param> <string> table_name - name of the table
	 * <param> <id/string> record - id or link of entry to read
	 * <return> <array> - array containing select query result or false
	 */
	function lcrud_read_simple($table_name, $record, $custom = "")
	{
		$where = lcrud_get_where($record);
		return lcrud_read_single($table_name, $where, $custom);
	}

	/* Counts records in database table
	 * <param> <string> table_name - name of the table
	 * <param> <array/string> where - array containing where part of query in name/value pairs (connecting with AND)
	 * <return> <integer> - number of records
	 */
	function lcrud_count($table_name, $where = false)
	{
		$records = lcrud_read($table_name, $where);
		return count($records);
	}

	/* Counts records in database table
	 * <param> <string> table_name - name of the table
	 * <param> <ingteger> page - page number (starting from 1)
	 * <param> <integer> per_page - results per page
	 * <param> <array> where - array containing where part of query in name/value pairs (connecting with AND)
	 * <param> <string> order_by - order results by
	 * <return> <array> - array containing select query result or false
	 */
	function lcrud_read_page($table_name, $page, $per_page, $where = false, $order_by = "id")
	{
		$start = ($page - 1) * $per_page;
		$custom = "ORDER BY `" . $order_by . "` LIMIT " . $start . ", " . $per_page;
		return lcrud_read($table_name, $where, $custom);
	}

	/* Search keywords in database
	 * <param> <string> table_name - name of the table
	 * <param> <array> cols - columns to search in
	 * <param> <string> keywords - keywords to search
	 * <return> <array> - array containing select query result or false
	 */
	function lcrud_search($table_name, $cols, $keywords, $custom = "")
	{
		$key_str = $keywords;
		$key_arr = lstring_split($keywords, " ");
		$where = "WHERE (";

		for ($i = 0; $i < count($cols); $i++)
		{
			for ($j = 0; $j < count($key_arr); $j++)
			{
				$where .= "`" . $cols[$i] . "` LIKE '%" . $key_arr[$j] . "%'";
				if ($i < count($cols) - 1 || $j < count($key_arr) - 1) $where .= " OR ";
			}
		}

		$where .= ')';

		return lcrud_read($table_name, $where, $custom);
	}

	// UPDATE FUNCTIONS //

	/* Updates record in database table
	 * <param> <string> table_name - name of the table
	 * <param> <array> where - array containing where part of query in name/value pairs (connecting with AND)
	 * <param> <array> data - array containing data in name/value pairs
	 * <return> <boolean> - true on success, else false
	 */
	function lcrud_update($table_name, $where, $data)
	{
		$query = "UPDATE `" . $table_name . "` SET";
		$first_pass = true;

		foreach ($data as $name => $value)
		{
			if ($value != "NULL") $query .= " `" . $name . "` = '" . $value . "', ";
			else $query .= " `" . $name . "` = " . $value . ", ";
		}

		$query = substr($query, 0, count(strlen($query)) - 3);

		foreach ($where as $name => $value)
		{
			if ($first_pass)
			{
				$query .= " WHERE";
			}
			if ($first_pass) $query .= " `" . $name . "` = '" . $value . "'";
			else $query .= " AND `" . $name . "` = '" . $value . "'";
			$first_pass = false;
		}

		return ldb_query($query);
	}

	/* Updates record in database table simple way
	 * <param> <string> table_name - name of the table
	 * <param> <id/string> record - id or link of entry to update
	 * <param> <array> data - array containing data in name/value pairs
	 * <return> <boolean> - true on success, else false
	 */
	function lcrud_update_simple($table_name, $record, $data)
	{
		$where = lcrud_get_where($record);
		return lcrud_update($table_name, $where, $data);
	}

	// DELETE FUNCTIONS //

	/* Deletes record(s) from database table
	 * <param> <string> table_name - name of the table
	 * <param> <array> where - array containing where part of query in name/value pairs (connecting with AND)
	 * <return> <boolean> - true on success, else false
	 */
	function lcrud_delete($table_name, $where)
	{
		$query = "DELETE FROM `" . $table_name . "`";
		$first_pass = true;

		foreach ($where as $name => $value)
		{
			if ($first_pass)
			{
				$query .= " WHERE";
			}
			if ($first_pass) $query .= " `" . $name . "` = '" . $value . "'";
			else $query .= " AND `" . $name . "` = '" . $value . "'";
			$first_pass = false;
		}

		return ldb_query($query);
	}

	/* Deletes record(s) from database table simple way
	 * <param> <string> table_name - name of the table
	 * <param> <id/string> record - id or link of entry to delete
	 * <return> <boolean> - true on success, else false
	 */
	function lcrud_delete_simple($table_name, $record)
	{
		$where = lcrud_get_where($record);
		return lcrud_delete($table_name, $where);
	}

	/* Deletes all records from database table
	 * <param> <string> table_name - name of the table
	 * <return> <boolean> - true on success, else false
	 */
	function lcrud_empty($table_name)
	{
		$query = "TRUNCATE TABLE `" . $table_name . "`";
		return ldb_query($query);
	}

	/* Gets where array checking if record is numeric or not (integer or string)
	 * <param> <integer/string> record - link or id of the record
	 * <return> <array> - where array
	 */
	function lcrud_get_where($record)
	{
		if (is_numeric($record)) $where = array("id" => $record);
		else $where = array("link" => $record);

		return $where;
	}
?>
