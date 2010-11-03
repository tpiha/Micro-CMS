					<fieldset>
						<legend><?=l("Edit settings")?></legend>
						<?=hform_open("settings/update");?>
							<div><?=hmessage_get();?></div>
							<div>* = <?=l("required fields")?></div>
							<p>
								<label for="title"><?=l("Site title")?>:</label><br />
								<input type="text" value="<?=@$settings["title"]?>" name="title" />
							</p>
							<p>
								<label class="label" for="description"><?=l("Site description")?>:</label><br />
								<input class="input" type="text" value="<?=@$settings["description"]?>" name="description" />
							</p>
							<p>
								<label class="label" for="keywords"><?=l("Site keywords")?>:</label><br />
								<input class="input" type="text" value="<?=@$settings["keywords"]?>" name="keywords" />
							</p>
							<p>
								<label class="label" for="tools">* <?=l("Use tools")?>:</label><br />
								<input class="input" type="checkbox"<?=hform_checked($settings["tools"])?> name="tools" />
							</p>
							<p>
								<label class="label" for="caching">* <?=l("Use caching")?>:</label><br />
								<input class="input" type="checkbox"<?=hform_checked($settings["caching"])?> name="caching" />
							</p>
							<p>
								<label class="label" for="admin_title"><?=l("Admin title")?>:</label><br />
								<input class="input" type="text" value="<?=@$settings["admin_title"]?>" name="admin_title" />
							</p>
							<p>
								<label class="label" for="default_uri">* <?=l("Default URI")?>:</label><br />
								<input class="input" type="text" value="<?=@$settings["default_uri"]?>" name="default_uri" />
							</p>
							<p>
								<label class="label" for="contact_mail"><?=l("Contact mail")?>:</label><br />
								<input class="input" type="text" value="<?=@$settings["contact_mail"]?>" name="contact_mail" />
							</p>
							<p>
								<label class="label" for="contact_subject"><?=l("Contact mail subject")?>:</label><br />
								<input class="input" type="text" value="<?=@$settings["contact_subject"]?>" name="contact_subject" />
							</p>
							<p>
								<input type="submit" value="<?=l("Edit")?>" />
							</p>
						</form>
					</fieldset>