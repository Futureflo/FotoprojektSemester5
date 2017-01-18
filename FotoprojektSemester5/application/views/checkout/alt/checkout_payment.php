<section class="jumbotron text-xs-center" style="padding-bottom: 1rem">
	<div class="container">
		<h1 class="jumbotron-heading">Ihre Bestellung</h1>
		<p class="lead text-muted">Zahlungsart</p>

	</div>
</section>
<hr>

<div class="container">
	<div class="row">
		<div class="col-md-10 ">
			<h2 style="text-decoration: underline;">Zahlungsart</h2>
			<br>
			<div class="col-sm-12">
				<label class="form-check-label h4" data-toggle="tooltip" title=""> <input type="radio"
					class="form-check-input" 
					name="payment" value="PayPal" checked><i class="fa fa-paypal" aria-hidden="true"></i> PayPal (kostenlos)
				</label> 
				<p class="text-muted">(Die Weiterleitung zu PayPal erfolgt am Ende des Bestellvorgangs zur Zahlungsabwicklung. Die Bestellung ist danach erfolgreich abgeschlossen.)</p>
				<br>
				<label class="form-check-label h4" data-toggle="tooltip" title=""> <input type="radio"
					class="form-check-input"
					name="payment" value="Vorkasse"><i class="fa fa-credit-card" aria-hidden="true"></i> Vorkasse (kostenlos)
				</label>
				<p class="text-muted">(Wir bitten darum den Gesamtbetrag vorab auf unsere Konto zu überweisen. Nach Abschluss der Bestellung informieren wir Sie über unsere Bankverbindung. Nach Eingang der Bezahlung wird ihre Bestellung versendet.)</p>
			</div>
		</div>
		<br>
		<div class="col-md-4 offset-md-8 col-sm-4 offset-sm-4 col-xs-4 offset-xs-4">
		<?php
		echo form_open ( "Checkout/overview", '' );
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
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>