<?php
	lloader_load_helper('anchor');
	lloader_load_helper('message');
	lloader_load_helper('login');
	lloader_load_helper('form');
	lloader_load_model('galleries');
	lloader_load_model('settings');
	lloader_load_helper('breadcrumbs');
	lloader_load_helper('image');

	$data['gal'] = mgalleries_read($item);
	$data['cat'] = mcategories_read($data['gal']['link']);
	$data['images'] = mgalleries_read_images($item);

	$data['title'] = msettings_read('title') . ' / ' . l('Update gallery');
	$data['admin_title'] = msettings_read('admin_title');
	$data['mainmenu'] = array(array('name' => 'Home', 'link' => ''), array('name' => 'Admin', 'link' => 'main/user/admin/admin'), array('name' => 'Configuration', 'link' => 'main/user/admin/configuration'), array('name' => 'Publishing', 'link' => 'main/user/admin/publishing'));
	$data['submenu'] = mgalleries_read_all();
	$data['subview'] = 'admin/subs/galleries_update';
	$data['submenu_view'] = 'admin/subs/submenu_gals';
	$data['mainmenu_view'] = 'admin/subs/mainmenu_admin';
	$data['cats'] = mcategories_read_all_ordered();

	lloader_load_view('admin/html/index', $data);
?>
