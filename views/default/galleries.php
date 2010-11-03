<?php
	lloader_load_helper('anchor');
	lloader_load_helper('menu');
	lloader_load_helper('form');
	lloader_load_helper('login');
	lloader_load_helper('categories');
	lloader_load_helper('content');
	lloader_load_model('settings');
	lloader_load_model('galleries');
	lloader_load_helper('breadcrumbs');

	$data = array();
	$data['galleries'] = mgalleries_read_all();

	for($i = 0; $i < count($data['galleries']); $i++)
	{
		$image = mgalleries_read_images($data['galleries'][$i]['id']);
		$data['galleries'][$i]['image'] = $image[0];
	}

	$data = array_merge($data, hcontent_get_content('galleries'));
	$data['mainmenu'] = hcategories_menu('', 1);
	$data['submenu'] = hcategories_menu('', 'galleries');
	$data['subview'] = 'subs/galleries';

	lloader_load_view('html/index', $data);
?>
