<section class="jumbotron text-xs-left">
	<div class="container">

		<div id="fehler_span" class="text-danger"><?php
		echo $this->session->flashdata ( 'msgReg' );
		?></div>

		<div class="row">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item"><a class="nav-link <?php
				
				if ($type_hidden_field == 2) {
					echo "active";
				}
				?>" href="#customer" data-toggle="tab" onmouseout="checkType()">Kunde</a></li>
				<li class="nav-item"><a class="nav-link <?php
				
				if ($type_hidden_field == 3) {
					echo "active";
				}
				?>" href="#photographer" data-toggle="tab" onmouseout="checkType()">Fotograf</a></li>
			</ul>
					<?php
					echo form_open_multipart ( 'signup/' );
					?>

				<div class="form-group">
				<fieldset class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="jumbotron-heading">Persönliche Angaben:</h3>
							<br>
						</div>
					</div>
					<div class="form-check">
						<div class="row">
							<div class="col-sm-3">
								<label class="form-check-label"> <input type="radio" class="form-check-input" name="gender" value="Frau" checked> Frau
								</label> <label class="form-check-label"> <input type="radio" class="form-check-input" name="gender" value="Herr"> Herr
								</label>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input type="text" class="form-control" name="firstname" value="<?php
					
					echo set_value ( 'firstname' );
					?>" placeholder="Vorname"> <span class="text-danger">
							<?php
							
							echo form_error ( 'firstname' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="text" class="form-control" name="lastname" value="<?php
					
					echo set_value ( 'lastname' );
					?>" placeholder="Nachname"> <span class="text-danger">
							<?php
							
							echo form_error ( 'lastname' );
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
					<input type="text" class="form-control" name="zip" value="<?php
					
					echo set_value ( 'zip' );
					?>" placeholder="PLZ"> <span class="text-danger">
							<?php
							
							echo form_error ( 'zip' );
							?>
							</span>
				</div>
				<div class="col-sm-9 col-xs-9">
					<input type="text" class="form-control" name="city"  value="<?php
					
					echo set_value ( 'city' );
					?>"placeholder="Ort"> <span class="text-danger">
							<?php
							
							echo form_error ( 'city' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-9 col-xs-9">
					<input type="text" class="form-control" name="street" value="<?php
					
					echo set_value ( 'street' );
					?>" placeholder="Straße"> <span class="text-danger">
							<?php
							
							echo form_error ( 'street' );
							?>
							</span>
				</div>
				<div class="col-sm-3 col-xs-3">
					<input type="text" class="form-control" name="housenumber" value="<?php
					
					echo set_value ( 'housenumber' );
					?>" placeholder="Hausnr"> <span class="text-danger">
							<?php
							
							echo form_error ( 'housenumber' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<!--  <input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="
						<?php
						echo set_value ( 'birthday' );
						?>"/>  -->
					<input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Geburtstag" name="birthday" /> <span
						class="text-danger">
							<?php
							
							echo form_error ( 'birthday' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="email" class="form-control" name="email" value="<?php
					
					echo set_value ( 'email' );
					?>" placeholder="E-Mail"> <span class="text-danger">
							<?php
							
							echo form_error ( 'email' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="email" class="form-control" name="cemail" value="<?php
					
					echo set_value ( 'cemail' );
					?>" placeholder="E-Mail wiederholen"> <span class="text-danger">
							<?php
							
							echo form_error ( 'cemail' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" type="password" name="password" placeholder="Passwort"> <span class="text-danger">
							<?php
							
							echo form_error ( 'password' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" type="password" name="cpassword" placeholder="Passwort wiederholen"> <span class="text-danger">
							<?php
							
							echo form_error ( 'cpassword' );
							?>
							</span>
				</div>
			</div>


			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="customer">
					<!-- Der Inhalt ist leer, da die Kunden Felder immer angezeigt werden -->
				</div>
				<div role="tabpanel" class="tab-pane" id="photographer">

					<br>
					<div id="signupphotographer">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-insert_product">

									<div class="col-sm-10">
										<label>Gewerbeschein: &nbsp</label>
										<input type="file" name="tradelicense" onchange="checkFile(this)" />
									</div>
									<span class="text-danger">
									<?php
									echo form_error ( 'tradelicense' );
									?>
									</span>
									<div class="col-sm-2">
										<input type="hidden" name="uploadcheck" id="uploadcheck"
											value="notChecked" /><i id="check" class="fa fa-check"
											aria-hidden="true" style="display: none"></i>
									</div>

								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" class="form-control" name="accountholder" value="<?php
								
								echo set_value ( 'accountholder' );
								?>" placeholder="Kontoinhaber"> <span class="text-danger">
							<?php
							
							echo form_error ( 'accountholder' );
							?>
							</span>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" class="form-control" name="iban" value="<?php
								
								echo set_value ( 'iban' );
								?>" placeholder="IBAN"> <span class="text-danger">
							<?php
							
							echo form_error ( 'iban' );
							?>
							</span>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" class="form-control" name="bic" value="<?php
								
								echo set_value ( 'bic' );
								?>" placeholder="BIC"> <span class="text-danger">
							<?php
							
							echo form_error ( 'bic' );
							?>
							</span>
							</div>
						</div>
					</div>

				</div>
				<br>

				<div class="row">
					<div class="col-sm-12">
						<div class="form-check">
							<label class="form-check-label"> <input type="checkbox" class="form-check-input" name="checktermsandconditions"> AGB zustimmen
							</label> <span class="text-danger">
							<?php
							
							echo form_error ( 'checktermsandconditions' );
							?>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-check">
							<label class="form-check-label"> <input type="checkbox" class="form-check-input" name="checklegalnotice"> Datenschutzrichtlinien akzeptieren
							</label> <span class="text-danger">
							<?php
							
							echo form_error ( 'checklegalnotice' );
							?>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-check">
							<label class="form-check-label"> <input type="checkbox" class="form-check-input" name="checknewsletter"> Newsletter abonnieren
							</label> <span class="text-danger">
							<?php
							
							echo form_error ( 'checknewsletter' );
							?>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<button name="submit" type="submit" class="btn btn-primary btn-md btn-block">Registrieren</button>
					</div>
				</div>


			</div>
			<input id="type_hidden_field" type="hidden" name="type_hidden_field" value= <?php
			
			echo $type_hidden_field?>>
			<?php
			
			echo form_close ();
			?>
		</div>
	</div>
</section>

<script type="text/javascript">
  function checkFile(i){
	var check = document.getElementById('check');
	var hidden = document.getElementById('uploadcheck');

	if(i.value.length > 0){
		check.style.display = "block";
		hidden.value = "checked";
	} else {
		check.style.display = "none";
		hidden.value = "notChecked";
	}
  }  

	function checkType(){
		console.log('start');
        var customer = document.getElementById('customer');
        var photograph = document.getElementById('photographer');
        var field = document.getElementById('type_hidden_field');
        
        if(customer.classList.contains('active')){
            field.value = "2";
        } else if(photograph.classList.contains('active')){
            field.value = "3";
        }
	}
</script>
