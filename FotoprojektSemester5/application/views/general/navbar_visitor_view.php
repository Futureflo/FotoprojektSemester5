
<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
	<button class="navbar-toggler hidden-sm-up pull-right" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar"
		aria-controls="exCollapsingNavbar" aria-expanded="false" aria-label="Toggle navigation"></button>
	<div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar">
		<a class="navbar-brand" href="<?php
		echo base_url ();
		?>">FPS5</a>
		<ul class="nav navbar-nav">


		<!--  <li class="nav-item dropdown" aria-labelledby="exCollapsingNavbar"><a class="nav-link dropdown-toggle" href="http://example.com"
				id="supNportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
				<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
					 <a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>admin/users/">Alle Benutzer</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/archivedUsers/">Benutzer Archiv</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/events/">Alle Events</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/printers/">Alle Druckereien (System)</a>
				</div></li> -->	



		<!--	<li class="nav-item dropdown" aria-labelledby="exCollapsingNavbar"><a class="nav-link dropdown-toggle" href="http://example.com"
				id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
				<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
					<a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>user/">Benutzereinstellungen</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>user/1/">Einzelner Benutzer</a>
				</div></li> -->	




			<!-- 		<li class="nav-item"><a class="nav-link" 
			href="<?php
			
			echo base_url ();
			?>picture/asd/"><i class="fa fa-camera" aria-hidden="true"></i> Einzelnes Bild <i class="fa fa-picture-o" aria-hidden="true"></i></a></li>
		
	 		<li class="nav-item"><a class="nav-link" 
			href="<?php
			
			echo base_url ();
			?>printers/">Eigene Druckereien</a></li> -->


			<div class="float-md-right">

				<li class="nav-item active "><a class="nav-link" href="<?php
				
				echo base_url ();
				?>">Home <span class="sr-only"></span></a></li>

				<!-- <li class="nav-item "><a class="nav-link" href="<?php
				
				echo base_url ();
				?>">Fotograf</a></li> -->

				<!-- <li class="nav-item dropdown "><a class="nav-link dropdown-toggle" href="http://example.com" id="supportedContentDropdown" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">Event</a>
					<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
						<a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>event/">Neues Event</a> <a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>event/aFqS/">Einzelnes Event</a> <a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>event/kksd/">Falsches Event</a>
					</div></li> -->

				<li class="nav-item "><a class="nav-link" href="<?php
				
				echo base_url ();
				?>checkout/"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>

				<li class="nav-item active "><button type="button" id="login-btn" class="nav-link btn btn-success btn-md" data-toggle="modal"
						data-target="#loginModal">Anmelden</button></li>
			</div>

		</ul>
	</div>
</nav>

<!-- Modal -->
<div id="loginModal" class="modal-md fade modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">       
				<div id="fehler_span" class="text-danger"><?php
				
				echo $this->session->flashdata ( 'msg' );
				?></div> 
        
       
					<?php
					
					$attributes = array (
							"name" => "loginform" 
					);
					echo form_open ( "login/", $attributes );
					?>
			
		                    <input type="text" class="form-control input-sm chat-input" placeholder="E-Mail-Adresse eingeben" id="user_email"
					name="user_email" value="<?php
					
					echo set_value ( 'user_email' );
					?>" /> <span align="center" id="email_span" class="text-danger" style="display: none">Das Feld darf nicht leer sein!</span> </br> <input
					type="password" class="form-control input-sm chat-input" placeholder="Passwort eingeben" id="user_password" name="user_password"
					value="<?php
					
					echo set_value ( 'user_password' );
					?>" /> <span align="center" id="password_span" class="text-danger" style="display: none">Das Feld darf nicht leer sein!</span> </br>
				<div class="container">
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<div class="login-btn-wrapper">
								<span class="group-btn">
									<button onclick="validate()" id="login" name="submit" type="submit" class="btn btn-primary btn-md btn-block">Login</button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 offset-md-2">
							<a href="<?php
							
							echo base_url ();
							?>login/forgotPassword/">Passwort vergessen?</a>
						</div>
					</div>
				</div>
				<?php
				
				echo form_close ();
				?>
				


			</div>


			<div class="modal-footer text-center">
				<div class="container">
					<div class="row">
						<div class="col-md-8 offset-md-2">
							<a href="<?php
							
							echo base_url ();
							?>signup/" class="btn btn-success btn-md btn-block" role="button">Registrieren</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    window.onload = function(){
        if(document.getElementById("fehler_span").innerHTML.length > 0){
            var text = document.getElementById("fehler_span").innerHTML;
            document.getElementById("login-btn").click();
            if(text.includes("erfolgreich")) {
                 document.getElementById("fehler_span").className="alert alert-success";
            }
            else {
            document.getElementById("fehler_span").className="alert alert-danger";
            }
        }
    }
    
    document.getElementById("user_password")
    	.addEventListener("keyup", function(event) {
    	event.preventDefault();
		    if (event.keyCode == 13) {
		        document.getElementById("login").click();
		    }
	});
    
    function formsSet(){
        var email = document.getElementById("user_email").value;
        var password = document.getElementById("user_password").value;
            
        if (email === ''){
            document.getElementById("email_span").style.display = "block";
        } else {
            document.getElementById("email_span").style.display = "none";
        }
        
        if (password === ''){
            document.getElementById("password_span").style.display = "block";
        } else {
            document.getElementById("password_span").style.display = "none";
        }
    }
    
    function validate(){
    	
        var email = document.getElementById("user_email").value;
        var password = document.getElementById("user_password").value;
        
        if(email === '' || password === ''){
            document.getElementById("login").type = "button";
            document.getElementById("fehler_span").className="text-danger";
       	 	document.getElementById("fehler_span").innerHTML = "";
            formsSet();
        } else {
            document.getElementById("login").type = "submit";
        }
    }
</script>