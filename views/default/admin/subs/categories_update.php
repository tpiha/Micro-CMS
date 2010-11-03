						<fieldset>
							<legend><?=l("Edit category")?>: <?=$cat["name"]?></legend>
							<?=hform_open("categories/update");?>
								<div><?=hmessage_get();?></div>
								<div>* = <?=l("required fields")?></div>
								<p style="display: none;"><input type="hidden" value="<?=@$cat["id"]?>" name="id" /></p>
								<p>
									<label class="label" for="published"><?=l("Published")?>:</label><br />
									<input class="input" type="checkbox" name="published"<?=hform_checked($cat["published"])?> />
								</p>
								<p>
									<label class="label" for="name">* <?=l("Name")?>:</label><br />
									<input class="input" type="text" value="<?=@$cat["name"]?>" name="name" />
								</p>
								<p>
									<label class="label" for="link">* <?=l("Link")?>:</label><br />
									<input class="input" type="text" value="<?=@$cat["link"]?>" name="link" />
								</p>
								<p>
									<label class="label" for="url"><?=l("Url")?>:</label><br />
									<input class="input" type="text" value="<?=@$cat["url"]?>" name="url" onkeypress="$('#new_window').fadeIn(1400);" />
								</p>
								<p id="new_window" style="display:none;">
									<label class="label" for="new_window"><?=l("Open in new window")?>:</label><br />
									<input class="input" type="checkbox" name="new_window"<?=hform_checked($cat["new_window"])?> />
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
									<input type="button" value="<?=l("Delete")?>" onclick="window.location.href='<?=hanchor_href("categories/delete", $cat["id"]);?>';" />
								</p>
							</form>
						</fieldset>