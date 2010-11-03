<?php
	/*      luri.php - this file is part of Micro CMS
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

	lloader_load_helper("message");

	/* Gets uri string or array
	 * <param> <boolean> string - if true returns string, else returns array of uri segments (default: false)
	 * <return> <array/string> - uri string or array of segments
	 */
	function luri_get($string = false)
	{
		if (isset($_GET["uri"]))
		{
			$uri_string = $_GET["uri"];
			if ($string) return $uri_string;
			else
			{
				$uri = split("/", $uri_string);
				return $uri;
			}
		}
		else return false;
	}

	/* Gets segment of the uri
	 * <param> <integer> index - index of the segment to return
	 * <param> <boolean> default_page - if true and index == 0 returns default page link
	 * <return> <string> - segment of the uri string
	 */
	function luri_get_segment($index, $default_page = false)
	{
		$uri_array = luri_get();
		if (isset($uri_array[$index])) return $uri_array[$index];
		else if ($default_page && $index == 0) return lconf_get("page");
		else return false;
	}

	/* Redirects user to some uri
	 * <param> <string> uri - relative uri string
	 * <param> <string> message - flash message to set
	 */
	function luri_sredirect($uri, $message = "", $item = false)
	{
		if (strlen($message)) hmessage_set($message);
		if ($uri == "/") $uri = "";
		$url = lconf_get("url");
		$uri = $url.$uri;
		if ($item) $uri .= "/" . $item . "/";
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$uri);
		die();
	}

	/* Redirects user to some uri
	 * <param> <string> path - right side of routes (controler/function)
	 * <param> <string> message - flash message to set
	 */
	function luri_redirect($path, $message = "", $item = false)
	{
		$uri = lroute_get_uri($path);
		luri_sredirect($uri, $message, $item);
	}

	/* Splits uri into array of segments
	 * <param> <string> uri_string - uri string
	 * <return> <array> - array of uri segments
	 */
	function luri_split($uri_string)
	{
		if (is_array($uri_string)) return $uri_string;
		return split("/", $uri_string);
	}

	/* Joins array of uri segments into array string
	 * <param> <array> uri_array - array of uri segments
	 * <return> <string> - uri string
	 */
	function luri_join($uri_array)
	{
		if (is_string($uri_array)) return $uri_array;

		if (count($uri_array) >= 2) $uri_string = join("/", $uri_array);
		else if (isset($uri_array[0])) $uri_string = $uri_array[0];
		else $uri_string = "";

		return $uri_string;
	}

	/* Returns subdomain part of the domain string
	 * <return> <string> - subdomain string
	 */
	function luri_get_subdomain()
	{
		$domain = $_SERVER["SERVER_NAME"];
		$domain_split = split("\.", $domain);
		$subdomain = $domain_split[0];
		$counter = count($domain_split);

		if ($counter == 2) return false;
		else if ($counter == 3)
		{
			if ($subdomain == "www") return false;
			else return $subdomain;
		}
	}
?>
