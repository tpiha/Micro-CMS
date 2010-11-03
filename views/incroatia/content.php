<?php
	lloader_load_helper('anchor');
	lloader_load_helper('menu');
	lloader_load_helper('message');
	lloader_load_helper('login');
	lloader_load_helper('form');
	lloader_load_helper('categories');
	lloader_load_helper('content');
	lloader_load_helper('string');
	lloader_load_helper('image');
	lloader_load_helper('breadcrumbs');
	lloader_load_model('comments');

	$data = array_merge($data, hcontent_get_content($item));

	if (!$data['content'])
	{
		$data = array_merge($data, hcontent_get_cat($item));
		if (!$data['cat']) lerror_generate_404(l('Error 404. Page at \'') . $item . l('\' doesn\'t exist.'));
		else $data['subview'] = 'subs/cat';
	}
	else
	{
		$data['comments'] = mcomments_read(CONT, $item);
		$data['comments_num'] = mcomments_count(CONT, $item);
		$data['subview'] = 'subs/content';
	}

	$data['mainmenu'] = hcategories_menu('', 'mainmenu');
	$data['submenu'] = hcategories_menu($item, 'submenu');
	$data['submenu1'] = hcategories_menu($item, 'submenu1');
	$data['submenu2'] = hcategories_menu($item, 'submenu2');
	$data['submenu3'] = hcategories_menu($item, 'submenu3');
	$data['submenu4'] = hcategories_menu($item, 'submenu4');
	$data['advertising'] = hcontent_get_content('advertising');
	$data['quote'] = hcontent_get_content('quote');

	lloader_load_view('html/index', $data);
?>
