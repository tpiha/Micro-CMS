<?php
	/*      cmain.php - this file is part of Micro CMS
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

	lloader_load("users");
	lloader_load("uri");

	/* Handles loading view
	 */
	function cmain_index($view)
	{
		lloader_load_view($view);
	}

	/* Handles loading view with item
	 */
	function cmain_item($item)
	{
		$item = luri_split($item);
		$view = $item[0];
		if (isset($item[1]))$data["item"] = $item[1];
		else $data["item"] = "";
		for ($i = 2; $i < count($item); $i++)
		{
			$data["item"] .= "/" . $item[$i];
		}
		lloader_load_view($view, $data);
	}

	/* Handles loading view with user required
	 */
	function cmain_user($view)
	{
		lusers_require("main/user/" . $view);
		lloader_load_view($view);
	}

	/* Handles loading view with item and user required
	 */
	function cmain_user_item($item)
	{
		$item = luri_split($item);
		if (count($item) == 2)
		{
			$view = $item[0];
			$data["item"] = $item[1];
		}
		else
		{
			$view = $item[0] . "/" . $item[1];
			$data["item"] = $item[2];;
			for ($i = 3; $i < count($item); $i++)
			{
				$data["item"] .= "/" . $item[$i];
			}
		}

		lusers_require("main/user/" . $view);
		lloader_load_view($view, $data);
	}
?>
