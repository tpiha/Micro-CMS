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

	$data = array_merge($data, hcontent_get_content('photos-galleries'));
	$data['mainmenu'] = hcategories_menu('', 1);
	$data['submenu'] = hcategories_menu('', 'photos-galleries');
	$data['submenu1'] = hcategories_menu('', 'submenu1');
	$data['submenu2'] = hcategories_menu('', 'submenu2');
	$data['submenu3'] = hcategories_menu('', 'submenu3');
	$data['submenu4'] = hcategories_menu('', 'submenu4');
	$data['subview'] = 'subs/galleries';
	$data['advertising'] = hcontent_get_content('advertising');
	$data['quote'] = hcontent_get_content('quote');
	$data['description'] = 'In Croatia / Photos and galleries of Dubrovnik, Cavtat, Zadar, Hvar, Split, Trogir, Motovun and other cities in Croatia.';
	$data['keywords'] = 'in, croatia, photos, galleries, dubrovnik, cavtat, zadar, hvar, split, trogir, motovun, cities, beaches';

	lloader_load_view('html/index', $data);
?>
