<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8"></meta>
		<title>Micro CMS / <?=l('Installation')?></title>

		<link rel="stylesheet" type="text/css" href="<?=hanchor_shref("views/" . lconf_get("theme") . "/admin/css/style.css", false)?>" />
		<link rel="icon" href="<?=hanchor_shref("favicon.ico", false)?>">
	</head>

	<body>
		<div class="wrapper">

			<div class="header">
				<div class="logo">
					<h1><a href="<?=hanchor_shref()?>" class="link2">Micro CMS / Installation</a></h1>
					<strong></strong>
				</div>
			</div>

			<div class="crumbs"></div>

			<div class="first">
			</div>

			<div class="second">
				<div id="content">
				<div class="content_holder">
					<?lloader_load_view($subview, $data)?>
				</div>
				</div>
			</div>

			<div class="third">
			</div>

			<div class="footer"><div style="float: left;">Powered by <a href="http://tpiha.kset.org/">Micro CMS</a></div><div style="float: right;">Design inspired by <a href="http://www.solucija.com/" target="_blank">Luka Cvrk</a> | Copyright &copy; <a href="<?=hanchor_href("main/index/contact") ?>">Micro CMS</a> | Released under <a href="http://www.gnu.org/copyleft/lesser.html" target="_blank">LGPL</a> license.</div></div>

		</div>
	</body>

</html>