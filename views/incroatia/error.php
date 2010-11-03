<?php
	lloader_load_helper('anchor');
	lloader_load_helper('menu');
	lloader_load_helper('form');
	lloader_load_helper('login');
	lloader_load_helper('categories');
	lloader_load_helper('content');
	lloader_load_model('settings');
	lloader_load_helper('breadcrumbs');

	$data['mainmenu'] = hcategories_menu('', 'mainmenu');
	$data['submenu'] = hcategories_menu('', 'submenu');
	$data['submenu1'] = hcategories_menu('', 'submenu1');
	$data['submenu2'] = hcategories_menu('', 'submenu2');
	$data['submenu3'] = hcategories_menu('', 'submenu3');
	$data['submenu4'] = hcategories_menu('', 'submenu4');
	$data['subview'] = 'subs/error';
	$data['title'] = lconf_dbget('title') . ' / ' . l('Error 404');
	$data['description'] = lconf_dbget('title') . ' ' . l('error 404');

	hmessage_set($data['message']);

	lloader_load_view('html/index', $data);
?>
