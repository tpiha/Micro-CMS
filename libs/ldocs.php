<?php
	/*      ldocs.php - this file is part of Micro CMS
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

	lloader_load("string");

	function ldocs_get_function($segment)
	{
		$seg_arr = split("\(", $segment);
		return trim($seg_arr[0]);
	}

	function ldocs_get_function_args($segment)
	{
		$seg_arr = split("\)", $segment);
		$seg_arr = split("\(", $seg_arr[0]);
		return $seg_arr[1];
	}

	function ldocs_get_function_desc($segment)
	{
		$seg_arr = split("\/\*", $segment);
		$seg_arr = split("\n", $seg_arr[count($seg_arr) - 1]);

		$counter = 1;
		if (lstring_search($segment, "/*")) $description = $seg_arr[0];
		else $description = "";

		while ($counter < count($seg_arr) && !lstring_search($seg_arr[$counter], "<param>") && lstring_search($segment, "/*") && !lstring_search($seg_arr[$counter], "<return>") && !lstring_search($seg_arr[$counter], "*/") && !lstring_search($segment, "http://www.gnu.org/licenses/lgpl.html"))
		{
			$seg_arr[$counter] = lstring_replace($seg_arr[$counter], "* ", "");
			$description .= $seg_arr[$counter];
			$counter++;
		}

		return $description;
	}

	function ldocs_get_params($segment)
	{
		$segments = ldocs_get_segments($segment, "param");
		$params = array();
		foreach ($segments as $segment)
		{
			$seg_arr = split("-", $segment);
			if (count($seg_arr) < 2) return false;
			$desc = trim($seg_arr[1]);

			$seg_arr = split(">", $seg_arr[0]);
			$name = trim($seg_arr[count($seg_arr) - 1]);

			if (isset($seg_arr[count($seg_arr) - 2]))
			{
				$seg_arr = split("<", $seg_arr[count($seg_arr) - 2]);
				$type = trim($seg_arr[1]);
			}
			else $type = "";

			$param["desc"] = $desc;
			$param["name"] = $name;
			$param["type"] = $type;

			array_push($params, $param);
		}
		return $params;
	}

	function ldocs_get_segments($segment, $pattern)
	{
		$seg_arr = split("\/\*", $segment);
		$seg_arr = split("\n", $seg_arr[count($seg_arr) - 1]);
		$segments = array();
		foreach ($seg_arr as $seg)
		{
			if (strstr($seg, $pattern) !== false) array_push($segments, $seg);
		}
		return $segments;
	}

	function ldocs_get_return_type($segment, $name)
	{
		$segment = ldocs_get_segments($segment, "<return>");
		if (!count($segment)) return false;
		$segment = $segment[0];
		$seg_arr = split(">", $segment);
		if (count($seg_arr) < 2) return false;
		$segment = $seg_arr[count($seg_arr) - 2];
		$seg_arr = split("<", $segment);
		$segment = $seg_arr[count($seg_arr) - 1];
		return $segment;
	}

	function ldocs_get_return_text($segment)
	{
		$segment = ldocs_get_segments($segment, "<return>");
		if (!count($segment)) return false;
		$segment = $segment[0];
		$seg_arr = split("-", $segment);
		if (count($seg_arr) == 2) return trim($seg_arr[1]);
	}
?>
