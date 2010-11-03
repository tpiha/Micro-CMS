<?php
	/*      mscaffolding.php - this file is part of Micro CMS
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

	lloader_load("file");

	/* Creates database table
	 */
	function mscaffolding_create_table($name, $data)
	{
		$query_string = "CREATE TABLE `" . lconf_get("db_name") . "`.`" . $name . "` (`id` INT NOT NULL AUTO_INCREMENT,";

		for ($i = 0; $i < count($data) / 2; $i++)
		{
			$query_string .= "`" . $data["name" . $i] . "`" . mscaffolding_get_type($data["type" . $i]);
		}

		$query_string .= " PRIMARY KEY ( `id` )) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_slovenian_ci";

		return ldb_query($query_string);
	}

	/* Gets sql string for variable type
	 */
	function mscaffolding_get_type($type)
	{
		switch($type)
		{
			case "string":
				return " VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,";
			case "text":
				return " TEXT CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,";
			case "boolean":
				return " TINYINT NOT NULL,";
			case "integer":
				return " INT NOT NULL,";
			default:
				return " INT NOT NULL,";
		}
	}

	/* Prepares scaffolding directories
	 */
	function mscaffolding_prepare_directories($name)
	{
		mkdir("data/scaffolding/" . $name);
		mkdir("data/scaffolding/" . $name . "/views");
	}

	/* Creates controller
	 */
	function mscaffolding_create_controller($name)
	{
		$controller = lfile_read("tools/scaffolding/controller.php");
		$controller = str_replace("***NAME***", $name, $controller);
		return lfile_write("data/scaffolding/" . $name . "/c" . $name . ".php", $controller);
	}

	/* Creates model
	 */
	function mscaffolding_create_model($name, $structure_data)
	{
		$model = lfile_read("tools/scaffolding/model.php");
		$model = str_replace("***NAME***", $name, $model);
		$str_struct = "";
		for ($i = 0; $i < count($structure_data) / 2; $i++)
		{
			$str_struct .= '"' . $structure_data["name" . $i] . '" => "' . $structure_data["type" . $i] . '"';
			if ($i < count($structure_data) / 2 - 1) $str_struct .= ', ';
		}
		$model = str_replace("***STRUCTURE***", $str_struct, $model);
		return lfile_write("data/scaffolding/" . $name . "/m" . $name . ".php", $model);
	}

	/* Creates main view
	 */
	function mscaffolding_create_main_view($name)
	{
		$view = lfile_read("tools/scaffolding/views/view.php");
		$view = str_replace("***NAME***", $name, $view);
		return lfile_write("data/scaffolding/" . $name . "/views/" . $name . ".php", $view);
	}

	/* Creates routes
	 */
	function mscaffolding_create_routes($name)
	{
		$routes = lfile_read("tools/scaffolding/routes_real.php");
		$routes = str_replace("***NAME***", $name, $routes);
		lfile_write("data/scaffolding/" . $name . "/routes_real.php", $routes);

		$routes = lfile_read("tools/scaffolding/routes.php");
		$routes = str_replace("***NAME***", $name, $routes);
		return lfile_write("data/scaffolding/" . $name . "/routes.php", $routes);
	}

	/* Creates read view
	 */
	function mscaffolding_create_read_view($name, $structure_data)
	{
		$view = lfile_read("tools/scaffolding/views/view_read.php");
		$view = str_replace("***NAME***", $name, $view);
		for ($i = 0; $i < count($structure_data) / 2; $i++)
		{
			$varname = $structure_data["name" . $i];
			$vartype = $structure_data["type" . $i];;
			$small_view = lfile_read("tools/scaffolding/views/display/" . $vartype . ".html");
			$small_view = str_replace("***VARNAME***", $name, $small_view);
			$small_view = str_replace("***VARINDEX***", $varname, $small_view);
			$view .= $small_view;
		}
		return lfile_write("data/scaffolding/" . $name . "/views/" . $name . "_read.php", $view);
	}

	/* Creates index view
	 */
	function mscaffolding_create_index_view($name, $structure_data)
	{
		$view = lfile_read("tools/scaffolding/views/view_index.php");
		$view = str_replace("***NAME***", $name, $view);
		return lfile_write("data/scaffolding/" . $name . "/views/" . $name . "_index.php", $view);
	}

	/* Creates create view
	 */
	function mscaffolding_create_create_view($name, $structure_data)
	{
		$view = lfile_read("tools/scaffolding/views/view_create.php");
		$view = str_replace("***NAME***", $name, $view);
		for ($i = 0; $i < count($structure_data) / 2; $i++)
		{
			$varname = $structure_data["name" . $i];
			$vartype = $structure_data["type" . $i];;
			$small_view = lfile_read("tools/scaffolding/views/forms/" . $vartype . ".html");
			$small_view = str_replace("***NAME***", $name, $small_view);
			$small_view = str_replace("***INDEX***", $varname, $small_view);
			$view .= $small_view;
		}
		$small_view = lfile_read("tools/scaffolding/views/view_create_close.php");
		$view .= str_replace("***NAME***", $name, $small_view);
		return lfile_write("data/scaffolding/" . $name . "/views/" . $name . "_create.php", $view);
	}

	/* Creates update view
	 */
	function mscaffolding_create_update_view($name, $structure_data)
	{
		$view = lfile_read("tools/scaffolding/views/view_update.php");
		$view = str_replace("***NAME***", $name, $view);
		for ($i = 0; $i < count($structure_data) / 2; $i++)
		{
			$varname = $structure_data["name" . $i];
			$vartype = $structure_data["type" . $i];;
			$small_view = lfile_read("tools/scaffolding/views/forms/" . $vartype . ".html");
			$small_view = str_replace("***NAME***", $name, $small_view);
			$small_view = str_replace("***INDEX***", $varname, $small_view);
			$view .= $small_view;
		}
		$small_view = lfile_read("tools/scaffolding/views/view_update_close.php");
		$view .= str_replace("***NAME***", $name, $small_view);
		return lfile_write("data/scaffolding/" . $name . "/views/" . $name . "_update.php", $view);
	}
?>
