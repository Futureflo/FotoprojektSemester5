<section style="padding-top: 70px">
	<div class="signup-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
			<?php
			echo form_open ( 'user/newAddress' );
			?>

				<h1>Adresse ändern</h1>
					<br>
					<div class="form-group col-sm-12">
						<label for="vorname">Vorname</label> <input type="text" class="form-control" id="del_vorname" name="firstname" value="">
					</div>
					<div class="form-group col-sm-12">
						<label for="nachname">Nachname</label> <input type="text" class="form-control" id="del_nachname" name="name" value="">
					</div>
					<div class="form-group col-sm-12">
						<label for="street">Straße und Hausnummer</label> <input type="text" class="form-control" id="del_street" name="street" value="">
					</div>
					<div class="form-group col-sm-12">
						<label for="plz">PLZ</label> <input class="form-control" type="text" id="del_plz" name="plz" value="">
					</div>
					<div class="form-group col-sm-12">
						<label for="city">Stadt</label> <input type="text" class="form-control" id="del_city" name="city" value="">
					</div>

					<br>
					<button name="submit" type="submit" id="save-address-btn" class="btn btn-success btn-md">Adresse ändern</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</section>
