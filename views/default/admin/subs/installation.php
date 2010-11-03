					<div>
						<fieldset>
							<legend><?=l("MySQL data")?></legend>
							<?=hform_open('installation/submit')?>
								<div><strong><?=hmessage_get()?></strong></div>
								<div>* = <?=l('required fields')?></div>
								<p>
									<label for="url">* <?=l("Site URL (with trailing slash)")?>:</label><br />
									<input type="text" name="url" value="<?=lstring_replace('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], 'index.php', '')?>" />
								</p>
								<p>
									<label for="db_name">* <?=l("Database name")?>:</label><br />
									<input type="text" name="db_name" value="" />
								</p>
								<p>
									<label for="db_user">* <?=l("Database user")?>:</label><br />
									<input type="text" name="db_user" value="" />
								</p>
								<p>
									<label for="db_pass">* <?=l("Database password")?>:</label><br />
									<input type="text" name="db_pass" value="" />
								</p>
								<p>
									<input type="submit" value="<?=l('Submit')?>" />
								</p>
							</form>
						</fieldset>
					</div>
