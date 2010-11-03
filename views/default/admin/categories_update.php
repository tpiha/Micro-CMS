<?php
	lloader_load_helper("anchor");
	lloader_load_helper("message");
	lloader_load_helper("login");
	lloader_load_helper("form");
	lloader_load_model("categories");
	lloader_load_model("settings");
	lloader_load_helper("breadcrumbs");

	$cat = mcategories_read($item);
	$cats = mcategories_read_all_ordered();

	if (lstring_search($cat["url"], "javascript:window.open('")) $cat["new_window"] = 1;
	else $cat["new_window"] = 0;
	$cat["url"] = lstring_replace($cat["url"], "javascript:window.open('", "");
	$cat["url"] = lstring_replace($cat["url"], "');void null;", "");

	$data["title"] = msettings_read("title") . " / " . l("Update category");
	$data["admin_title"] = msettings_read("admin_title");
	$data["mainmenu"] = array(array("name" => "Home", "link" => ""), array("name" => "Admin", "link" => "main/user/admin/admin"), array("name" => "Configuration", "link" => "main/user/admin/configuration"), array("name" => "Publishing", "link" => "main/user/admin/publishing"));
	$data["submenu"] = mcategories_read_group($item, false);
	$data["subview"] = "admin/subs/categories_update";
	$data["submenu_view"] = "admin/subs/submenu_cats";
	$data["cat"] = $cat;
	$data["cats"] = $cats;
	$data["mainmenu_view"] = "admin/subs/mainmenu_admin";

	lloader_load_view("admin/html/index", $data);
?>
