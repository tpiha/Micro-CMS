<?php
	/*      hstring.php - this file is part of Micro CMS
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

	/* Shortens string the smart way
	 * <param> <string> <string> - string to be shorten
	 * <param> <integer> <length> - new string length
	 * <return> <string> - new string (shorter)
	 */
	function hstring_smart_shorten($string, $length)
	{
		$string = preg_replace('|<.*?>|ms', ' ', $string);
		//$string = strip_tags($string);
		$string = str_replace("\r\n", " ", $string);
		$string = str_replace("\r", " ", $string);
		$string = str_replace("\n", " ", $string);
		$string = str_replace("&nbsp;", " ", $string);

		if (strlen($string) > $length)
		{
			$string = substr($string, 0, $length);

			$char = $string[$length - 1];

			while ($char != " " && $char != "." && $char != "?" && $char != "!")
			{
				$length--;
				$string = substr($string, 0, $length);
				$char = $string[$length - 1];
			}

			return $string . " ...";
		}
		else return $string;
	}
?>
