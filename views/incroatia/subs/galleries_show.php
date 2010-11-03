					<div class="contact">
						<h2><?=$title?></h2>
						<p>
<?php foreach($images as $image): ?>
							<div class="gallery_image_div"><a href="<?=hanchor_shref('data/galleries/' . $gallery['link'] . '/' . $image['link'] . '_' . $image['id'] . '.jpg', false)?>" rel="lightbox[images]"><img src="<?=hanchor_shref('data/galleries/' . $gallery['link'] . '/' . $image['link'] . '_thumb_' . $image['id'] . '.jpg', false)?>" alt="<?=$image['name']?>" title="<?=$image['name']?>" class="gallery_image" /></a><br /><?=$image['description']?></div>
<?php endforeach; ?>
						</p>
						<div style="clear: both;"></div>
						<div class="pagination"><?=$pagination?></div>
					</div>