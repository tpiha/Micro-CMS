<?php
	/*      cscaffolding.php - this file is part of Micro CMS
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

	lloader_load_helper("anchor");
	lloader_load_helper("form");
	lloader_load_helper("message");

	lloader_load_model("scaffolding");

	/* Handles scaffolding tool index
	 */
	function cscaffolding_index()
	{
		lloader_load_file("views/main/scaffolding.php");
	}

	/* Handles scaffolding tool creation
	 */
	function cscaffolding_create()
	{
		$post_data = linput_post();
		unset($post_data["inname"]);
		unset($post_data["intype"]);

		$name = $post_data["name"];
		unset($post_data["name"]);

		mscaffolding_create_table($name, $post_data);
		mscaffolding_prepare_directories($name);
		mscaffolding_create_controller($name);
		mscaffolding_create_model($name, $post_data);
		mscaffolding_create_main_view($name);
		mscaffolding_create_read_view($name, $post_data);
		mscaffolding_create_index_view($name, $post_data);
		mscaffolding_create_create_view($name, $post_data);
		mscaffolding_create_update_view($name, $post_data);
		mscaffolding_create_routes($name);

		lloader_load_file("data/scaffolding/" . $name . "/routes.php");

		luri_redirect(lroute_get_uri($name));
	}

	/* Handles scaffolding tool test runs
	 */
	function cscaffolding_run($link)
	{
		global $gconf;
		$link = luri_split($link);
		$item = $link[0];
		lloader_load_file("data/scaffolding/" . $item . "/c" . $item . ".php");
		lloader_load_file("data/scaffolding/" . $item . "/routes.php");
		lloader_load_file("data/scaffolding/" . $item . "/m" . $item . ".php");

		$controller = lroute_get_controller();
		$gconf["theme"] = "../data/scaffolding/" . $item . "/views/";

		$function = lroute_get_function();
		$item = lroute_get_item();

		if ($controller)
		{
			if (function_exists($function)) $function($item);
			else lerror_generate_404(l("Error 404. Function '").$function.l("' doesn't exist."));
		}
		else lerror_generate_404(l("Error 404. Controller route at '").$uri_string.l("' not found."));

		// Close database link if opened
		@ldb_close();
	}
?>
