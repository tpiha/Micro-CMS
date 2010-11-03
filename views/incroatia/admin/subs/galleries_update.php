						<fieldset>
							<legend><?=l("Edit gallery")?>: <?=$gal["name"]?></legend>
							<?=hform_open("galleries/update");?>
								<div><?=hmessage_get();?></div>
								<div>* = <?=l("required fields")?></div>
								<p style="display: none;"><input type="hidden" value="<?=@$gal["id"]?>" name="id" /></p>
								<p>
									<label class="label" for="published"><?=l("Published")?>:</label><br />
									<input class="input" type="checkbox" name="published"<?=hform_checked($cat["published"])?> />
								</p>
								<p>
									<label class="label" for="name">* <?=l("Name")?>:</label><br />
									<input class="input" type="text" value="<?=@$gal["name"]?>" name="name" />
								</p>
								<p>
									<label class="label" for="link">* <?=l("Link")?>:</label><br />
									<input class="input" type="text" value="<?=@$gal["link"]?>" name="link" />
								</p>
								<p>
									<label class="label" for="description"><?=l("Description")?>:</label><br />
									<input class="input" type="text" value="<?=@$gal["description"]?>" name="description" />
								</p>
								<p>
									<label class="label" for="keywords"><?=l("Keywords")?>:</label><br />
									<input class="input" type="text" value="<?=@$gal["keywords"]?>" name="keywords" />
								</p>
								<p>
									<label class="label" for="parentid">* <?=l("Parent category")?>:</label><br />
									<select name="parentid">
										<option <?=($cat["id"] == 0 ? "selected " : "")?>value="0"><?=l("No parent")?></option>
<?php foreach($cats as $cat_item): ?>
										<option <?=($cat["parentid"] == $cat_item["id"] ? "selected " : "")?>value="<?=$cat_item["id"]?>"><?=$cat_item["name"]?></option>
<? endforeach; ?>
									</select>
								</p>
								<p>
									<input type="submit" value="<?=l("Edit")?>" />
									<input type="button" value="<?=l("Delete")?>" onclick="window.location.href='<?=hanchor_href("galleries/delete", $gal["id"]);?>';" />
								</p>
							</form>
						</fieldset>
						<fieldset>
							<legend><?=l("Images")?></legend>
							<p id="images" style="margin-top: 0px; font-size: 0px; margin-bottom: 1px; ">

							</p>
							<p style="clear: both; margin-bottom: 10px;">
								<iframe src="<?=hanchor_href('uploader', $gal['id']);?>" style="height: 60px; width: 400px;" onload="handle_iframe_onload(<?=$gal['id']?>);"></iframe>
							</p>
						</fieldset>