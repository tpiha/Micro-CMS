						<fieldset>
							<legend><?=l("New category")?></legend>
							<?=hform_open("categories/create");?>
								<div><?=hmessage_get();?></div>
								<div>* = <?=l("required fields")?></div>
								<p>
									<label class="label" for="published"><?=l("Published")?>:</label><br />
									<input class="input" type="checkbox" name="published" />
								</p>
								<p>
									<label class="label" for="name">* <?=l("Name")?>:</label><br />
									<input class="input" type="text" value="" name="name" />
								</p>
								<p>
									<label class="label" for="link">* <?=l("Link")?>:</label><br />
									<input class="input" type="text" value="" name="link" />
								</p>
								<p>
									<label class="label" for="url"><?=l("Url")?>:</label><br />
									<input class="input" type="text" value="" name="url" onkeypress="$('#new_window').fadeIn(1400);" />
								</p>
								<p id="new_window" style="display:none;">
									<label class="label" for="new_window"><?=l("Open in new window")?>:</label><br />
									<input class="input" type="checkbox" name="new_window" checked />
								</p>
								<p>
									<label class="label" for="parentid">* <?=l("Parent category")?>:</label><br />
									<select name="parentid">
										<option selected><?=l("No parent")?></option>
<?php foreach($cats as $cat_item): ?>
										<option value="<?=$cat_item["id"]?>"><?=$cat_item["name"]?></option>
<? endforeach; ?>
									</select>
								</p>
								<p>
									<label class="label" for="content"><?=l("Create content")?>:</label><br />
									<input class="input" type="checkbox" name="content" />
								</p>
								<p>
									<input type="submit" value="<?=l("Create")?>" />
								</p>
							</form>
						</fieldset>