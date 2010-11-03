<?php
	/*      larray.php - this file is part of Micro CMS
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

	/* Cleans array from unwanted keys
	 * <param> <array> array - array to clean
 	 * <param> <array> keys - array containing wanted keys
 	 * <return> <array> - cleaned array
	 */
	function larray_clean($array, $keys)
	{
		$new_array = array();

		for ($i = 0; $i < count($keys); $i++)
		{
			if (isset($array[$keys[$i]])) $new_array[$keys[$i]] = $array[$keys[$i]];
		}

		return $new_array;
	}
?>
