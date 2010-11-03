					<div>
					<h2><?=$title?></h2>
<?if(isset($updated)):?>
					<h6><?=date("jS M Y, H:i", strtotime($updated))?></h6>
<?endif;?>
					<?=himage("content_image_1", $item)?>
					<?=himage("content_image_2", $item)?>
					<div>
						<?=$body . "\n";?><br />
					</div>
					<div style="clear: both; height: 10px;"></div>
					<a id="comments_link" style="float: right; top: -30px; position: relative;" href="javascript: void null;" onclick="toggle_fade('comments');"><?=l("Comments") . " (" . $comments_num . ")"?></a>
					<script type="text/javascript">document.write('<div style="display:none;" id="comments">')</script>
					<div class="comments">
					<div id="comments1">
<?php foreach($comments as $comment): ?>
						<fieldset>
							<legend><?=$comment["name"]?></legend>
							<h6><?php if(lusers_is_logged_in()): ?><a style="position: relative; top: 0px; float: right; margin-right: 20px;" href="javascript: void null;" onclick="delete_comment(<?=$comment['id']?>)"><?=l('Delete')?></a>&nbsp;&nbsp;<?php endif; ?><?=date("H:i:s, d.m.Y.", strtotime($comment["time"]))?></h6>
							<p><?=$comment["body"]?></p>
						</fieldset>
<?php endforeach; ?>
					</div>
						<fieldset class="comments_form">
							<legend><?=l("Comments form")?></legend>
							<?=hform_open("comments/send")?>
								<div><strong><?=hmessage_get();?></strong></div>
								<div>* = <?=l("required fields")?></div>
								<p style="display: none;">
									<input type="hidden" value="<?=$item?>" name="module_item" />
									<input type="hidden" value="<?=CONT?>" name="module" />
								</p>
								<p>
									<label for="name">* Name:</label><br />
									<input type="text" value="" name="name" id="name" />
								</p>
								<p>
									<label for="body">* Comment:</label><br />
									<textarea name="body" id="body" rows="20" cols="40" ></textarea>
								</p>
								<p>
									<input type="submit" value="Send" style="width: 80px;" />
								</p>
							</form>
						</fieldset>
					</div>
					<script type="text/javascript">document.write('</div>')</script>
					</div>