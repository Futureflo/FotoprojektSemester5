<section class="jumbotron text-xs-left">
	<div class="container">
					<?php
					echo form_open_multipart ( 'signup/' );
					?>
								<div id="fehler_span" class="text-danger"><?php
								
								echo $this->session->flashdata ( 'msgReg' );
								?></div>
	
		<div class="row">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item"><a class="nav-link active" href="#customer"
					data-toggle="tab" onmouseout="checkType()">Kunde</a></li>
				<li class="nav-item"><a class="nav-link" href="#photographer"
					data-toggle="tab" onmouseout="checkType()">Fotograf</a></li>
			</ul>

			<form action="<?php
			
echo base_url ();
			?>user/" method="post">
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
									<label class="form-check-label"> <input type="radio"
										class="form-check-input" id="sex"
										name="female" value="option1" checked> Frau
									</label> <label class="form-check-label"> <input type="radio"
										class="form-check-input" id="sex"
										name="male" value="option2"> Herr
									</label>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="firstname"
							placeholder="Vorname">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="lastname"
							placeholder="Nachname">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<select class="form-control" name="country">
								<option>Deutschland</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 col-xs-3">
						<input type="text" class="form-control" name="zip"
							placeholder="PLZ">
					</div>
					<div class="col-sm-9 col-xs-9">
						<input type="text" class="form-control" name="city"
							placeholder="Ort">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-9 col-xs-9">
						<input type="text" class="form-control" name="street"
							placeholder="Straße">
					</div>
					<div class="col-sm-3 col-xs-3">
						<input type="text" class="form-control" name="housenumber"
							placeholder="Hausnr">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<!--  <input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="
						<?php
						echo set_value ( 'birthday' );
						?>"/>  -->
						<input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" 
							placeholder="Geburtstag" name="birthday" /> <span
							class="text-danger"><?php
							
							echo form_error ( 'birthday' );
							?></span>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input type="email" class="form-control" name="email"
							placeholder="E-Mail">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input type="email" class="form-control" name="emailrepeat"
							placeholder="E-Mail wiederholen">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input class="form-control" type="password" name="password"
							placeholder="Passwort">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input class="form-control" type="password" name="passwordrepeat"
							placeholder="Passwort wiederholen">
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
									<?php
									
									echo form_open_multipart ( 'signup/uploadTradeLicense' );
									?>
										<input type="file" name="dateiupload" /> <input
											type="submit" name="btn[upload]" class="btn btn-success"
											value="Gewerbeschein absenden" />
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">
									<input type="text" class="form-control" name="accountholder"
										placeholder="Kontoinhaber">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">
									<input type="text" class="form-control" name="iban"
										placeholder="IBAN">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">
									<input type="text" class="form-control" name="bic"
										placeholder="BIC">
								</div>
							</div>
						</div>
					
				</div>
				<br>
				
					<div class="row">
						<div class="col-sm-12">
							<div class="form-check">
								<label class="form-check-label"> <input type="checkbox"
									class="form-check-input" name="checktermsandconditions"> AGB zustimmen
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-check">
								<label class="form-check-label"> <input type="checkbox"
									class="form-check-input" name="checklegalnotice"> Datenschutzrichtlinien akzeptieren
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-check">
								<label class="form-check-label"> <input type="checkbox"
									class="form-check-input" name="checknewsletter"> Newsletter abonnieren
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4"></div>
						<div class="col-sm-6">
							<button name="submit" type="submit"
								class="btn btn-primary btn-md">Registrieren</button>
						</div>
					</div>
				

			</div>
			<input id="type_hidden_field" type="hidden" name="type_hidden_field" value="">
			</form>
		</div>
	</div>
</section>




<script type="text/javascript">
    

	function checkType(){
        var customer = document.getElementById('customer');
        var photograph = document.getElementById('photographer');
        var field = document.getElementById('type_hidden_field');
        
        if(customer.classList.contains('active')){
            field.value = "customer";
        } else if(photograph.classList.contains('active')){
            field.value = "photographer";
        }
	}
    
    window.addEventListener('load', checkType, false);
</script>
