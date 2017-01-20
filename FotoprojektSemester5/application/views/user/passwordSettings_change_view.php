<section style="padding-top: 70px">
<div class="signup-center">
<div class="container">
<div class="row">
<div class="col-md-6 offset-md-3">
<?php
echo form_open ( 'user/changePassword' );
?>
					
			<div class="form-changePassword">
                    <h1>Passwort ändern</h1>
                    <br>
						<input id="user_oldPassword" type="password" class="form-control input-sm chat-input" placeholder="Altes Passwort" name="user_oldPassword"/>
                    	<?php
																					if (validation_errors ( 'user_oldPassword' ) != null) {
																						if (form_error ( 'user_oldPassword' ) != "") {
																							echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'user_oldPassword' ) . "</div>";
																						}
																					}
																					?>
                    <br>
						<input id="user_newPassword" type="password" class="form-control input-sm chat-input" placeholder="Neues Passwort" name="user_newPassword"/>
                    	<?php
																					if (validation_errors ( 'user_newPassword' ) != null) {
																						if (form_error ( 'user_newPassword' ) != "") {
																							echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'user_newPassword' ) . "</div>";
																						}
																					}
																					?>

                    <br>
                    	<input id="user_newCPassword" type="password" class="form-control input-sm chat-input" placeholder="Neues Passwort bestätigen" name="user_newCPassword"/>
                    	<?php
																					if (validation_errors ( 'user_newCPassword' ) != null) {
																						if (form_error ( 'user_newCPassword' ) != "") {
																							echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'user_newCPassword' ) . "</div>";
																						}
																					}
																					?>

                    <br>
                    <div align="right">
                    <span class="group-btn">    
                    	<button id="savePassword" name="submit" type="submit" class="btn btn-primary btn-md">Passwort speichern</button>
                    </span>
                    </div>                    
               </div>
               </form>
		</div>
	</div>

</div>	
</div>
</section>
