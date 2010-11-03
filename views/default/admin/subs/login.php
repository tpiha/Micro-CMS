					<h2><?=$title?></h2>
					<fieldset id="login">
						<legend><?=l("login")?></legend>
						<?=hform_open("users/submit");?>
							<div><?=hmessage_get();?></div>
							<div>* = <?=l("required fields")?></div>
							<p>
								<label for="user">* <?=l("Username")?>:</label><br />
								<input tabindex="1" type="text" value="" name="user" id="user" />
							</p>
							<p>
								<label for="pass">* <?=l("Password")?>:</label><br />
								<input tabindex="2" type="password" value="" name="pass" id="pass" />
							</p>
							<p>
								<input tabindex="4" type="submit" value="<?=l("Login")?>" />
							</p>
						</form>
					</fieldset>