<?php
	/*      lcache.php - this file is part of Micro CMS
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

	lloader_load("file");
	lloader_load("string");
	lloader_load("crud");

	/* Gets cache filename or cache file path from URI string (replaces / with _)
	 * <param> <string> uri_string - URI string
	 * <param> <boolean> path - if true returns path, else filename (without the extension)
	 * <return> <string> - cache path or filename
	 */
	function lcache_get_file($uri_string, $path = true)
	{
		if (!strlen($uri_string)) $uri_string = "index";
		
		if ($path) $uri_string = "data/cache/" . $uri_string . ".html";
		else $uri_string .= ".html";
		
		return $uri_string;
	}	

	/* Checks if URI is cached
	 * <param> <string> uri_string - URI string
	 * <return> <boolean> - true if cache file exists, else false
	 */
	function lcache_is_cached($uri_string)
	{	
		$uri_string = lcache_get_file($uri_string);
		return file_exists($uri_string);
	}

	/* Starts caching output
	 */
	function lcache_start()
	{
		ob_start("lcache_write");
	}

	/* Stops caching output, flushes buffer and generates output
	 */
	function lcache_stop()
	{
		ob_end_flush();
	}

	/* Caching callback function, called by lcache_start; writes buffer to cache file
	 * <param> <string> buffer - buffer provided by ob_start native function
	 */
	function lcache_write($buffer)
	{
		$path = lcache_get_file(luri_get(true));
		lcache_check_directories($path);

		chdir(dirname($_SERVER['SCRIPT_FILENAME']));
		lfile_write($path, $buffer);
		chmod($path, 0777);

		return $buffer;
	}

	/* Includes cache file with lloader_load_file function if cache for uri_string exists
	 * <param> <string> uri_string - URI string
	 * <return> <boolean> - true on success, else false
	 */
	function lcache_read($uri_string)
	{
		if (lcache_is_cached($uri_string))
		{
			$path = lcache_get_file($uri_string);
			lloader_load_file($path);
			die();
		}
		else return false;
	}

	/* Deletes cache file if exists
	 * <param> <string> uri_string - URI string
	 * <return> <boolean> - true if existing and deleted, else false
	 */
	function lcache_delete($uri_string)
	{
		$path = lcache_get_file($uri_string);
		return lfile_delete($path);
	}

	/* Checks if directories for URI at the moment are created, creates them if not
	 */
	function lcache_check_directories()
	{
		$path_array = lstring_split(luri_get(true), "/");
		array_pop($path_array);
		$path = "data/cache/";

		for ($i = 0; $i < count($path_array); $i++)
		{
			$path .= $path_array[$i] . "/";
			if (!file_exists($path))
			{
				mkdir($path);
				chmod($path, 0777);
			}
		}
	}

	/* Checks if cache is enabled for URI at the moment
	 * <return> <boolean> - true if cache is enabled, else false
	 */
	function lcache_is_enabled()
	{
		lloader_load_conf("cache");
		$caching = lconf_dbget("caching");
		$uri_string = luri_get(true);
		$enabled = true;
		$disabled_uris = lconf_get("cache", "disabled_uris");

		for ($i = 0; $i < count($disabled_uris); $i++)
		{
			if (lstring_search($uri_string, $disabled_uris[$i])) $enabled = false;
		}

		return ($enabled && $caching);
	}

	/* Deletes all cache files
	 * <return> <boolean> - true on success, else false
	 */
	function lcache_delete_all()
	{
		if (lfile_empty_dir("data/cache")) return true;
		else return false;		
	}
?>
