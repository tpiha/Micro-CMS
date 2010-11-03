<?php
	/*      lloader.php - this file is part of Micro CMS
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

	include_once("libs/lconf.php");

	/* Returns path to file
	 * <param> <string> file - filename
	 * <param> <string> type - type of the file to load (lib, model, helper, controller, lang, view)
	 * <return> <string> - path to file
	 */
	function lloader_file_path($file, $type = "")
	{
		$prefix = "";

		switch ($type)
		{
			case "lib":
				$prefix = "libs/l";
				break;
			case "model":
				$prefix = "models/m";
				break;
			case "helper":
				$prefix = "helpers/h";
				break;
			case "controller":
				$prefix = "controllers/c";
				break;
			case "lang":
				$prefix = "langs/";
				break;
			case "view":
				$prefix = "views/".lconf_get("theme")."/";
				break;
			case "tools_view":
				$prefix = "views/".lconf_get("tools_theme")."/";
				break;
			case "conf":
				$prefix = "conf/";
				break;
			default:
				$prefix = "libs/l";
		}

		return $prefix . $file . ".php";
	}

	/* Loads library file
	 * <param> <string> file - filename
	 * <param> <string> type - type of the file to load (lib, model, helper, controller, lang, view)
	 * <param> <array> data - data to be evaluated along with the file (in the same scope)
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load($file, $type = "", $data = false)
	{
		$file_path = lloader_file_path($file, $type);

		return lloader_load_file($file_path, $data);
	}

	/* Loads library file (full path)
	 * <param> <string> file - filename with path
	 * <param> <array> data - data to be evaluated along with the file (in the same scope)
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load_file($file, $data = false)
	{
		global $gconf;
		if ($data)
		{
			foreach($data as $name => $value) $$name = $value;
			$data = $data;
		}
		if (file_exists($file) && include_once($file)) return true;
		else return false;
	}

	/* Loads model file
	 * <param> <string> file - model filename
	 * <param> <array> data - data to be evaluated along with the file (in the same scope)
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load_model($file, $data = false)
	{
		return lloader_load($file, "model", $data);
	}

	/* Loads helper file
	 * <param> <string> file - helper filename
	 * <param> <array> data - data to be evaluated along with the file (in the same scope)
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load_helper($file)
	{
		return lloader_load($file, "helper");
	}

	/* Loads controller file
	 * <param> <string> file - controller filename
	 * <param> <array> data - data to be evaluated along with the file (in the same scope)
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load_controller($file, $data = false)
	{
		return lloader_load($file, "controller", $data);
	}

	/* Loads language file
	 * <param> <string> file - language filename
	 * <param> <array> data - data to be evaluated along with the file (in the same scope)
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load_lang($file, $data = false)
	{
		return lloader_load($file, "lang", $data);
	}

	/* Loads view file
	 * <param> <string> file - view filename
	 * <param> <array> data - data to be evaluated along with the file (in the same scope)
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load_view($file, $data = false)
	{
		return lloader_load($file, "view", $data);
	}

	/* Loads model files from array
	 * <param> <array> files - model filenames stored in array
	 * <param> <array> data - data to be evaluated along with the files (in the same scope)
	 * <return> <boolean> - true if all successful, else false
	 */
	function lloader_load_files($files, $type, $data = false)
	{
		$success = true;

		foreach ($files as $file)
		{
			if (!lloader_load($file, $type, $data)) $success = false;
		}

		return $success;
	}

	/* Loads configuration file
	 * <param> <string> file - configuration filename
	 * <return> <boolean> - true if successful, else false
	 */
	function lloader_load_conf($file)
	{
		return lloader_load($file, "conf");
	}
?>
