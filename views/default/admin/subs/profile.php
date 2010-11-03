					<fieldset>
						<legend><?=l("Edit profile")?></legend>
						<?=hform_open("users/update");?>
							<div><?=hmessage_get();?></div>
							<div>* = <?=l("required fields")?></div>
							<p>
								<label for="pass0">* <?=l("Old password")?>:</label><br />
								<input type="password" value="" name="pass0" />
							</p>
							<p>
								<label for="pass1">* <?=l("New password")?>:</label><br />
								<input type="password" value="" name="pass1" />
							</p>
							<p>
								<label for="pass2">* <?=l("Repeat new")?>:</label><br />
								<input class="input" type="password" value="" name="pass2" />
							</p>
							<p>
								<input type="submit" value="<?=l("Edit")?>" />
							</p>
						</form>
					</fieldset>