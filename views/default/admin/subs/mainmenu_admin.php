<ul>
<?php for($i = count($mainmenu) - 1; $i >= 0; $i--): ?>
						<li><a class="link1" href="<?=hanchor_href($mainmenu[$i]["link"])?>"><?=$mainmenu[$i]["name"]?></a></li>
<?php endfor; ?>
					</ul>