<?php
	/*      lerror.php - this file is part of Micro CMS
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

	/* Generates error report from given message
	 * <param> <string> message - message string that should be displayed in error report
	 */
	function lerror_generate($message)
	{
		$routes = lroute_get_routes();
		$controller = lroute_get_controller();

		if ($controller && function_exists("c" . $controller . "_error"))
		{
			$function = "c" . $controller . "_error";
			$function($message);
		}
		else if (isset($routes["/"]) && function_exists("c" . $routes["/"] . "_error"))
		{
			$function = "c" . $routes["/"] . "_error";
			$function($message);
		}
		else
		{
			$data["message"] = $message;
			lloader_load_helper("anchor");
			if (!lloader_load_view("error", $data))
			{
				if (!lloader_load_file("views/default/error.php", $data)) echo $message;
			}
		}
		die();
	}

	/* Generates HTTP 404 error report from given message
	 * <param> <string> message - message string that should be displayed in error report
	 */
	function lerror_generate_404($message)
	{
		header("HTTP/1.0 404 Not Found");
		header("Status: 404");
		header('Content-Type: text/html; charset=utf-8');
		lerror_generate($message);
	}

	/* Logs error report with given message to the log file
	 * <param> <string> message - message string that should be logged in error report
	 * <return> <boolean> - true on success, else false
	 */
	function lerror_log($message)
	{
		return lfile_append("data/error_log.txt", date('j.n.y. - G:i') . " * " . $message . "\r\n");
	}

	/* Deletes the error log file
	 * <return> <boolean> - returns true if error log file deleted, else returns false
	 */
	function lerror_log_delete()
	{
		if (file_exists("data/error_log.txt")) return unlink("data/error_log.txt");
		else return false;
	}
?>
