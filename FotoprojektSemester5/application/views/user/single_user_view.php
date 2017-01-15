
<section class="jumbotron text-xs-center" style="margin: 3.25rem 0rem 0rem 0rem;">
	<div class="container">
		<h1 class="jumbotron-heading">Benutzer Einstellungen</h1>
	</div>
</section>

<div id="save_data_spam" class="text-success"><?php
?></div>

<div class="container">
	<form action="<?php
	
	echo base_url ();
	?>" method="post">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h2 style="text-decoration: underline;">Persönliche Daten</h2>
				<div class="form-group col-xs-7">
					<label for="gender">Anrede</label> <select class="form-control" id="gender">
						<option>Herr</option>
						<option>Frau</option>
					</select>
				</div>
				<div class="form-group col-xs-7">
					<label for="vorname">Vorname</label> <input type="text" class="form-control" id="vorname" value="<?php
					
					echo $user_firstname;
					?>">
				</div>
				<div class="form-group col-xs-7">
					<label for="nachname">Nachname</label> <input type="text" class="form-control" id="nachname" value="<?php
					
					echo $user_name;
					?>">
				</div>
				<div class="form-group col-xs-7">
					<label for="birthday">Geburtsdatum</label> <input class="form-control" type="date" id="birthday" value="<?php
					
					echo $user_birthday;
					?>">
				</div>
			</div>

			<div class="col-md-6 col-sm-12">
				<h2 style="text-decoration: underline;">Lieferadresse</h2>
				<div class="form-group col-xs-7">
					<label for="number">Name</label> <input type="text" class="form-control" id="number" value="<?php
					
					echo $adre_name;
					?>">
				</div>
				<div class="form-group col-xs-7">
					<label for="street">Straße</label> <input type="text" class="form-control" id="street" value="<?php
					
					echo $adre_street;
					?>">
				</div>
				<div class="form-group col-xs-7">
					<label for="plz">PLZ</label> <input class="form-control" type="text" id="plz" value="<?php
					
					echo $adre_zip;
					?>">
				</div>
				<div class="form-group col-xs-7">
					<label for="city">Stadt</label> <input type="text" class="form-control" id="city" value="<?php
					
					echo $adre_city;
					?>">
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="form-group col-xs-12">
				<button type="button" id="save-user-btn" class="btn btn-success btn-md">Speichern</button>
			</div>
		</div>
	</form>
</div>

<hr>

<div class="container">
	<form action="<?php
	
	echo base_url ();
	?>" method="post">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h2 style="text-decoration: underline;">Passwort</h2>
				<div class="form-group col-xs-7">
					<label for="oldpassword">Altes Passwort</label> <input type="password" class="form-control" id="oldpassword">
				</div>
				<div class="form-group col-xs-7">
					<label for="newpassword">Neues Passwort</label> <input type="password" class="form-control" id="newpassword">
				</div>
				<div class="form-group col-xs-7">
					<label for="proofpassword">Passwort bestätigen</label> <input class="form-control" type="password" id="proofpassword" />
				</div>
				<br>
				<div class="form-group col-xs-12">
					<button type="button" id="save-pwd-btn" class="btn btn-success btn-md">Speichern</button>
				</div>
			</div>
		</div>
	</form>
</div>

<hr>

<div class="container">
	<form action="<?php
	
	echo base_url ();
	?>" method="post">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h2 style="text-decoration: underline;">Email-Adresse</h2>
				<div class="form-group col-xs-7">
					<label for="mail">Email-Adresse</label> <input type="text" class="form-control" id="mail" value="<?php
					
					echo $user_email;
					?>">
				</div>
				<div class="form-group col-xs-7">
					<label for="pwd">Passwort</label> <input type="password" class="form-control" id="pwd">
				</div>
				<br>
				<div class="form-group col-xs-12">
					<button type="button" id="save-mail-btn" class="btn btn-success btn-md">Speichern</button>
				</div>
			</div>
		</div>
	</form>
</div>

<hr>
<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<a class="btn btn-danger" data-toggle="modal" data-target="#delete" title="Benutzer löschen">
					<i class="fa fa-trash-o fa-lg" aria-hidden="True" style="color:white;"></i>
						<span style="color:white;">Benutzer löschen</span>
				</a>				
			</div>
		</div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog"
	aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">

	    <div class="modal-content">
	    	<div class="modal-header">
	       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        	<h4 class="modal-title custom_align" id="Heading">Benutzer löschen?</h4>
	 		</div>
	   		<div class="modal-body">   
				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
		       		</span>Möchten Sie Ihren Benutzeraccount unwiderruflich löschen? <br> Durch die Bestätigung werden Sie direkt ausgeloggt. Ihre Daten werden unwiderruflich gelöscht und Sie haben keinen Zugriff mehr auf Ihren Account.
		       	</div>
	 		</div>
		  	<div class="modal-footer ">
		        <form action="<?php
										
										echo base_url ();
										?>user/deleteUser/" method="post">
			        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>Benutzer löschen</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
		        </form>
			</div>
		</div>
    	<!-- /.modal-content --> 
	</div>
      <!-- /.modal-dialog --> 
</div>
