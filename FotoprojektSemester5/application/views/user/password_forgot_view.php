<section style="padding-top: 70px">
	<div class="signup-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
				


				<?php echo form_open('Login/forgotPassword');?>
				
					<div class="form-PasswordReset">
						<h4>Passwort vergessen?</h4>
						<p>Per E-Mail können Sie Ihr Passwort einfach zurücksetzen. Nach
							Eingabe der Daten senden wir Ihnen einen Aktivierungslink.</p>
						<input type="text" class="form-control input-sm chat-input" placeholder="Email-ID" name="email" value="<?php echo set_value('email'); ?>"/>
		    				<?php
		    					if (validation_errors('email') != null){
		    						echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . validation_errors() . "</div>";
		    					}
		    				?>

						<div align="right" style="margin-top: 1rem">
							<span class="group-btn">
								<button name="submit" type="submit"
									class="btn btn-primary btn-md">E-Mail anfordern</button>
							</span>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</section>