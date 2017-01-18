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
				<label for="gender">Anrede</label> <select class="form-control" id="gender">
					<option>Herr</option>
					<option>Frau</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="vorname">Vorname</label> <input type="text" class="form-control" id="vorname">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="nachname">Nachname</label> <input type="text" class="form-control" id="nachname">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="street">Straße</label> <input type="text" class="form-control" id="street">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="plz">PLZ</label> <input class="form-control" type="text" id="plz">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="city">Stadt</label> <input type="text" class="form-control" id="city">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="country">Land</label> <input type="text" class="form-control" id="country">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="birthday">Geburtsdatum</label> <input class="form-control" type="date" id="birthday">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="mail">E-Mail Adresse</label> <input type="text" class="form-control" id="mail">
			</div>
			<div class="form-group col-md-12 col-sm-12">
				<button type="button" class="btn btn-secondary" id="payment_adress_btn">Abweichende Liferadresse</button>
			</div>
			
			
			
		</div>

		<div class="col-md-12 col-sm-12" style="display: none;" id="payment_adress">
			<h2 style="text-decoration: underline;">Lieferadresse</h2>
			<div class="form-group col-md-6 col-sm-12">
				<label for="gender">Anrede</label> <select class="form-control" id="gender">
					<option>Herr</option>
					<option>Frau</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="vorname">Vorname</label> <input type="text" class="form-control" id="vorname">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="nachname">Nachname</label> <input type="text" class="form-control" id="nachname">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="street">Straße</label> <input type="text" class="form-control" id="street">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="plz">PLZ</label> <input class="form-control" type="text" id="plz">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="city">Stadt</label> <input type="text" class="form-control" id="city">
			</div>
			<div class="form-group col-md-6 col-sm-12">
				<label for="country">Land</label> <input type="text" class="form-control" id="country">
			</div>
		</div>
	</div>
	<div class="row">
	<div class="col-xs-12">
				<label class="form-check-label"> <input class="form-check-input" type="checkbox"> Als Kunde anlegen.
				</label> 
				<br>
				<label class="form-check-label"> <input class="form-check-input" type="checkbox"> Ich stimme den <a
					href="<?php
					echo base_url ()?>privacypolicy" style="text-decoration: underline;">Datenschutzrichtlinien</a> sowie den <a
					href="<?php
					
					echo base_url ()?>termsandconditions" style="text-decoration: underline;">AGBs</a> zu.
				</label>
			</div>
		<div class="col-md-4 offset-md-8 col-sm-4 offset-sm-4 col-xs-4 offset-xs-4">
		<?php
		echo form_open ( "Checkout/payment", '' );
		?>
			<button type="submit" class="btn btn-primary">Weiter zu Zahlungsart</button>
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