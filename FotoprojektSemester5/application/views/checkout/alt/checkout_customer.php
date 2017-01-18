<section class="jumbotron text-xs-center" style="padding-bottom: 1rem">
	<div class="container">
		<h1 class="jumbotron-heading">Ihre Bestellung</h1>
		<p class="lead text-muted">Adresse</p>

	</div>
</section>
<hr>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<h2 style="text-decoration: underline;">Rechnungsadresse</h2>
			<div class="form-group col-md-6 col-sm-12">
				<label for="gender">Anrede</label> <select class="form-control" id="gender_payment">
					<option>Herr</option>
					<option>Frau</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="vorname">Vorname</label> <input type="text" class="form-control" id="vorname_payment" value="<?php
				echo $user_firstname;
				?>">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="nachname">Nachname</label> <input type="text" class="form-control" id="nachname_payment"
					value="<?php
					
					echo $user_name;
					?>">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="street">Straße</label> <input type="text" class="form-control" id="street_payment" value="<?php
				
				echo $adre_street;
				?>">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="plz">PLZ</label> <input class="form-control" type="text" id="plz_payment" value="<?php
				
				echo $adre_zip;
				?>">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="city">Stadt</label> <input type="text" class="form-control" id="city_payment" value="<?php
				
				echo $adre_city;
				?>">
			</div>
		</div>

		<div class="col-md-12 col-sm-12" style="display: none;" id="payment_adress">
			<h2 style="text-decoration: underline;">Lieferadresse</h2>
			<div class="form-group col-md-6 col-sm-12">
				<label for="gender">Anrede</label> <select class="form-control" id="gender_delivery">
					<option>Herr</option>
					<option>Frau</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="vorname">Vorname</label> <input type="text" class="form-control" id="vorname_delivery">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="nachname">Nachname</label> <input type="text" class="form-control" id="nachname_delivery">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="street">Straße</label> <input type="text" class="form-control" id="street_delivery">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="plz">PLZ</label> <input class="form-control" type="text" id="plz_delivery">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="city">Stadt</label> <input type="text" class="form-control" id="city_delivery">
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="form-group col-md-2">
			<button type="button" class="btn btn-secondary" id="payment_adress_btn">Abweichende Liferadresse</button>
		</div>
		<div class="form-group col-md-2 offset-md-8">
		<?php
		echo form_open ( "Checkout/payment", '' );
		?>
			<button type="submit" id="next-btn" class="btn btn-success btn-md btn-block">Weiter</button>
			<?php
			echo form_close ();
			?>
		</div>
	</div>
</div>



<script>
$(document).ready(function(){ 
	  $("#payment_adress_btn").click(function() { 
	    $("#payment_adress").fadeToggle("slow");
	  });

	  
	});
</script>