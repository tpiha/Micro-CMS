					<ul>
<?php foreach($submenu as $submenu_item): ?>
						<li class="cat"><a class="<?=hanchor_class($submenu_item["link"], "link1", "link1active");?>" href="<?=hmenu_href($submenu_item["link"], "", false)?>"><?=l($submenu_item["name"])?></a></li>
<?php endforeach; ?>
					</ul>
