<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8"></meta>
		<title><?=$title?></title>
		<meta name="robots" content="index,follow" />
		<meta name="description" content="<?=@$description?>"></meta>
		<meta name="keywords" content="<?=@$keywords?>"></meta>
		<meta name="verify-v1" content="Tj5aXFry1HXG3UrTltklOpml5TFuge3/LvneHYjm/8s=" />

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
	<div id="content">
		<div id="top">
			<p>
<?php foreach($mainmenu as $mainmenu_item): ?>
				<a class="<?=hanchor_class("main/item/content", "link1", "link1active", $mainmenu_item["link"]);?>" href="<?=hmenu_href("main/item/content", $mainmenu_item["link"], @$mainmenu_item["url"])?>"<?=(isset($mainmenu_item["url"]) && strlen($mainmenu_item["url"])?'target="_blank"':'')?>><?=$mainmenu_item["name"]?></a>
<?php endforeach; ?>
			</p>
			<form action="<?=hanchor_href("content/search")?>" class="search" method="post">
				<p><input class="searchfield" name="keywords" type="text" id="keywords" value="Search Keywords" onfocus="this.value='';" onblur="if (this.value == '') this.value='Search Keywords';" />
				<input class="searchbutton" name="submit" type="submit" value="Search" /></p>
			</form>
		</div>
	
		<div id="logo">
			<h1><a href="<?=hanchor_shref()?>"><?=lconf_dbget("title")?></a></h1>
			<p><?=lconf_dbget("description")?></p>
		</div>

		<ul id="menu">
<?php foreach($submenu as $submenu_item): ?>
			<li><a class="<?=hanchor_class("main/index/content", "link1", "link1active", $submenu_item["link"]);?>" href="<?=hmenu_href("main/item/content", @$submenu_item["link"], @$submenu_item["url"])?>"<?=(isset($submenu_item["url"]) && strlen($submenu_item["url"]) && !lstring_search($submenu_item["url"], "*")?'target="_blank"':'')?>><?=$submenu_item["name"]?></a></li>
<?php endforeach; ?>
		</ul>
		
		<div id="main">
			<?lloader_load_view($subview, $data)?>
		</div>
		
		<?=@$advertising['body']?>

		<div id="line"></div>
		
		<div id="left">
			<h3>Tourist centres in Croatia</h3>
				<ul>
<?php foreach($submenu2 as $submenu_item): ?>
					<li><a class="<?=hanchor_class("main/index/content", "link1", "link1active", $submenu_item["link"]);?>" href="<?=hmenu_href("main/item/content", @$submenu_item["link"], @$submenu_item["url"])?>"<?=(isset($submenu_item["url"]) && strlen($submenu_item["url"]) && !lstring_search($submenu_item["url"], "*")?'target="_blank"':'')?>><?=$submenu_item["name"]?></a></li>
<?php endforeach; ?>
				</ul>
		</div>
					
		<div id="right">	
			<div id="rl">
				<ul>
<?php foreach($submenu3 as $submenu_item): ?>
					<li><a href="<?=hmenu_href("main/item/content", @$submenu_item["link"], @$submenu_item["url"])?>"<?=(isset($submenu_item["url"]) && strlen($submenu_item["url"]) && !lstring_search($submenu_item["url"], "*")?'target="_blank"':'')?>><?=$submenu_item["name"]?></a></li>
<?php endforeach; ?>
				</ul>
			</div>
			
			<div id="rr">
				<ul>
<?php foreach($submenu4 as $submenu_item): ?>
					<li><a href="<?=hmenu_href("main/item/content", @$submenu_item["link"], @$submenu_item["url"])?>"<?=(isset($submenu_item["url"]) && strlen($submenu_item["url"]) && !lstring_search($submenu_item["url"], "*")?'target="_blank"':'')?>><?=$submenu_item["name"]?></a></li>
<?php endforeach; ?>
				</ul>
			</div>
		
			<blockquote class="border">
				<?=@$quote['body']?>
			</blockquote>
		</div>
			
		<div id="footer">
			<ul id="fr" class="links">
				<li><a href="<?=hanchor_shref("rss.xml", false)?>" title="RSS Articles">RSS Articles</a></li>
			</ul>
			<div id="fl">
				<p class="links">
					<a href="<?=hanchor_shref()?>">Home</a> 
<?php foreach($submenu1 as $submenu_item): ?>
					<a class="<?=hanchor_class("main/index/content", "link1", "link1active", $submenu_item["link"]);?>" href="<?=hmenu_href("main/item/content", @$submenu_item["link"], @$submenu_item["url"])?>"<?=(isset($submenu_item["url"]) && strlen($submenu_item["url"]) && !lstring_search($submenu_item["url"], "*")?'target="_blank"':'')?>><?=$submenu_item["name"]?></a>
<?php endforeach; ?>
				</p>
				<p>In Croatia is Croatian travel and tourism portal intended to inform foreign tourists in Croatia about our tourist offer, beautiful country and sea, unique Croatian culture, local news in English, fun stuff to do, places to visit and much more.</p>
				Copyright &copy; <strong><a href="<?=hanchor_shref()?>">In Croatia</a></strong>, 2009.<br />
				Powered by <strong><a href="http://microcms.kset.org/">Micro CMS</a></strong><br />
				Design: <strong><a href="http://www.solucija.com/">Luka Cvrk</a></strong> &middot; Sponsored by <strong><a class="sponsor" href="http://webpoint.wordpress.com/">B4Contact</a></strong>
			</div>
		</div>	
	</div>
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-6090001-4");
		pageTracker._trackPageview();
		} catch(err) {}
	</script>
</body>
</html>