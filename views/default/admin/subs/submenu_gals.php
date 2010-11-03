					<ul id="submenu_ul">
<?php foreach($submenu as $submenu_item): ?>
						<li id="item-<?=$submenu_item["id"]?>" class="cat_edit"><a class="<?=hanchor_class("main/user_item/admin/galleries_update/" . $submenu_item["id"], "link1", "link1active");?>" href="<?=hanchor_href("main/user_item/admin/galleries_update", $submenu_item["id"])?>"><?=l($submenu_item["name"])?></a></li>
<?php endforeach; ?>
					</ul>
					<a class="<?=hanchor_class("main/user/admin/galleries_create", "bottom_link", "bottom_link_active");?>" href="<?=hanchor_href("main/user/admin/galleries_create")?>"><?=l("Add new")?></a>