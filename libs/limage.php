<?php
	/*      limage.php - this file is part of Micro CMS
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

	/* Crops image in combination with resize
	 * <param> <resource> image - image opened with limage_open
	 * <param> <integer> width - new width in px
	 * <param> <integer> height - new height in px
	 * <return> <image> - cropped and resized image
	 */
	function limage_crop_resize($image, $width, $height)
	{
		// Get original width and height
		$old_width = imagesx($image);
		$old_height = imagesy($image);

		$ratio = $old_width / $old_height;
		$new_ratio = $width / $height;

		if ($ratio < $new_ratio)
		{
			$temp_width = $width;
			$temp_height = $temp_width/$ratio;
		}
		else
		{
			$temp_height = $height;
			$temp_width = $temp_height*$ratio;
		}

		// Resize
		$image_resized = imagecreatetruecolor($temp_width, $temp_height);
		imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $temp_width, $temp_height, $old_width, $old_height);

		// Crop
		$image_croped = imagecreatetruecolor($width, $height);
		imagecopyresampled($image_croped, $image_resized, ($width-$temp_width)/2, ($height-$temp_height)/2, 0, 0, $temp_width, $temp_height, $temp_width, $temp_height);
		$image = $image_croped;

		return $image;
	}

	/* Opens image for editing
	 * <param> <string> file - path to the image
	 * <return> <resource> - image resource
	 */
	function limage_open($file)
	{
		// JPEG:
		$im = @imagecreatefromjpeg($file);
		if ($im !== false) { return $im; }
	
		// GIF:
		$im = @imagecreatefromgif($file);
		if ($im !== false) { return $im; }
	
		// PNG:
		$im = @imagecreatefrompng($file);
		if ($im !== false) { return $im; }
	
		// GD File:
		$im = @imagecreatefromgd($file);
		if ($im !== false) { return $im; }
	
		// GD2 File:
		$im = @imagecreatefromgd2($file);
		if ($im !== false) { return $im; }
	
		// WBMP:
		$im = @imagecreatefromwbmp($file);
		if ($im !== false) { return $im; }
	
		// XBM:
		$im = @imagecreatefromxbm($file);
		if ($im !== false) { return $im; }
	
		// XPM:
		$im = @imagecreatefromxpm($file);
		if ($im !== false) { return $im; }
	
		// Try and load from string:
		$im = @imagecreatefromstring(file_get_contents($file));
		if ($im !== false) { return $im; }
	
		return false;
	}

	/* Handles image upload
	 * <param> <string> image_type - type of the image defined in images configuration file
	 * <param> <string> link - content link
	 * <return> <boolean> - true on success false on error
	 */
	function limage_upload($image_type, $link)
	{
		if (lfile_upload($image_type, "image.jpg"))
		{
			lloader_load_conf("images");
			$dimensions = lconf_get($image_type, "dimensions");

			$image = limage_open("data/files/image.jpg");
			$image_resized = limage_crop_resize($image, $dimensions[0], $dimensions[1]);
			imagejpeg($image_resized, "data/images/" . $link . "_" . $image_type . ".jpg", 100);
			$post_data = linput_post_checkbox(linput_post(), $image_type . "_real");
			if ($post_data[$image_type . "_real"] && lconf_get($image_type, "real"))
			{
				$dimensions = lconf_get($image_type, "real_dimensions");
				if ($dimensions) $image = limage_crop_resize($image, $dimensions[0], $dimensions[1]);
				imagejpeg($image, "data/images/" . $link . "_" . $image_type . "_real.jpg", 100);
			}

			lfile_delete("data/files/image.jpg");
			return true;
		}
		else return false;
	}

	/* Handles image upload (array from module's configuration file)
	 * <param> <array> images - array containing image types
	 * <param> <string> link - content link
	 */
	function limage_upload_many($images, $link)
	{
		for ($i = 0; $i < count($images); $i++)
		{
			if (strlen($_FILES[$images[$i]]["name"])) limage_upload($images[$i], $link);
		}
	}

	/* Deletes image based on type and link
	 * <param> <string> image_type - type of the image defined in images configuration file
	 * <param> <string> link - content link
	 */
	function limage_delete($image_type, $link)
	{
		lfile_delete("data/images/" . $link . "_" . $image_type . ".jpg");
		lfile_delete("data/images/" . $link . "_" . $image_type . "_real.jpg");
	}

	/* Deletes images based on type (array from module's configuration file) and link
	 * <param> <array> images - array containing image types
	 * <param> <string> link - content link
	 */
	function limage_delete_many($images, $link)
	{
		for ($i = 0; $i < count($images); $i++)
		{
			limage_delete($images[$i], $link);
		}
	}

	/* Returns path to the resized image
	 * <param> <string> image_type - type of the image defined in images configuration file
	 * <param> <string> link - content link
	 */
	function limage_path($image_type, $link)
	{
		$path = "data/images/" . $link . "_" . $image_type . ".jpg";
		if (!file_exists($path)) $path = false;
		return $path;
	}

	/* Returns path to the real image
	 * <param> <string> image_type - type of the image defined in images configuration file
	 * <param> <string> link - content link
	 */
	function limage_path_real($image_type, $link)
	{
		$path = "data/images/" . $link . "_" . $image_type . "_real.jpg";
		if (!file_exists($path)) $path = false;
		return $path;
	}

	/* Updates image name/path
	 * <param> <string> image_type - type of the image defined in images configuration file
	 * <param> <string> link - old content link
	 * <param> <string> new_link - new content link
	 */
	function limage_update($image_type, $link, $new_link)
	{
		$path = "data/images/" . $link . "_" . $image_type . ".jpg";
		$new_path = "data/images/" . $new_link . "_" . $image_type . ".jpg";
		$path_real = "data/images/" . $link . "_" . $image_type . "_real.jpg";
		$new_path_real = "data/images/" . $new_link . "_" . $image_type . "_real.jpg";

		lfile_move($path, $new_path);
		lfile_move($path_real, $new_path_real);
	}

	/* Updates images' name/path based on type (array from module's configuration file) and link
	 * <param> <string> image_type - type of the image defined in images configuration file
	 * <param> <string> link - old content link
	 * <param> <string> new_link - new content link
	 */
	function limage_update_many($images, $link, $new_link)
	{
		for ($i = 0; $i < count($images); $i++)
		{
			limage_update($images[$i], $link, $new_link);
		}
	}
?>