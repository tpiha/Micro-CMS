<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8"></meta>
		<title><?=$title?></title>

		<link rel="stylesheet" type="text/css" href="<?=hanchor_shref("views/" . lconf_get("theme") . "/admin/css/style.css", false)?>" />
		<link rel="icon" href="<?=hanchor_shref("favicon.ico", false)?>">
		<link rel="stylesheet" type="text/css" href="<?=hanchor_shref("extern/jquery-ui/theme/ui.theme.css", false)?>" />
		<link rel="stylesheet" type="text/css" href="<?=hanchor_shref("extern/jquery-ui/theme/ui.datepicker.css", false)?>" />

		<script type="text/javascript" src="<?=hanchor_href("main/index/js/variables.js", false, false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref("extern/jquery.js", false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref("extern/jquery-ui/jquery-ui.js", false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref("admin/javascript/admin.js", false)?>"></script>
	</head>

	<body>
		<div class="wrapper">

			<div class="header">
				<div class="logo">
					<h1><a href="<?=hanchor_shref()?>" class="link2"><?=lconf_dbget("title")?></a></h1>
					<strong><?=lconf_dbget("admin_title")?></strong>
				</div>
				<div class="menu">
					<?lloader_load_view($mainmenu_view, $data);?>
					<form action="<?=hanchor_href("content/search")?>" class="search" method="post">
						<p>
							<input type="text" value="Keywords" name="keywords" />
							<input type="submit" value="Search" class="submit" />
						</p>
					</form>
				</div>
			</div>

			<div class="crumbs"><?=hbreadcrumbs_admin()?></div>

			<div class="first">
				<?lloader_load_view($submenu_view, $data);?>
			</div>

			<div class="second">
				<div id="content" style="display: none;">
				<div class="content_holder">

					<?lloader_load_view($subview, $data)?>

				</div>
				</div>
			</div>

			<div class="third">
			</div>

			<div class="footer"><div style="float: left;">Powered by <a href="http://tpiha.kset.org/">Micro CMS</a> | <a href="<?=hanchor_href("main/user/admin/admin")?>">Admin</a> | <?=hlogin_link()?></div><div style="float: right;">Design inspired by <a href="http://www.solucija.com/" target="_blank">Luka Cvrk</a> | Copyright &copy; <a href="<?=hanchor_href("main/index/contact") ?>">Micro CMS</a> | Released under <a href="http://www.gnu.org/copyleft/lesser.html" target="_blank">LGPL</a> license.</div></div>

		</div>
	</body>

</html>
