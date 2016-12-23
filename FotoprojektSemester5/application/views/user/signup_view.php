<section class="jumbotron text-xs-left">
	<div class="container">
		<div class="row">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item"><a class="nav-link active" href="#kunde"
					data-toggle="tab">Kunde</a></li>
				<li class="nav-item"><a class="nav-link" href="#fotograf"
					data-toggle="tab">Fotograf</a></li>
			</ul>

			<form>
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
										class="form-check-input" id="optionsRadios"
										name="optionsRadios1" value="option1" checked> Frau
									</label> <label class="form-check-label"> <input type="radio"
										class="form-check-input" id="optionsRadios"
										name="optionsRadios2" value="option2"> Herr
									</label>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="vorname"
							placeholder="Vorname">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="nachname"
							placeholder="Nachname">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<select class="form-control" name="land">
								<option>Deutschland</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 col-xs-3">
						<input type="text" class="form-control" name="plz"
							placeholder="PLZ">
					</div>
					<div class="col-sm-9 col-xs-9">
						<input type="text" class="form-control" name="ort"
							placeholder="Ort">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-9 col-xs-9">
						<input type="text" class="form-control" name="str"
							placeholder="Straße">
					</div>
					<div class="col-sm-3 col-xs-3">
						<input type="text" class="form-control" name="hausnr"
							placeholder="Hausnr">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<!--  <input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="<?php
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
						<input type="email" class="form-control" name="emailwdh"
							placeholder="E-Mail wiederholen">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input class="form-control" type="password" name="pw"
							placeholder="Passwort">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<input class="form-control" type="password" name="pwwdh"
							placeholder="Passwort wiederholen">
					</div>
				</div>
			</form>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="kunde">
					<!-- Der Inhalt ist leer, da die Kunden Felder immer angezeigt werden -->
				</div>
				<div role="tabpanel" class="tab-pane" id="fotograf">
					<form>
						<br>
						<div id="signupfotograf">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-insert_product">
										<input type="file" multiple name="dateiupload[]" /> <input
											type="submit" name="btn[upload]" class="btn btn-success"
											value="Gewerbeschein absenden" />
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">
									<input type="text" class="form-control" name="kontoinhaber"
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
					</form>
				</div>
				<br>
				<form>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-check">
								<label class="form-check-label"> <input type="checkbox"
									class="form-check-input"> AGB zustimmen
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-check">
								<label class="form-check-label"> <input type="checkbox"
									class="form-check-input"> Datenschutzrichtlinien akzeptieren
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-check">
								<label class="form-check-label"> <input type="checkbox"
									class="form-check-input"> Newsletter abonnieren
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
				</form>

			</div>
		</div>
	</div>
</section>
