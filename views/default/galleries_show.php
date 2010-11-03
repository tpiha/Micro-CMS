<?php
	lloader_load_helper('anchor');
	lloader_load_helper('menu');
	lloader_load_helper('form');
	lloader_load_helper('login');
	lloader_load_helper('categories');
	lloader_load_helper('content');
	lloader_load_model('settings');
	lloader_load_model('galleries');
	lloader_load_model('categories');
	lloader_load_helper('breadcrumbs');
	lloader_load_helper('pagination');

	$item = luri_split($item);

	if (count($item) < 2) luri_redirect('main/item/galleries_show', false, $item[0] . '/1');

	$page = $item[1];
	$item = $item[0];

	$data = array();
	$data['gallery'] = mgalleries_read($item);
	$data['category'] = mcategories_read($item);
	$data['images'] = mgalleries_read_images_page($item, $page);
	$data['title'] = lconf_dbget('title') . ' / ' . $data['gallery']['name'];
	$data['keywords'] = $data['gallery']['keywords'];
	$data['description'] = $data['gallery']['description'];
	$data['pagination'] = hpagination('main/item/galleries_show', mgalleries_count_images($item), 9, $item . '/' . $page);
	$data['mainmenu'] = hcategories_menu('', 1);
	$data['submenu'] = hcategories_menu('', 'galleries');
	$data['subview'] = 'subs/galleries_show';

	lloader_load_view('html/index', $data);
?>
