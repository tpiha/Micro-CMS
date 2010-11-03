					<ul>
<?php foreach($submenu as $submenu_item): ?>
						<li class="cat"><a class="<?=hanchor_class("main/user_item/admin/content_update/" . $submenu_item["link"], "link1", "link1active");?>" href="<?=hanchor_href("main/user_item/admin/content_update", $submenu_item["link"])?>"><?=l($submenu_item["name"])?></a></li>
<?php endforeach; ?>
					</ul>
					<a class="<?=hanchor_class("main/user/admin/content_create", "bottom_link", "bottom_link_active");?>" href="<?=hanchor_href("main/user/admin/content_create")?>"><?=l("Add new")?></a>