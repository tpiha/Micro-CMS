<?php
	lloader_load_helper("anchor");
	lloader_load_helper("string");
	lloader_load_helper("menu");
	lloader_load_model("categories");

	$data["cats"] = mcategories_read_all_ordered();
	$new_cats = array();

	for ($i = 0; $i < count($data["cats"]); $i++)
	{
		$data["cats"][$i]["link"] = mcategories_read_path($data["cats"][$i]["link"], false);
		$data["cats"][$i]["priority"] = number_format(1.00 / count(luri_split($data["cats"][$i]["link"])), 2);
		$cont = mcategories_get_content($data["cats"][$i]["id"]);
		if ($cont) $data["cats"][$i]["date"] = date("Y-m-d", strtotime($cont["updated"]));
		else
		{
			$content = mcontent_read_children($data["cats"][$i]["id"]);
			$new = lconf_dbget("default_time");

			foreach ($content as $cont)
			{
				if (strtotime($cont["updated"]) > $new) $new = strtotime($cont["updated"]);
			}

			$data["cats"][$i]["date"] = date("Y-m-d", $new);
		}

		if (strlen($data["cats"][$i]["link"])) array_push($new_cats, $data["cats"][$i]);
	}

	$data["cats"] = $new_cats;
	header("content-type: text/xml");
	lloader_load_view("html/sitemap", $data);
?>