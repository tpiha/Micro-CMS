					<div class="contact">
						<h2><?=$title?></h2>
						<fieldset>
							<legend><?=l("Contact form")?></legend>
							<?=hform_open("contact/send");?>
								<div><strong><?=hmessage_get()?></strong></div>
								<div>* = <?=l("required fields")?></div>
								<p>
									<label for="name">* <?=l("Name")?>:</label><br />
									<input type="text" value="" name="name" id="name" />
								</p>
								<p>
									<label for="mail">* <?=l("Email")?>:</label><br />
									<input type="text" value="" name="mail" id="mail" />
								</p>
								<p>
									<label for="website"><?=l("Website")?>:</label><br />
									<input type="text" value="" name="website" id="website" />
								</p>
								<p>
									<label for="message">* <?=l("Message")?>:</label><br />
									<textarea rows="20" cols="40" name="message" id="message"></textarea>
								</p>
								<p>
									<input type="submit" value="<?=l("Send")?>" />
								</p>
							</form>
						</fieldset>
					</div>