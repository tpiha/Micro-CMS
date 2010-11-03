<?php
	/*      linput.php - this file is part of Micro CMS
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

	/* Gets one get variable value or whole array (safe way)
	 * <param> <string> variable_name - name of the variable
	 * <return> <string> - value
	 */
	function linput_get($variable_name = false)
	{
		if ($variable_name) return linput_get_safe($_GET[$variable_name]);
		else
		{
			$vars = array();
			foreach ($_GET as $name => $value)
			{
				$vars[$name] = linput_get_safe($value);
			}
			return $vars;
		}
	}

	/* Gets one post variable value or whole array (safe way)
	 * <param> <string> variable_name - name of the variable
	 * <return> <string> - value
	 */
	function linput_post($variable_name = false)
	{
		if ($variable_name) return linput_get_safe($_POST[$variable_name]);
		else
		{
			$vars = array();
			foreach ($_POST as $name => $value)
			{
				$vars[$name] = linput_get_safe($value);
			}
			return count($vars) ? $vars : false;
		}
	}

	/* Cleans checkboxes post data
	 * <param> <array> post_data - initial post data
	 * <param> <string/array> name - name or names of checkbox indexes
	 * <return> <array> - new post data array
	 */
	function linput_post_checkbox($post_data, $name)
	{
		if (is_string($name))$post_data[$name] = isset($post_data[$name]) ? 1 : 0;
		else
		{
			for ($i = 0; $i < count($name); $i++)
			{
				$post_data[$name[$i]] = isset($post_data[$name[$i]]) ? 1 : 0;
			}
		}

		return $post_data;
	}

	/* Escapes string
	 * <param> <string> value - unescaped value
	 * <return> <string> - escaped value
	 */
	function linput_get_safe($value)
	{
		if (!ldb_check()) return $value;
		if (get_magic_quotes_gpc())
		{
			$value = stripslashes($value);
		}
		//check if this function exists
		if (function_exists("mysql_real_escape_string"))
		{
			$value = mysql_real_escape_string($value);
		}
		//for PHP version < 4.3.0 use addslashes
		else
		{
			$value = addslashes($value);
		}
		return $value;
	}
?>
