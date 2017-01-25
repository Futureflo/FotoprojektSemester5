
<section class="jumbotron text-xs-center" style="margin: 3.25rem 0rem 0rem 0rem;">
	<div class="container">
		<h1 class="jumbotron-heading">Benutzer Einstellungen</h1>
				<?php
				if ($this->session->flashdata ( 'emailChange' ) != "") {
					echo "<div id='fehler_span' class='alert alert-success'>";
					echo $this->session->flashdata ( 'emailChange' );
					echo "</div>";
				} elseif ($this->session->flashdata ( 'pwChange' ) != "") {
					echo "<div id='fehler_span' class='alert alert-success'>";
					echo $this->session->flashdata ( 'pwChange' );
					echo "</div>";
				}
				?>
	</div>
</section>

<div id="save_data_spam" class="text-success"><?php
?></div>

<div class="container">
			<?php
			echo form_open ( 'user/changeUserDataAdress' );
			?>
		<div class="row">
		<div class="col-md-6 col-sm-12">
			<h2 style="text-decoration: underline;">Persönliche Daten</h2>

			<div class="form-group col-xs-12">
				<label for="gender">Anrede</label> <select class="form-control" id="gender" name="gender">
					<option>Herr</option>
					<option>Frau</option>
				</select>
			</div>
			<div class="form-group col-xs-12">
				<label for="vorname">Vorname</label> <input type="text" class="form-control" id="vorname" name="firstname"
					value="<?php
					
					echo $user_firstname;
					?>">
										<?php
										if (validation_errors ( 'firstname' ) != null) {
											if (form_error ( 'firstname' ) != "") {
												echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'firstname' ) . "</div>";
											}
										}
										?>
			</div>
			<div class="form-group col-xs-12">
				<label for="nachname">Nachname</label> <input type="text" class="form-control" id="nachname" name="lastname" value="<?php
				
				echo $user_name;
				?>">
										<?php
										if (validation_errors ( 'lastname' ) != null) {
											if (form_error ( 'lastname' ) != "") {
												echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'lastname' ) . "</div>";
											}
										}
										?>
			</div>
			<div class="form-group col-xs-12">
				<label for="birthday">Geburtsdatum</label> <input class="form-control" type="date" id="birthday" name="birthday"
					value="<?php
					
					echo $user_birthday;
					?>">
										<?php
										if (validation_errors ( 'birthday' ) != null) {
											if (form_error ( 'birthday' ) != "") {
												echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'birthday' ) . "</div>";
											}
										}
										?>
			</div>
		</div>

		<div class="col-md-6 col-sm-12">
			<h2 style="text-decoration: underline;">Adresse</h2>
			<div class="form-group col-xs-12">
				<label for="address-chooser">Adressauswahl</label> <select onclick="changeAddresses(this)" class="selectpicker form-control"
					data-style="btn-primary">
					<?php
					foreach ( $adre as $adress ) {
						echo '<option>';
						echo $adress->adre_name . ', ' . $adress->adre_street . ', ' . $adress->adre_zip . ', ' . $adress->adre_city;
						echo '</option>';
					}
					?>
					</select>
			</div>
			<div class="form-group col-xs-12">
				<input id="adressID" type="hidden" name="adressID" value="<?php
				
				echo $adre_id;
				?>">
				<label for="number">Name</label> <input type="text" class="form-control" id="name" name="fullname" value="<?php
				
				echo $adre_name;
				?>">
														<?php
														if (validation_errors ( 'fullname' ) != null) {
															if (form_error ( 'fullname' ) != "") {
																echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'fullname' ) . "</div>";
															}
														}
														?>
			</div>
			<div class="form-group col-xs-12">
				<label for="street">Straße</label> <input type="text" class="form-control" id="street" name="street" value="<?php
				
				echo $adre_street;
				?>">
																		<?php
																		if (validation_errors ( 'street' ) != null) {
																			if (form_error ( 'street' ) != "") {
																				echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'street' ) . "</div>";
																			}
																		}
																		?>
			</div>
			<div class="form-group col-xs-3">
				<label for="plz">PLZ</label> <input class="form-control" type="text" id="plz" name="zip" value="<?php
				
				echo $adre_zip;
				?>">
																						<?php
																						if (validation_errors ( 'zip' ) != null) {
																							if (form_error ( 'zip' ) != "") {
																								echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'zip' ) . "</div>";
																							}
																						}
																						?>
			</div>
			<div class="form-group col-xs-9">
				<label for="city">Stadt</label> <input type="text" class="form-control" id="city" name="city" value="<?php
				
				echo $adre_city;
				?>">
																						<?php
																						if (validation_errors ( 'city' ) != null) {
																							if (form_error ( 'city' ) != "") {
																								echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'city' ) . "</div>";
																							}
																						}
																						?>
			</div>
			</div>
		</div>
	<br>
	<div class="row">
		<div class="form-group col-xs-6">
			<button type="submit" id="save-user-btn" class="btn btn-success btn-md">Speichern</button>
		</div>
		<div class="form-group col-xs-6">
			<a class="active" href="<?php
			
			echo base_url ();
			?>user/call_change_address_view">
				<button type="button" id="sa-user-btn" class="btn btn-primary btn-md">Neue Adresse</button>
			</a>
		</div>
	</div>
	</form>
</div>

<hr>

<div class="container">
	<div class="row">
		<form action="<?php
		
		echo base_url ();
		?>user/call_change_email_view" method="post">

			<div class="col-md-8 col-sm-8">
				<h2>Benutzerdaten</h2>
				<div class="form-group col-xs-12">
				<span class="label label-primary"><?php
				
				echo $user_email;
				?></span>
				
</div>
				<div class="form-group col-xs-12">
					<button name="submit" type="submit" id="save-mail-btn" class="btn btn-success btn-md">E-Mail Adresse ändern</button>
					<a class="active" href="<?php
					
					echo base_url ();
					?>user/call_change_passwordSettings_view"><button type="button" class="nav-link btn btn-primary btn-md">Passwort ändern</button></a>
				</div>
			</div>
	
	</div>
	</form>


</div>

<hr>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<a class="btn btn-danger" data-toggle="modal" data-target="#delete" title="Benutzer löschen"> <i class="fa fa-trash-o fa-lg" aria-hidden="True"
				style="color: white;"></i> <span style="color: white;">Benutzer löschen</span>
			</a>
		</div>
	</div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<h4 class="modal-title custom_align" id="Heading">Benutzer löschen?</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-warning-sign"> </span>Möchten Sie Ihren Benutzeraccount unwiderruflich löschen? <br> Durch die Bestätigung
					werden Sie direkt ausgeloggt. Ihre Daten werden unwiderruflich gelöscht und Sie haben keinen Zugriff mehr auf Ihren Account.
				</div>
			</div>
			<div class="modal-footer ">
				<form action="<?php
				
				echo base_url ();
				?>user/deleteUser/" method="post">
					<button type="submit" class="btn btn-danger">
						<span class="glyphicon glyphicon-ok-sign"></span>Benutzer löschen
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span>Abbrechen
					</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    var addresses = <?php
				
				echo json_encode ( $adre );
				?>;

    function changeAddresses(select){
    	document.getElementById('adressID').value = addresses[select.selectedIndex].adre_id;
		document.getElementById('name').value = addresses[select.selectedIndex].adre_name;
		document.getElementById('street').value = addresses[select.selectedIndex].adre_street;
		document.getElementById('plz').value = addresses[select.selectedIndex].adre_zip;
		document.getElementById('city').value = addresses[select.selectedIndex].adre_city;
    }
</script>

