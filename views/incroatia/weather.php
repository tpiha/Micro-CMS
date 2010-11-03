<?php
	lloader_load_helper('anchor');
	lloader_load_helper('menu');
	lloader_load_helper('form');
	lloader_load_helper('login');
	lloader_load_helper('categories');
	lloader_load_helper('content');
	lloader_load_model('settings');
	lloader_load_model('weather');
	lloader_load_helper('breadcrumbs');

	$data = array();

	$weather = mweather_read_all();

	foreach($weather as $city)
	{
		$data[$city['link']] = $city;
	}

	$data = array_merge($data, hcontent_get_content('weather'));
	$data['mainmenu'] = hcategories_menu('', 'mainmenu');
	$data['submenu'] = hcategories_menu('', 'submenu');
	$data['submenu1'] = hcategories_menu('', 'submenu1');
	$data['submenu2'] = hcategories_menu('', 'submenu2');
	$data['submenu3'] = hcategories_menu('', 'submenu3');
	$data['submenu4'] = hcategories_menu('', 'submenu4');
	$data['subview'] = 'subs/weather';
	$data['advertising'] = hcontent_get_content('advertising');
	$data['quote'] = hcontent_get_content('quote');
	$data['title'] = 'Weather Croatia / Weather / In Croatia';
	$data['description'] = 'Weather Croatia / Weather in Croatian cities Dubrovnik, Zadar, Zagreb, Rjeka, Split, Pula, ...';
	$data['keywords'] = 'weather, croatia, in, dubrovnik, zadar, zagreb, rijeka, split, pula, sibenik';

	lloader_load_view('html/index', $data);
?>
