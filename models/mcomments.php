<?php
	/*      mcomments.php - this file is part of Micro CMS
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

	/* Read comments for item of module
	 * <param> <string> module - module string (constant)
	 * <param> <string> item - item to read comments for
	 * <return> <array> - array of comments ordered by time
	 */
	function mcomments_read($module, $item)
	{
		if (!strlen($item)) $item = lconf_dbget("default_uri");

		$table = llang_table("comments");
		$where = array("module" => $module, "module_item" => $item);
		$custom = "ORDER BY `time` DESC";

		return lcrud_read($table, $where, $custom);
	}

	/* Counts comments for item of module
	 * <param> <string> module - module string (constant)
	 * <param> <string> item - item to count comments for
	 * <return> <integer> - number of comments for item of module
	 */
	function mcomments_count($module, $item)
	{
		if (!strlen($item)) $item = lconf_dbget("default_uri");
		$table = llang_table("comments");
		$where = array("module" => $module, "module_item" => $item);

		return lcrud_count($table, $where);		
	}
?>
