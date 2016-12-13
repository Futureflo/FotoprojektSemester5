<section style="padding-top: 70px">
	<div class="signup-center">
		<div class="container">
			<div class="row">
				<div class="col-md-4 offset-md-4">
				
				<?php $attributes = array("name" => "passwordReset");
			echo form_open("PasswordForgot/", $attributes);?>
				
					<div class="form-PasswordReset">
						<h4>Passwort vergessen?</h4>
						<p>Per E-Mail können Sie Ihr Passwort einfach zurücksetzen. Nach
							Eingabe der Daten senden wir Ihnen einen Aktivierungslink.</p>
						<input type="text" class="form-control input-sm chat-input"
							placeholder="Email-ID" name="user_email"
							value="<?php echo set_value('user_email'); ?>" /> <span
							class="text-danger"><?php echo form_error('user_email'); ?></span>
						<br>

						<div align="right">
							<span class="group-btn">
								<button name="submit" type="submit"
									class="btn btn-primary btn-md">E-Mail anfordern</button>
							</span>
						</div>
					</div>
					
					<?php echo form_close(); ?>
		<?php echo $this->session->flashdata('msg'); ?>

					<!-- <legend>Signup</legend>
	
<div class="form-group">
<label for="name">First Name</label>
<input class="form-control" name="user_firstname" placeholder="Your First Name" type="text"/>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="name">Last Name</label>
<input class="form-control" name="user_name" placeholder="Last Name" type="text"/>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="email">Email ID</label>
<input class="form-control" name="user_email" placeholder="Email-ID" type="text"/>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="subject">Password</label>
<input class="form-control" name="user_password" placeholder="Password" type="password" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="subject">Confirm Password</label>
<input class="form-control" name="user_cpassword" placeholder="Confirm Password" type="password" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<button name="submit" type="submit" class="btn btn-info">Signup</button>
<button name="cancel" type="reset" class="btn btn-info">Cancel</button>
</div>  -->

				</div>
			</div>

		</div>
	</div>
</section>
