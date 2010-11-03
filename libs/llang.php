<?php
	/*      llang.php - this file is part of Micro CMS
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

	/* Returns string alias from language file if defined, else string itself
	 * <param> <string> string - text to translate
	 * <return> <string> - translated text if existing, else string from argument
	 */
	function l($string)
	{
		$lang = lconf_get("lang");

		// loads language file according to system configuration
		if (lloader_load_lang($lang))
		{
			// checks if string exists in language file
			global $glang;
			if (isset($glang[$string])) return $glang[$string];
			else return $string;
		}
		else return $string;
	}

	/* Returns language specific database table name (prepended with
	 * two letters defining language and uderscore)
	 * <param> <string> table_name - name of the database table
	 * <return> <string> - new table name
	 */
	function llang_table($table_name)
	{
		$new_name = lconf_get("lang") . "_" . $table_name;
		return $new_name;
	}
?>
