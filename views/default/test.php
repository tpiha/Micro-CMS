<?php
	lloader_load_helper('menus');
	lloader_load_helper('content');
	lloader_load_helper('search');

	$data['view'] = 'html/index';
	$data['subview'] = 'subs/test';

	lloader_load_view($data['view'], $data);
?>