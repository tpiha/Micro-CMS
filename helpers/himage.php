<?php
	/*      himage.php - this file is part of Micro CMS
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

	lloader_load("image");

	/* Returns content image html based on image type
	 * (defined in images configuration file) and link
	 * <param> <string> image_type - one of types defined in module's (or images) configuration file
	 * <param> <string> item - content item link
	 * <return> <string> - image html
	 */
	function himage($image_type, $item, $path = false)
	{
		$item = luri_split($item);
		$item = array_pop($item);

		$image = limage_path($image_type, $item, $path);
		$image_real = limage_path_real($image_type, $item, $path);
		$alt = $item . "_" . $image_type;

		if ($image_real) $img = '<a class="' . $image_type . '_link" rel="lightbox[images]" href="' . hanchor_shref($image_real, false) . '"><img alt="' . $alt . '" title="' . $alt . '" class="' . $image_type . '" src="' . hanchor_shref($image, false) . '" /></a>';
		else if ($image) $img = '<img alt="' . $alt . '" title="' . $alt . '" class="' . $image_type . '" src="' . hanchor_shref($image, false) . '" />';
		else $img = "";

		return $img;
	}
?>
