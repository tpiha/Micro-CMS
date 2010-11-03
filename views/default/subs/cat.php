					<div style="width: 500px;">
					<h2><?=$title?></h2>
					<p><?=hmessage_get();?></p>
<?php foreach($content as $content_item): ?>
					<h3><a href="<?=hmenu_href("main/index/content", @$content_item["link"], @$content_item["url"])?>"><?=$content_item["title"]?></a></h3>
<?if(isset($content_item["updated"])):?>
					<h6><?=date("jS M Y, H:i", strtotime($content_item["updated"]))?></h6>
<?endif;?>
<?if(isset($content_item["body"])):?>
					<a href="<?=hanchor_href("main/index/content", $content_item["link"])?>"><?=himage("content_image_3", $content_item["link"])?></a>
					<p><?=hstring_smart_shorten($content_item["body"] . "\n", 200);?><br />
					<a style="float: right" href="<?=hanchor_href("main/index/content", $content_item["link"])?>"><?=l("more")?> &gt;&gt;</a></p>
<?endif;?>
					<div style="clear: both;"></div>
<?php endforeach; ?>
					</div>