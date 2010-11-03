<?php
	lloader_load_helper('anchor');
	lloader_load_helper('categories');
	lloader_load_helper('menu');
	lloader_load_helper('breadcrumbs');
	lloader_load_helper('image');
	lloader_load_helper('string');
	lloader_load_helper('content');

	$data['title'] = lconf_dbget('title') . ' / ' . l('Search');
	$data['description'] = lconf_dbget('title') . ' ' . l('search tool results');
	$data['mainmenu'] = hcategories_menu('', 'mainmenu');
	$data['submenu'] = hcategories_menu('', 'submenu');
	$data['submenu1'] = hcategories_menu('', 'submenu1');
	$data['submenu2'] = hcategories_menu('', 'submenu2');
	$data['submenu3'] = hcategories_menu('', 'submenu3');
	$data['submenu4'] = hcategories_menu('', 'submenu4');
	$data['subview'] = 'subs/cat';
	$data['advertising'] = hcontent_get_content('advertising');
	$data['quote'] = hcontent_get_content('quote');

	lloader_load_view('html/index', $data);
?>
