						<fieldset class="content">
							<legend><?=l("Edit content")?>: <?=$content["name"]?></legend>
							<?=hform_open("content/update");?>
								<div><?=hmessage_get();?></div>
								<div>* = <?=l("required fields")?></div>
								<p style="display: none;"><input type="hidden" value="<?=@$content["id"]?>" name="id" /></p>
								<p>
									<label class="label" for="published"><?=l("Published")?>:</label><br />
									<input class="input" type="checkbox" name="published"<?=hform_checked($cat["published"])?> />
								</p>
								<p>
									<label class="label" for="name">* <?=l("Name")?>:</label><br />
									<input class="input" type="text" value="<?=@$content["name"]?>" name="name" onkeyup="make_link(this.value);make_keywords(this.value);make_description(this.value);" />
								</p>
								<p>
									<label class="label" for="link">* <?=l("Link")?>:</label><br />
									<input class="input" type="text" value="<?=@$content["link"]?>" name="link" id="link" />
								</p>
								<p>
									<label class="label" for="date"><?=l("Date to publish")?>:</label><br />
									<input class="input" type="text" value="<?=@$content["date"]?>" name="date" id="date" />
								</p>
								<p>
									<label class="label" for="time"><?=l("Time to publish")?>:</label><br />
									<input class="input" type="text" value="<?=@$content["time"]?>" name="time" id="time" />
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
									<label class="label" for="description"><?=l("Description")?>:</label><br />
									<input class="input" type="text" value="<?=@$content["description"]?>" name="description" id="description" />
								</p>
								<p>
									<label class="label" for="keywords"><?=l("Keywords")?>:</label><br />
									<input class="input" type="text" value="<?=@$content["keywords"]?>" name="keywords" id="keywords" />
								</p>
								<p>
									<label class="label" for="content_image_1"><?=l("Content image")?> 1:</label><br />
									<input class="input" type="file" value="" name="content_image_1" onchange="$('#content_image_1_real').fadeIn(1400);" />
								</p>
								<p id="content_image_1_real" style="display:none;">
									<label class="label" for="content_image_1_real"><?=l("Show original")?>:</label><br />
									<input class="input" type="checkbox" name="content_image_1_real" checked />
								</p>
								<p>
									<label class="label" for="content_image_2"><?=l("Content image")?> 2:</label><br />
									<input class="input" type="file" value="" name="content_image_2" onchange="$('#content_image_2_real').fadeIn(1400);" />
								</p>
								<p id="content_image_2_real" style="display:none;">
									<label class="label" for="content_image_2_real"><?=l("Show original")?>:</label><br />
									<input class="input" type="checkbox" name="content_image_2_real" checked />
								</p>
								<p>
									<label class="label" for="content_image_3"><?=l("Content image")?> 3:</label><br />
									<input class="input" type="file" value="" name="content_image_3" onchange="$('#content_image_3_real').fadeIn(1400);" />
								</p>
								<p id="content_image_3_real" style="display:none;">
									<label class="label" for="content_image_3_real"><?=l("Show original")?>:</label><br />
									<input class="input" type="checkbox" name="content_image_3_real" checked />
								</p>
								<p>
									<label class="label" for="body">* <?=l("Body")?>:</label><br /><?=hform_rte("body", @$content["body"])?>
								</p>
								<p style="padding-top: 20px;">
									<input type="submit" value="<?=l("Edit")?>" />
									<input type="button" value="<?=l("Delete")?>" onclick="window.location.href='<?=hanchor_href("content/delete", $content["link"]);?>';" />
									<input style="width: 120px;" type="button" value="<?=l("Delete images")?>" onclick="window.location.href='<?=hanchor_href("content/images_delete", "content/" . $content["link"]);?>';" />
								</p>
							</form>
						</fieldset>