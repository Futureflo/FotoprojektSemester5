<section style="padding-top: 70px">
	<div class="signup-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
			<?php
			echo form_open ( 'user/changeEmail' );
			?>

				<h1>Email-Adresse ändern</h1>
				<br>

					<label for="mail"><h4>Aktuelle Email-Adresse:</h4></label> <input type="text" class="form-control" id="mail" value="<?php
					
					echo $user_email;
					?>" readonly>
				<hr>
					<input type="text" class="form-control" placeholder="Neue E-Mail Adresse" id="new_email" name="new_email" value="<?php
					
					echo set_value ( 'new_email' );
					?>"/>
					<?php
					if (validation_errors ( 'new_email' ) != null) {
						if (form_error ( 'new_email' ) != "") {
							echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'new_email' ) . "</div>";
						}
					}
					?>
					<br>
					<input type="text" class="form-control" id="confirm_email" name="confirm_email" placeholder="E-Mail Adresse bestätigen" value="<?php
					
					echo set_value ( 'confirm_email' );
					?>"/>
					<?php
					if (validation_errors ( 'confirm_email' ) != null) {
						echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'confirm_email' ) . "</div>";
					}
					?>
				<br>
					<button name="submit" type="submit" id="save-mail-btn" class="btn btn-success btn-md">E-Mail Adresse ändern</button>

	</form>
	</div>
	</div>
	</div>
	</div>
</section>


<script type="text/javascript">

function formsSet(){
	var newPassword = document.getElementById("user_newPassword").value;
    var newCPassword = document.getElementById("user_newCPassword").value;

    if (newPassword === ''){
        document.getElementById("pw_span").style.display = "block";
    } else {
        document.getElementById("pw_span").style.display = "none";
    }
    
    if (newCPassword === ''){
        document.getElementById("pwC_span").style.display = "block";
    } else {
        document.getElementById("pwC_span").style.display = "none";
    }
}

function setErrorMessagePasswordCheck() {
	document.getElementById("pwNotSame_span").style.display = "block";
}

function validate(){
    var newPassword = document.getElementById("user_newPassword").value;
    var newCPassword = document.getElementById("user_newCPassword").value;
    
    if(newPassword === '' || newCPassword === ''){
        document.getElementById("savePassword").type = "button";
        formsSet();
    } else { 
        if(newPassword != newCPassword) {
    	document.getElementById("savePassword").type = "button";
    	formsSet();
    	setErrorMessagePasswordCheck();
        }
        else {
        	document.getElementById("savePassword").type = "submit";
        }
   	}
}
</script>