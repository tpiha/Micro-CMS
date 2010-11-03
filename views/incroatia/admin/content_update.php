<?php
	lloader_load_helper("anchor");
	lloader_load_helper("message");
	lloader_load_helper("login");
	lloader_load_helper("form");
	lloader_load_model("categories");
	lloader_load_model("content");
	lloader_load_model("settings");
	lloader_load_helper("breadcrumbs");

	$content = mcontent_read($item);
	$cat = mcategories_read($content["link"]);

	$data["title"] = msettings_read("title") . " / " . l("Update content");
	$data["admin_title"] = msettings_read("admin_title");
	$data["mainmenu"] = array(array("name" => "Home", "link" => ""), array("name" => "Admin", "link" => "main/user/admin/admin"), array("name" => "Configuration", "link" => "main/user/admin/configuration"), array("name" => "Publishing", "link" => "main/user/admin/publishing"));
	$data['submenu'] = mcontent_read_all_ordered(false);
	$data["subview"] = "admin/subs/content_update";
	$data["submenu_view"] = "admin/subs/submenu_content";
	$data["content"] = $content;
	$data["content"]["date"] = date("Y-m-d", strtotime($data["content"]["time"]));
	$data["content"]["time"] = date("H:i", strtotime($data["content"]["time"]));
	$data["cat"] = $cat;
	$data["cats"] = mcategories_read_all_ordered();
	$data["mainmenu_view"] = "admin/subs/mainmenu_admin";

	lloader_load_view("admin/html/index", $data);
?>
