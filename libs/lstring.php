<?php
	/*      lstring.php - this file is part of Micro CMS
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

	/* Searches for one string in another, returns true if found, else false
	 * <param> <string> string_in - string to search in
 	 * <param> <string> string_for - string to search for
 	 * <return> <boolean> - true if found, else false
	 */
	function lstring_search($string_in, $string_for)
	{
		$position = lstring_position($string_in, $string_for);

		if ($position == -1) $position = false;
		else $position = true;

		return $position;
	}

	/* Searches for one string in another, returns position if found, else -1
	 * <param> <string> string_in - string to search in
 	 * <param> <string> string_for - string to search for
 	 * <return> <integer> - position of first occurence, -1 if not found
	 */
	function lstring_position($string_in, $string_for)
	{
		$position = strpos($string_in, $string_for);

		if ($position === false) $position = -1;

		return $position;
	}

	/* Replaces one string with another and returns result
	 * <param> <string> string_in - string to replace in
 	 * <param> <string> string_what - string to replace
  	 * <param> <string> string_with - string to replace with
 	 * <return> <string> - result string
	 */
	function lstring_replace($string_in, $string_what, $string_with)
	{
		return str_replace($string_what, $string_with, $string_in);
	}

	/* Splits string by some other string
	 * <param> <string> string - string to split
 	 * <param> <string> split_by - string to split by
 	 * <return> <array> - result array
	 */
	function lstring_split($string, $split_by)
	{
		return split($split_by, $string);
	}
?>
