<?php
	lloader_load_helper("anchor");
	lloader_load_helper("form");
	lloader_load_helper("message");
	lloader_load_helper("login");
	lloader_load_model("categories");
	lloader_load_model("settings");
	lloader_load_helper("breadcrumbs");
	lloader_load_helper("categories");
	lloader_load_helper("content");

	$data["title"] = msettings_read("title") . " / " . l("Login");
	$data["admin_title"] = msettings_read("admin_title");
	$data = array_merge($data, hcontent_get_content("contact"));
	$data["mainmenu"] = hcategories_menu("", "mainmenu");
	$data["submenu"] = hcategories_menu("", "submenu");
	$data["subview"] = "admin/subs/login";
	$data["submenu_view"] = "admin/subs/submenu_login";
	$data["mainmenu_view"] = "admin/subs/mainmenu_login";

	lloader_load_view("admin/html/index", $data);
?>
