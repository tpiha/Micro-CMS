						<ul id="images_ul">
<?php foreach($images as $image): ?>
							<li id="image-<?=$image['id']?>" style="float: left; margin: 0px; padding: 0px;"><a href="<?=hanchor_href('main/user_item/admin/galleries_image_update', $image['id'])?>"><img src="<?=hanchor_shref('data/galleries/' . $gal['link'] . '/' . $image['link'] . '_thumb_' . (string) $image['id'] . '.jpg', false)?>" alt="<?=$image['name']?>" title="<?=$image['name']?>" class="gallery_image" /></a></li>
<?php endforeach; ?>
						</ul>