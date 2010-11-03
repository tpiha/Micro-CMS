<?php
	/*      lroute.php - this file is part of Micro CMS
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

	/* Gets routing data from configuration file (index.php)
	 * <return> <array> - array of routing name-value pairs
	 */
	function lroute_get_routes()
	{
		return lconf_get("routes");
	}

	/* Gets string value for the route at current URI (if existing else false returned)
	 * <param> <boolean> get_uri - if true returns uri from routing table, else path
	 * <return> <string> - routing string value from routes configuration data
	 */
	function lroute_get_routed($get_uri = false)
	{
		$routes = lroute_get_routes();
		$uri = luri_get();
		$uri_string = luri_get(true);

		// If uri exists
		if ($uri)
		{
			// If exact route for current uri
			if (isset($routes[$uri_string])) return $get_uri ? $uri_string : $routes[$uri_string];

			// If exact route for current uri (with trailing slash)
			else if (isset($routes[$uri_string."/"])) return $get_uri ? $uri_string."/" : $routes[$uri_string."/"];

			// If no exact uri match
			else
			{
				while (count($uri))
				{
					array_pop($uri);
					$new_uri = luri_join($uri) . "/*";
					if (isset($routes[$new_uri])) return $get_uri ? $new_uri : $routes[$new_uri];
				}
				return false;
			}
		}

		// If no uri but existing root (/) route
		else if (isset($routes["/"])) return $get_uri ? "/" : $routes["/"];

		// Else no route
		else return false;
	}

	/* Gets name of the current controller depending on the routing data and current URI
	 * <return> <string> - name of the current controller
	 */
	function lroute_get_controller()
	{
		$route = lroute_get_routed();
		$uri = luri_get();

		if ($route)
		{
			$route_array = split("/", $route);
			return $route_array[0];
		}
		else return false;
	}

	/* Gets name of the current controller's function depending on the routing data and current URI
	 * <return> <string> - name of the current controller's function
	 */
	function lroute_get_function()
	{
		$route = lroute_get_routed();
		$uri = luri_get();

		if ($route)
		{
			$route_array = split("/", $route);
			if (isset($route_array[1])) return "c".$route_array[0]."_".$route_array[1];
			else return "c".$route_array[0]."_index";
		}
		else if (isset($uri[1])) return "c" . $uri[0] . "_" . $uri[1];
		else if (isset($uri[0])) return "c" . $uri[0] . "_index";
		else return "c" . lconf_get("routes") . "_index";
	}

	/* Gets name of the current controller's item depending on the routing data and current URI
	 * <return> <string> - name of the current controller's item
	 */
	function lroute_get_item()
	{
		$route = lroute_get_routed();
		$route_array = split("/", $route);
		$route_uri = lroute_get_routed(true);
		$uri = luri_get(true);

		if ($route && ($route_uri[strlen($route_uri) - 1] == "*" || count($route_array) >= 3))
		{
			if ($route_uri[strlen($route_uri) - 1] == "*")
			{
				$new_uri = substr_replace($route_uri, "", -1);
				if ($new_uri == "/") $new_uri = "";

				$item = substr_replace($uri, "", 0, strlen($new_uri));

				if (count($route_array) >= 3)
				{
					array_shift($route_array);
					array_shift($route_array);

					$page = luri_join($route_array);
					$item = $page . "/" . $item;
				}
			}
			else
			{
				array_shift($route_array);
				array_shift($route_array);

				$item = luri_join($route_array);
			}
			return $item;
		}
		else return false;
	}

	/* Returns string containing uri for given path
	 * <param> <string> <path> - path to the controller
	 * <param> <string> <uri> - uri from routing table
	 */
	function lroute_get_uri($path)
	{
		$routes = lroute_get_routes();
		$uri_string = "";

		foreach ($routes as $uri => $route_path)
		{
			if ($route_path == $path) $uri_string = $uri;
		}

		if (strlen($uri_string))
		{
			if (strpos($uri_string, "*") !== false) return substr_replace($uri_string, "", -2);
			else return $uri_string;
		}
		else return false;
	}
?>
