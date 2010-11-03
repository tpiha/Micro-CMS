<?php
	lloader_load_helper("anchor");
	lloader_load_helper("string");
	lloader_load_model("content");
	lloader_load_model("categories");

	$data["content"] = mcontent_read_all_ordered();

	for ($i = 0; $i < count($data["content"]); $i++)
	{
		$data["content"][$i]["link"] = mcategories_read_path($data["content"][$i]["link"], false);
	}

	$data["title"] = lconf_dbget("title");
	$data["description"] = lconf_dbget("description");

	header ("content-type: text/xml");
	lloader_load_view("html/rss", $data);
?>