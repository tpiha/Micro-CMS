<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8"></meta>
		<title><?=$title?></title>
		<meta name="robots" content="index,follow" />
		<meta name="description" content="<?=@$description?>"></meta>
		<meta name="keywords" content="<?=@$keywords?>"></meta>
		<meta name="verify-v1" content="YhJb+sADb3QX6UjDaNiihdTBtkNDqq7s/4Wnu6pKWzI=" />

		<link rel="stylesheet" type="text/css" href="<?=hanchor_theme("css/style.css")?>" media="screen" />
		<link rel="icon" href="<?=hanchor_shref("favicon.ico", false)?>" />
		<link rel="alternate" type="application/rss+xml" href="<?=hanchor_shref("rss.xml", false)?>" />

		<script type="text/javascript" src="<?=hanchor_href("main/index/js/variables.js", false, false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref("extern/jquery_old.js", false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref("extern/jquery_lightbox/js/lightbox.js", false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_theme("js/script.js", false, false)?>"></script>
		<link rel="stylesheet" type="text/css" href="<?=hanchor_shref("extern/jquery_lightbox/css/jquery.lightbox-0.5.css", false)?>" media="screen" />
	</head>

	<body>
		<div class="wrapper">

			<div class="header">
				<div class="logo">
					<a href="<?=hanchor_shref()?>"><img src="<?=hanchor_theme("img/micro_cms_logo.jpg")?>" alt="<?=lconf_dbget("title")?>" title="<?=lconf_dbget("title")?>" /></a><br />
					<strong><?=lconf_dbget("description")?></strong>
				</div>
				<div class="menu">
					<ul>
<?php for($i = count($mainmenu) - 1; $i >= 0; $i--): ?>
						<li><a class="<?=hanchor_class("main/item/content", "link1", "link1active", $mainmenu[$i]["link"]);?>" href="<?=hmenu_href("main/item/content", $mainmenu[$i]["link"], @$mainmenu[$i]["url"])?>"<?=(isset($mainmenu[$i]["url"]) && strlen($mainmenu[$i]["url"])?'target="_blank"':'')?>><?=$mainmenu[$i]["name"]?></a></li>
<?php endfor; ?>
					</ul>
					<form action="<?=hanchor_href("content/search")?>" class="search" method="post">
						<p>
							<input type="text" value="Keywords" name="keywords" onfocus="this.value='';" onblur="if (this.value == '') this.value='Keywords';" />
							<input type="submit" value="Search" class="submit" />
						</p>
					</form>
				</div>
			</div>

			<div class="crumbs"><?=hbreadcrumbs()?></div>

			<div class="first">
				<ul>
<?php foreach($submenu as $submenu_item): ?>
					<li><a class="<?=hanchor_class("main/index/content", "link1", "link1active", $submenu_item["link"]);?>" href="<?=hmenu_href("main/item/content", @$submenu_item["link"], @$submenu_item["url"])?>"<?=(isset($submenu_item["url"]) && strlen($submenu_item["url"]) && !lstring_search($submenu_item["url"], "*")?'target="_blank"':'')?>><?=$submenu_item["name"]?></a></li>
<?php endforeach; ?>
				</ul>
			</div>

			<div class="second">
				<script type="text/javascript">
					document.write('<div id="content" style="display: none;">');
				</script>
				<div class="content_holder">

					<?lloader_load_view($subview, $data)?>

				</div>
				<script type="text/javascript">
					document.write('</div>');
				</script>
			</div>

			<div class="third">
			</div>

			<div class="footer"><div style="float: left;">Powered by <a href="http://tpiha.kset.org/">Micro CMS</a> | <a href="<?=hanchor_href("main/user/admin/admin")?>">Admin</a></div><div style="float: right;">Design inspired by <a href="http://www.solucija.com/" target="_blank">Luka Cvrk</a> | Copyright &copy; <a href="<?=hanchor_href("main/index/contact") ?>">Micro CMS</a> | Released under <a href="http://www.gnu.org/copyleft/lesser.html" target="_blank">LGPL</a> license.</div></div>

		</div>
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
			</script>
			<script type="text/javascript">
			try {
			var pageTracker = _gat._getTracker("UA-6090001-3");
			pageTracker._trackPageview();
			} catch(err) {}
		</script>
		<div style="display:none;">
			<!-- BEGIN ISTATS.COM COUNTER CODE -->
			<SCRIPT LANGUAGE="JavaScript">
			<!--
			var is_host = 'c1';
			var is_project = '131';
			var is_project_key = '54FBA9E1';
			//-->
			</SCRIPT>
			<SCRIPT LANGUAGE="JavaScript" SRC="http://js.istats.com/js/istats-counter.js"></SCRIPT>
			<NOSCRIPT>
			<A href="http://www.istats.com" title="iStats - Best Free Web Tracker and Counter"><IMG src="http://c1.istats.com/counter/counter.php?id=131&amp;k=54FBA9E1" alt="iStats - Free Web Tracker and Counter"></A>
			<A href="http://www.seoparking.com"><IMG src="http://js.istats.com/images/1x1.gif" width="1" height="1" alt=""></A>
			</NOSCRIPT>
			<!-- END ISTATS.COM COUNTER CODE -->
		</div>
	</body>

</html>