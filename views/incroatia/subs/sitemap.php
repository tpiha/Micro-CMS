					<div class="sitemap">
						<h2><?=$title?></h2>
<?for($i = 0; $i < count($parent_cats); $i++):?>
						<div>
						<div class="sitemap_block">
						<h4><?=$parent_cats[$i]["name"]?></h4>
						<?=hcategories_sitemap($cats, $parent_cats[$i])?>
						</div>
<?php if(isset($parent_cats[$i + 1])): ?>
						<div class="sitemap_block">
						<h4><?=$parent_cats[$i + 1]["name"]?></h4>
						<?=hcategories_sitemap($cats, $parent_cats[$i + 1])?>
						</div>
<?php endif; ?>
						</div>
						<div style="clear: both;"></div>
<?$i++;?>
<?endfor;?>
					</div>