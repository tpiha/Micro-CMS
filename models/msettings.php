<?php
	/*      msettings.php - this file is part of Micro CMS
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

	lloader_load("crud");

	/* Read database settings item
	 * <param> <string> item - item to read
	 * <return> <string> - settings item value
	 */
	function msettings_read($item)
	{
		$value = lcrud_read(lconf_get("lang") . "_settings", array("name" => $item));
		if (isset($value[0]["value"]) && strlen($value[0]["value"])) return $value[0]["value"];
		else return false;
	}

	/* Read all database settings items
	 * <return> <array> - settings items array
	 */
	function msettings_read_all()
	{
		$settings = lcrud_read(lconf_get("lang") . "_settings");
		foreach ($settings as $set)
		{
			$data[$set["name"]] = $set["value"];
		}
		return $data;
	}
?>
