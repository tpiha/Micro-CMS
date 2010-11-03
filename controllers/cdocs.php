<?php
	/*      cdocs.php - this file is part of Micro CMS
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
	lloader_load("docs");

	lloader_load_helper("anchor");
	lloader_load_helper("form");

	/* Handles displaying root for docs tool
	 */
	function cdocs_index()
	{
		hmessage_set("Welcome to Micro CMS docs tool. This tool is created to make browsing Micro CMS files and reading comments much easier.");
		luri_redirect("docs/cat", "", "libs");
	}

	/* Handles displaying category for docs tool
	 */
	function cdocs_cat($item, $return = false)
	{
		$items = luri_split($item);
		if (count($items) > 1)
		{
			cdocs_file($item);
			die();
		}
		$dir = scandir($item . "/");
		$new_dir = array();
		foreach ($dir as $file)
		{
			if (strstr($file, ".php") !== false)
			{
				$file = split("\.", $file);
				$new_dir[$file[0]] = $file[0];
			}
		}
		$data["links"] = $new_dir;
		$data["cat"] = $item . "/";
		$data["item"] = false;
		if (!$return) lloader_load_file("views/default/docs.php", $data);
		else return $data;
	}

	/* Handles displaying file for docs tool
	 */
	function cdocs_file($item, $return = false)
	{
		$items = luri_split($item);
		$file = lfile_read($item . ".php");
		$file_array = split("\tfunction", $file);
		$data["functions"] = array();
		$data["links"] = array();
		$data["item"] = true;
		$data["cat"] = $items[0];
		$data["items"] = $items[1];
		for ($i = 1; $i < count($file_array); $i++)
		{
			$function = ldocs_get_function($file_array[$i]);
			$return_type = ldocs_get_return_type($file_array[$i - 1], $function);
			$return_text = ldocs_get_return_text($file_array[$i - 1]);
			$function_args = ldocs_get_function_args($file_array[$i]);
			$function_desc = ldocs_get_function_desc($file_array[$i - 1]);
			$params = ldocs_get_params($file_array[$i - 1]);

			$function_obj = array("name" => $function, "return_type" => $return_type, "return_text" => $return_text, "function_args" => $function_args, "function_desc" => $function_desc, "params" => $params);
			$data["links"][$function] = $function;
			array_push($data["functions"], $function_obj);
		}
		if (!$return) lloader_load_file("views/default/docs.php", $data);
		else return $data;
	}

	function cdocs_generate()
	{
		$libs = cdocs_cat("libs", true);
		$libs = $libs["links"];
		$helpers = cdocs_cat("helpers", true);
		$helpers = $helpers["links"];
		$models = cdocs_cat("models", true);
		$models = $models["links"];
		$controllers = cdocs_cat("controllers", true);
		$controllers = $controllers["links"];

		$functions = array();

		foreach($libs as $lib => $name)
		{
			$fncs = cdocs_file("libs/" . $lib, true);
			foreach ($fncs["functions"] as $func)
				array_push($functions, $func);
		}

		foreach($helpers as $helper => $name)
		{
			$fncs = cdocs_file("helpers/" . $helper, true);
			foreach ($fncs["functions"] as $func)
				array_push($functions, $func);
		}

		foreach($models as $model => $name)
		{
			$fncs = cdocs_file("models/" . $model, true);
			foreach ($fncs["functions"] as $func)
				array_push($functions, $func);
		}

		foreach($controllers as $controller => $name)
		{
			$fncs = cdocs_file("controllers/" . $controller, true);
			foreach ($fncs["functions"] as $func)
				array_push($functions, $func);
		}

		lfile_delete("data/docs.txt");

		foreach($functions as $func)
		{
			$function = $func["name"] . "Ì128Í" . "(";
			$finish = ")Ï" . $func["return_type"] . "\r";
			$args = lstring_split($func["function_args"], ",");

			for ($i = 0; $i < count($func["params"]); $i++)
			{
				$type = lstring_replace($func["params"][$i]["type"], " ", "");
				$name = lstring_replace($func["params"][$i]["name"], " ", "");
				if (isset($args[$i]) && lstring_search($args[$i], "="))
				{
					$function .= "[" . $type . " " . $name;
					$finish = "]" . $finish;
				}
				else $function .= $type . " " . $name;
				if ($i < count($func["params"]) - 1) $function .= ", ";
			}

			$function .= $finish;

			lfile_append("data/docs.txt", $function);
		}

		//chmod("data/docs.txt", "0777");

		echo "Generated.";
	}
?>
