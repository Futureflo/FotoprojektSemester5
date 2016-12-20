<section style="padding-top: 70px">
	<div class="signup-center">
	<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
						<?php echo form_open('Login/getNewPassword', '', array('user_id' => $user_id));?>
					
			<div class="form-PasswordReset">
                    <h4>Passwort zurücksetzen</h4>
						<p>Sie haben Ihr Passwort zurücksetzen lassen. Bitte geben Sie Ihr neues Passwort ein.</p>                   		<input type="password" class="form-control input-sm chat-input" placeholder="Neues Passwort" name="user_newPassword"/>
                    	<span class="text-danger"></span>
                    <br>
                    	<input type="password" class="form-control input-sm chat-input" placeholder="Neues Passwort bestätigen" name="user_newCPassword"/>
                    	<span class="text-danger"></span>
                    <br>
                    <div align="right">
                    <span class="group-btn">    
                    	<button name="submit" type="submit" class="btn btn-primary btn-md">Passwort speichern</button>
                    </span>
                    </div>                    
               </div>
               </form>
			
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
