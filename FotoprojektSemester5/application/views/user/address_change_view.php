<section style="padding-top: 70px">
	<div class="signup-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
			<?php
			echo form_open ( 'user/newAddress' );
			?>

				<h1>Adresse hinzufügen</h1>
					<br>
					<div class="form-group col-sm-12">
						<input type="text" class="form-control" placeholder="Vorname" id="del_vorname" name="firstname" value="<?php
						
						echo $firstname;
						?>">
						
											<?php
											if (validation_errors ( 'firstname' ) != null) {
												if (form_error ( 'firstname' ) != "") {
													echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'firstname' ) . "</div>";
												}
											}
											?>
					</div>
					<div class="form-group col-sm-12">
						 <input type="text" class="form-control" placeholder="Nachname" id="del_nachname" name="name" value="<?php
							
							echo $name;
							
							?>">
											<?php
											if (validation_errors ( 'name' ) != null) {
												if (form_error ( 'name' ) != "") {
													echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'name' ) . "</div>";
												}
											}
											?>
					</div>
					<div class="form-group col-sm-12">
						<input type="text" class="form-control" placeholder="Straße" id="del_street" name="street" value="<?php
						
						echo $street;
						?>">
											<?php
											if (validation_errors ( 'street' ) != null) {
												if (form_error ( 'street' ) != "") {
													echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'street' ) . "</div>";
												}
											}
											?>
					</div>
					<div class="form-group col-sm-12">
						<input class="form-control" type="text" placeholder="PLZ" id="del_plz" name="zip" value="<?php
						
						echo $zip;
						
						?>">
											<?php
											if (validation_errors ( 'zip' ) != null) {
												if (form_error ( 'zip' ) != "") {
													echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'zip' ) . "</div>";
												}
											}
											?>
					</div>
					<div class="form-group col-sm-12">
						<input type="text" class="form-control" placeholder="Stadt" id="del_city" name="city" value="<?php
						
						echo $city;
						
						?>">
											<?php
											if (validation_errors ( 'city' ) != null) {
												if (form_error ( 'city' ) != "") {
													echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . form_error ( 'city' ) . "</div>";
												}
											}
											?>
					</div>

					<br>
					<button name="submit" type="submit" id="save-address-btn" class="btn btn-success btn-md">Adresse hinzufügen</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</section>
