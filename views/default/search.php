<?php
	lloader_load_helper("anchor");
	lloader_load_helper("categories");
	lloader_load_helper("menu");
	lloader_load_helper("breadcrumbs");
	lloader_load_helper("image");
	lloader_load_helper("string");

	$data["title"] = lconf_dbget("title") . " / " . l("Search");
	$data["description"] = lconf_dbget("title") . " " . l("search tool results");
	$data["mainmenu"] = hcategories_menu("", "mainmenu");
	$data["submenu"] = hcategories_menu("", "submenu");
	$data["subview"] = "subs/cat";

	lloader_load_view("html/index", $data);
?>
