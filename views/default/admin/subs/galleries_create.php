						<fieldset>
							<legend><?=l("Create gallery")?></legend>
							<?=hform_open("galleries/create");?>
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
									<label class="label" for="description"><?=l("Description")?>:</label><br />
									<input class="input" type="text" value="" name="description" />
								</p>
								<p>
									<label class="label" for="keywords"><?=l("Keywords")?>:</label><br />
									<input class="input" type="text" value="" name="keywords" />
								</p>
								<p>
									<label class="label" for="parentid">* <?=l("Parent category")?>:</label><br />
									<select name="parentid">
										<option selected value="0"><?=l("No parent")?></option>
<?php foreach($cats as $cat_item): ?>
										<option value="<?=$cat_item["id"]?>"><?=$cat_item["name"]?></option>
<? endforeach; ?>
									</select>
								</p>
								<p>
									<input type="submit" value="<?=l("Create")?>" />
								</p>
							</form>
						</fieldset>