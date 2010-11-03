<?php
	/*      m***NAME***.php - this file is part of Micro CMS
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

	function m***NAME***_read($item = false)
	{
		if ($item === false)
		{
			$***NAME*** = lcrud_read("***NAME***", "ORDER BY `***NAME***`.`id`");
			return $***NAME***;
		}
		else if (is_numeric($item)) $***NAME*** = lcrud_read("***NAME***", "WHERE `***NAME***`.`id` = '" . $item . "' ORDER BY `***NAME***`.`id`");
		else $***NAME*** = lcrud_read("***NAME***", "WHERE `***NAME***`.`link` = '" . $item . "' ORDER BY `***NAME***`.`id`");
		if (isset($***NAME***[0])) return $***NAME***[0];
		else return array();
	}

	function m***NAME***_create($data)
	{
		return lcrud_create("***NAME***", $data);
	}

	function m***NAME***_update($item, $data)
	{
		if (is_numeric($item)) return lcrud_update("***NAME***", array("id" => $item), $data);
		else return lcrud_update("***NAME***", array("link" => $item), $data);
	}

	function m***NAME***_delete($item)
	{
		if (is_numeric($item)) return lcrud_delete("***NAME***", array("id" => $item));
		else return lcrud_delete("***NAME***", array("link" => $item));
	}

	function m***NAME***_get_table_structure()
	{
		return array(***STRUCTURE***);
	}
?>
