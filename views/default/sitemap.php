<?php
	lloader_load_helper("anchor");
	lloader_load_helper("menu");
	lloader_load_helper("form");
	lloader_load_helper("login");
	lloader_load_helper("categories");
	lloader_load_helper("content");
	lloader_load_model("settings");
	lloader_load_helper("breadcrumbs");
	lloader_load_helper("menu");

	$data = array();

	$data = array_merge($data, hcontent_get_content("sitemap"));
	$data["mainmenu"] = hcategories_menu("", 1);
	$data["submenu"] = hcategories_menu("", "submenu");
	$data["subview"] = "subs/sitemap";
	$data["cats"] = mcategories_read_all_ordered();
	$data["parent_cats"] = mcategories_read_group(0, true);

	for ($i = 0; $i < count($data["cats"]); $i++)
	{
		$data["cats"][$i]["link"] = mcategories_read_path($data["cats"][$i]["link"], false);
	}

	lloader_load_view("html/index", $data);
?>
