				<ul>
<?php foreach($submenu as $submenu_item): ?>
					<li><a class="<?=hanchor_class("main/index/content", "link1", "link1active", $submenu_item["link"]);?>" href="<?=hmenu_href("main/item/content", @$submenu_item["link"], @$submenu_item["url"])?>"<?=(isset($submenu_item["url"]) && strlen($submenu_item["url"]) && !lstring_search($submenu_item["url"], "*")?'target="_blank"':'')?>><?=$submenu_item["name"]?></a></li>
<?php endforeach; ?>
				</ul>