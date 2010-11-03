					<div class="contact">
						<h2><?=$title?></h2>
<?php foreach($galleries as $gallery): ?>
					<div class="gallery_image_div"><a href="<?=hanchor_href('main/item/galleries_show', $gallery['link'])?>"><img src="<?=hanchor_shref('data/galleries/' . $gallery['link'] . '/' . $gallery['image']['link'] . '_thumb_' . $gallery['image']['id'] . '.jpg', false)?>" alt="<?=$gallery['name']?>" title="<?=$gallery['name']?>" class="gallery_image" /></a><br /><?=$gallery['description']?></div>
<?php endforeach; ?>
					</div>