<section class="jumbotron text-xs-left">
	<div class="container">

		<div id="fehler_span" class="text-danger"><?php
		echo $this->session->flashdata ( 'msgReg' );
		?></div>

		<div class="row">
					<?php
					// Check if newPrinter or editPrinter
					if (! isset ( $printers [0]->prsu_id )) {
						// Set values for newPrinter
						$PrintersCreationViewHeader = "Druckerei anlegen";
						$adressname = set_value ( 'addressname' );
						$zip = set_value ( 'zip' );
						$city = set_value ( 'city' );
						$street = set_value ( 'street' );
						$housenumber = set_value ( 'housenumber' );
						$email = set_value ( 'email' );
						$cemail = set_value ( 'cemail' );
						echo form_open_multipart ( 'PrintersCreation/newPrinter' );
					} else {
						// Set values for editPrinter
						$PrintersCreationViewHeader = "Druckerei bearbeiten";
						// Split street and housenumber
						// Find a match and store it in $result.
						if (preg_match ( '/([^\d]+)\s?(.+)/i', $printers [0]->adre_street, $result )) {
							// $result[1] will have the steet name
							$street = trim ( $result [1] );
							// and $result[2] is the number part.
							$housenumber = trim ( $result [2] );
						}
						$adressname = $printers [0]->adre_name;
						$zip = $printers [0]->adre_zip;
						$city = $printers [0]->adre_city;
						$email = $printers [0]->prsu_email;
						$cemail = $printers [0]->prsu_email;
						$prsu_id = $printers [0]->prsu_id;
						$adre_id = $printers [0]->prsu_adre_id;
						echo form_open_multipart ( 'PrintersCreation/editPrinter' );
						echo "<input id='adre_id_hidden_field' type='hidden' name='adre_id_hidden' value= $adre_id/>";
						echo "<input id='prsu_id_hidden_field' type='hidden' name='prsu_id_hidden' value= $prsu_id/>";
					}
					?>
					
					
				<div class="form-group">
				<fieldset class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="jumbotron-heading"><?php
							echo $PrintersCreationViewHeader;
							?>
							</h3>
							<br>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input type="text" class="form-control" name="addressname"
						value="<?php
						
						echo $adressname;
						?>"
						placeholder="Druckerei Name"> <span class="text-danger">
							<?php
							
							echo form_error ( 'addressname' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<select class="form-control" name="country">
							<option>Deutschland</option>
						</select> <span class="text-danger">
							<?php
							
							echo form_error ( 'country' );
							?>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-3">
					<input type="text" class="form-control" name="zip"
						value="<?php
						
						echo $zip;
						?>" placeholder="PLZ"> <span class="text-danger">
							<?php
							
							echo form_error ( 'zip' );
							?>
							</span>
				</div>
				<div class="col-sm-9 col-xs-9">
					<input type="text" class="form-control" name="city"
						value="<?php
						
						echo $city;
						?>" placeholder="Ort"> <span class="text-danger">
							<?php
							
							echo form_error ( 'city' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-9 col-xs-9">
					<input type="text" class="form-control" name="street"
						value="<?php
						
						echo $street;
						?>"
						placeholder="Straße"> <span class="text-danger">
							<?php
							
							echo form_error ( 'street' );
							?>
							</span>
				</div>
				<div class="col-sm-3 col-xs-3">
					<input type="text" class="form-control" name="housenumber"
						value="<?php
						
						echo $housenumber;
						?>"
						placeholder="Hausnr"> <span class="text-danger">
							<?php
							
							echo form_error ( 'housenumber' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="email" class="form-control" name="email"
						value="<?php
						
						echo $email;
						?>"
						placeholder="E-Mail"> <span class="text-danger">
							<?php
							
							echo form_error ( 'email' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="email" class="form-control" name="cemail"
						value="<?php
						
						echo $cemail;
						?>"
						placeholder="E-Mail wiederholen"> <span class="text-danger">
							<?php
							
							echo form_error ( 'cemail' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4 offset-md-4">
					<button name="submit" type="submit"
						class="btn btn-primary btn-md btn-block">Speichern</button>
				</div>
			</div>
			<input id="type_hidden_field" type="hidden" name="type_hidden_field"
				value="">
			<?php
			
			echo form_close ();
			?>
		</div>
	</div>
</section>





<script type="text/javascript">
 	function checkType(){
        var customer = document.getElementById('customer');
        var photograph = document.getElementById('photographer');
        var field = document.getElementById('type_hidden_field');
        
        if(customer.classList.contains('active')){
            field.value = "2";
        } else if(photograph.classList.contains('active')){
            field.value = "3";
        }
	}
    
    window.addEventListener('load', checkType, false);
</script>