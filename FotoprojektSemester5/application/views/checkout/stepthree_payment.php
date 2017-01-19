<section class="jumbotron text-xs-center" style="padding-bottom: 1rem">
	<div class="container">
		<h1 class="jumbotron-heading">Ihre Bestellung</h1>
	</div>
</section>
<hr>

<?php echo form_open ( "Checkout", '' ); ?>

<div class="container">
	<div class="checkout_border">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="checkout_overviewelements_connector"></div>
				<div class="checkout_overviewelement_left">
					<div
						class="checkout_overviewelement rounded-circle checkout_overviewelement_selected"></div>
					<div class="checkout_overviewelement_text">Adresse</div>
				</div>
				<div class="checkout_overviewelement_middle">
					<div
						class="checkout_overviewelement rounded-circle checkout_overviewelement_active"></div>
					<div class="checkout_overviewelement_text">Zahlungsart</div>
				</div>
				<div class="checkout_overviewelement_right">
					<div class="checkout_overviewelement rounded-circle"></div>
					<div class="checkout_overviewelement_text">Best&auml;tigen</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<h2 style="text-decoration: underline;">Zahlungsart</h2>
				<br> 
				<label class="form-check-label h4" data-toggle="tooltip" title=""> 
				<input type="radio" class="form-check-input" name="payment" value="PayPal" checked><i class="fa fa-paypal" aria-hidden="true"></i> PayPal (kostenlos)
				</label>
				<p class="text-muted">(Die Weiterleitung zu PayPal erfolgt am Ende
					des Bestellvorgangs zur Zahlungsabwicklung. Die Bestellung ist
					danach erfolgreich abgeschlossen.)</p>
				<br> 
				<label class="form-check-label h4" data-toggle="tooltip" title=""> <input type="radio" class="form-check-input" name="payment" value="Vorkasse"><i class="fa fa-credit-card" aria-hidden="true"></i> Vorkasse (kostenlos)
				</label>
				<p class="text-muted">(Wir bitten darum den Gesamtbetrag vorab auf
					unsere Konto zu überweisen. Nach Abschluss der Bestellung
					informieren wir Sie über unsere Bankverbindung. Nach Eingang der
					Bezahlung wird ihre Bestellung versendet.)</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-4">
				<button type="submit" class="btn btn-default" name="action" value="back">Abbrechen</button>
			</div>
			<div
				class="col-md-4 offset-md-4 col-sm-4  col-xs-4">
				<button type="submit" class="btn btn-primary" name="action" value="next">Weiter zu
					Best&auml;tigung</button>
				<?php
				echo form_close ();
				?>
			</div>
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