						<fieldset>
							<legend><?=l("Edit image")?>: <?=$image["name"]?></legend>
							<?=hform_open("galleries/image_update");?>
								<div><?=hmessage_get();?></div>
								<div>* = <?=l("required fields")?></div>
								<p style="display: none;"><input type="hidden" value="<?=@$image["id"]?>" name="id" /></p>
								<p style="display: none;"><input type="hidden" value="<?=@$image["gallery_id"]?>" name="gallery_id" /></p>
								<p>
									<label class="label" for="name">* <?=l("Name")?>:</label><br />
									<input class="input" type="text" value="<?=@$image["name"]?>" name="name" />
								</p>
								<p>
									<label class="label" for="link">* <?=l("Link")?>:</label><br />
									<input class="input" type="text" value="<?=@$image["link"]?>" name="link" />
								</p>
								<p>
									<label class="label" for="description"><?=l("Description")?>:</label><br />
									<input class="input" type="text" value="<?=@$image["description"]?>" name="description" />
								</p>
								<p>
									<input type="submit" value="<?=l("Edit")?>" />
									<input type="button" value="<?=l("Delete")?>" onclick="window.location.href='<?=hanchor_href("galleries/image_delete", $image["id"]);?>';" />
								</p>
							</form>
						</fieldset>
						<fieldset>
							<legend><?=l("Image")?></legend>
							<p id="images" style="margin-top: 0px; font-size: 0px; margin-bottom: 10px; ">
								<a rel="lightbox[images]" href="javascript: void null;" onclick="window.open('<?=hanchor_shref('data/galleries/' . $gal['link'] . '/' . $image['link'] . '_' . $image['id'] . '.jpg', false)?>')"><img src="<?=hanchor_shref('data/galleries/' . $gal['link'] . '/' . $image['link'] . '_thumb_' . $image['id'] . '.jpg', false)?>" /></a>
							</p>
						</fieldset>