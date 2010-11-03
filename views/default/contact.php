<?php
	lloader_load_helper("anchor");
	lloader_load_helper("menu");
	lloader_load_helper("form");
	lloader_load_helper("login");
	lloader_load_helper("categories");
	lloader_load_helper("content");
	lloader_load_model("settings");
	lloader_load_helper("breadcrumbs");

	$data = array();

	$data = array_merge($data, hcontent_get_content("contact"));
	$data["mainmenu"] = hcategories_menu("", 1);
	$data["submenu"] = hcategories_menu("", "submenu");
	$data["subview"] = "subs/contact";

	lloader_load_view("html/index", $data);
?>
