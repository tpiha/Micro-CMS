<?php
	lloader_load_helper("anchor");
	lloader_load_helper("message");
	lloader_load_helper("login");
	lloader_load_helper("breadcrumbs");
	lloader_load_model("settings");
	lloader_load_model("langs");
	lloader_load_helper("menu");

	$data["title"] = msettings_read("title") . " / " . l("Admin");
	$data["admin_title"] = msettings_read("admin_title");
	$data["mainmenu"] = array(array("name" => "Home", "link" => ""), array("name" => "Admin", "link" => "main/user/admin/admin"), array("name" => "Configuration", "link" => "main/user/admin/configuration"), array("name" => "Publishing", "link" => "main/user/admin/publishing"));
	$data["submenu"] = mlangs_read();
	$data["subview"] = "admin/subs/message";
	$data["submenu_view"] = "admin/subs/submenu_index";
	$data["mainmenu_view"] = "admin/subs/mainmenu_admin";

	lloader_load_view("admin/html/index", $data);
?>
