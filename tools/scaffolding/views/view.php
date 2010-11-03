<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8"></meta>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?=hanchor_href("views/main/css/scaffolding.css", false)?>" media="screen" />
		<link rel="icon" href="<?=hanchor_href("views/main/img/favicon.ico", false)?>" />
	</head>

	<body>
		<h1><?=l("Micro CMS scaffolding tool - ***NAME***")?></h1>
		<h3><?=l("Create database tables, controllers, models and views in few clicks.")?></h3>
		<div style="position: relative; height: 10px;"></div>
<?lloader_load_view($subview, $data)?>
	</body>

</html>
