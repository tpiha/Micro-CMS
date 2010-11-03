<?php
	lloader_load_helper("anchor");
	lloader_load_helper("message");
	lloader_load_helper("login");
	lloader_load_model("settings");
	lloader_load_helper("breadcrumbs");
	lloader_load_helper("menu");

	$data["title"] = msettings_read("title") . " / " . l("Configuration");
	$data["admin_title"] = msettings_read("admin_title");
	$data["mainmenu"] = array(array("name" => "Home", "link" => ""), array("name" => "Admin", "link" => "main/user/admin/admin"), array("name" => "Configuration", "link" => "main/user/admin/configuration"), array("name" => "Publishing", "link" => "main/user/admin/publishing"));
	$data["submenu"] = array(array("name" => "Settings", "link" => "main/user/admin/settings"), array("name" => "Profile", "link" => "main/user/admin/profile"));
	$data["subview"] = "admin/subs/message";
	$data["submenu_view"] = "admin/subs/submenu_admin";
	$data["mainmenu_view"] = "admin/subs/mainmenu_admin";

	lloader_load_view("admin/html/index", $data);
?>
