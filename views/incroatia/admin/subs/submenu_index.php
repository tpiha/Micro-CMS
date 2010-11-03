					<ul>
<?php foreach($submenu as $submenu_item): ?>
<?php if($submenu_item["link"] != lconf_get("lang")):?>
						<li class="cat"><a class="<?=($submenu_item["link"] == lconf_get("lang") ? "active":"")?>" href="<?=hanchor_href("langs/change_admin", $submenu_item["link"])?>"><?=l($submenu_item["name"])?></a></li>
<?php else: ?>
						<li class="cat"><span style="color: #808080;"><?=l($submenu_item["name"])?></span></li>
<?php endif; ?>
<?php endforeach; ?>
					</ul>
