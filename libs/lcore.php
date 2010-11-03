<?php
	/*      lcore.php - this file is part of Micro CMS
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

	require_once('libs/lloader.php');

	// Load local config file if on .loc domain (development domain)
	if (strpos($_SERVER['HTTP_HOST'], '.loc') === false) lloader_load_conf('config');
	else lloader_load_conf('config.local');

	lloader_load_conf('routes');
	lloader_load_conf('modules');

	lloader_load('conf');
	lloader_load('crud');
	lloader_load('db');
	lloader_load('uri');
	lloader_load('error');
	lloader_load('lang');
	lloader_load('route');
	lloader_load('cache');
	lloader_load('file');
	lloader_load('string');
	lloader_load('crud');
	lloader_load('installation');

	// Array containing configuration variables (name => value pairs)
	global $gconf;
	// Array containing language variables (translation pairs)
	global $glang;
	// Database connection resource
	global $glink;

	/* Initializes system
	 */
	function lcore_init()
	{
		//if (linstallation_check()) linstallation_install();

		$tools = (bool) lconf_dbget('tools');
		$uri_string = luri_get(true);

		if ($tools) lloader_load_conf('routes_tools');

		if (lcache_is_enabled() && lcache_is_cached($uri_string)) lcache_read($uri_string);
		else
		{
			if (lcache_is_enabled()) lcache_start();

			$controller = lroute_get_controller();
			$function = lroute_get_function();
			$item = lroute_get_item();

			if ($controller)
			{
				lloader_load_controller($controller);

				if (function_exists($function)) $function($item);

				else lerror_generate_404(l('Error 404. Function \'').$function.l('\' doesn\'t exist.'));
			}
			else lerror_generate_404(l('Error 404. Controller route at \'').$uri_string.l('\' not found.'));

			if (lcache_is_enabled()) lcache_stop();

			ldb_close();
		}
	}

	// Calls system init
	lcore_init();
?>
