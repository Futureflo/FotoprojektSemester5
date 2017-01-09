<section style="padding-top: 70px">
	<div class="signup-center">
	<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
						<?php
						echo form_open ( 'Login/getNewPassword', '', array (
								'user_id' => $user_id 
						) );
						?>
					
			<div class="form-PasswordReset">
                    <h4>Passwort zurücksetzen</h4>
						<p>Sie haben Ihr Passwort zurücksetzen lassen. Bitte geben Sie Ihr neues Passwort ein.</p>                   		
						<input id="user_newPassword" type="password" class="form-control input-sm chat-input" placeholder="Neues Passwort" name="user_newPassword"/>
                    	<span align="center" id="pw_span" class="text-danger" style="display: none">Das Feld darf nicht leer sein!</span> 
                    <br>
                    	<input id="user_newCPassword" type="password" class="form-control input-sm chat-input" placeholder="Neues Passwort bestätigen" name="user_newCPassword"/>
                    	<span align="center" id="pwC_span" class="text-danger" style="display: none">Das Feld darf nicht leer sein!</span>
                    	<span align="center" id="pwNotSame_span" class="text-danger" style="display: none">Ihre Eingaben sind nicht identisch!</span>
                    <br>
                    <div align="right">
                    <span class="group-btn">    
                    	<button id="savePassword" onclick="validate()" name="submit" type="submit" class="btn btn-primary btn-md">Passwort speichern</button>
                    </span>
                    </div>                    
               </div>
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
