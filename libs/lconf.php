<?php
	/*      lconf.php - this file is part of Micro CMS
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

	/* Gets configuration entry value
	 * <param> <string> name - name of the configuration entry
	 * <param> <string> subname - name of the configuration subentry
	 * <return> <any> - value of the configuration entry
	 */
	function lconf_get()
	{
		global $gconf;
		$value = $gconf;
		$args = func_get_args();

		foreach ($args as $arg)
		{
			if (isset($value[$arg])) $value = $value[$arg];
			else return false;
		}

		if ($value == '***URL***') $value = '/';

		return $value;
	}

	/* Gets configuration entry value from database (settings)
	 * <param> <string> name - name of the configuration entry
	 * <return> <any> - value of the configuration entry
	 */
	function lconf_dbget($name)
	{
		$value = lcrud_read(lconf_get("lang") . "_settings", array("name" => $name));
		if (isset($value[0]["value"]) && strlen($value[0]["value"])) return $value[0]["value"];
		else return false;
	}
?>
