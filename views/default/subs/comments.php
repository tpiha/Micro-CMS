<?php foreach($comments as $comment): ?>
						<fieldset>
							<legend><?=$comment["name"]?></legend>
							<h6><a style="position: relative; top: 0px; float: right; margin-right: 20px;" href="javascript: void null;" onclick="delete_comment(<?=$comment['id']?>)"><?=l('Delete')?></a>&nbsp;&nbsp;<?=date("H:i:s, d.m.Y.", strtotime($comment["time"]))?></h6>
							<p><?=$comment["body"]?></p>
						</fieldset>
<?php endforeach; ?>