						<h2><?=$title?></h2>
<? foreach($functions as $function): ?>
						<div style="background-color: #EEE; padding: 10px; margin: 15px;">
							<h3 id="<?=$function["name"]?>"><?=$function["name"]?></h3>
							<p style="float: right">
									<a href="#">Jump to top</a>
							</p>
							<p>
								<?=$function["function_desc"]?>
							</p>
							<p>
								<strong><?=$function["return_type"]?> - <?=$function["name"]?></strong>(<?=$function["function_args"]?>);
							</p>
							<h5>params</h5>
<? if($function["params"]): ?>
							<p>
<? foreach($function["params"] as $param): ?>
								<strong><?=$param["type"]?> - <?=$param["name"]?></strong> - <?=$param["desc"]?><br />
<? endforeach; ?>
							</p>
<? endif; ?>
							<h5>return</h5>
							<p>
								<strong><?=$function["return_type"]?></strong> - <?=$function["return_text"]?>
							</p>
						</div>
<? endforeach; ?>