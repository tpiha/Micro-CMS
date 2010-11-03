<?php
	lloader_load_helper("breadcrumbs");
	lloader_load_helper("menu");
	lloader_load_model("categories");

	$data["subview"] = "subs/message";
	$data["title"] = "Micro CMS docs tool";
	$data["description"] = "browse Micro CMS libraries documentation";
	$data["mainmenu"] = array(array("link" => lroute_get_uri("docs") . "/libs", "name" => "Libraries"), array("link" => lroute_get_uri("docs") . "/helpers", "name" => "Helpers"), array("link" => lroute_get_uri("docs") . "/models", "name" => "Models"), array("link" => lroute_get_uri("docs") . "/controllers", "name" => "Controllers"));
	$data["submenu"] = array();

	if (!$item)
		foreach($links as $link => $name)
			array_push($data["submenu"], array("link" => "documentation/docs/" . $cat . $link, "name" => $name));
	else
	{
		$data["subview"] = "subs/docs";
		foreach($links as $link => $name)
			array_push($data["submenu"], array("link" => "documentation/docs/" . $cat . "/" . $items . "/#" . $link, "name" => $name, "url" => "*noslash"));
	}

	lloader_load_view("html/index", $data);
?>
