<?php
	lloader_load_helper("anchor");
	lloader_load_helper("message");
	lloader_load_helper("login");
	lloader_load_helper("form");
	lloader_load_model("galleries");
	lloader_load_model("settings");
	lloader_load_helper("breadcrumbs");
	lloader_load_helper("image");

	$data['image'] = lcrud_read_simple(llang_table('images'), $item);
	$data['gal'] = lcrud_read_simple(llang_table('galleries'), $data['image']['gallery_id']);

	$data["title"] = msettings_read("title") . " / " . l("Update image");
	$data["admin_title"] = msettings_read("admin_title");
	$data["mainmenu"] = array(array("name" => "Home", "link" => ""), array("name" => "Admin", "link" => "main/user/admin/admin"), array("name" => "Configuration", "link" => "main/user/admin/configuration"), array("name" => "Publishing", "link" => "main/user/admin/publishing"));
	$data["submenu"] = mgalleries_read_all();
	$data["subview"] = "admin/subs/galleries_image_update";
	$data["submenu_view"] = "admin/subs/submenu_gals";
	$data["mainmenu_view"] = "admin/subs/mainmenu_admin";

	lloader_load_view("admin/html/index", $data);
?>
