<?php echo form_open ( "Checkout", '' ); ?>
<section class="jumbotron text-xs-center" style="padding-bottom: 1rem">
	<div class="container">
		<h1 class="jumbotron-heading">Ihre Bestellung</h1>
	</div>
</section>

<div class="container">
	<div class="checkout_border">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="checkout_overviewelements_connector"></div>
				<div class="checkout_overviewelement_left">
					<div
						class="checkout_overviewelement rounded-circle checkout_overviewelement_active"></div>
					<div class="checkout_overviewelement_text">Adresse</div>
				</div>
				<div class="checkout_overviewelement_middle">
					<div class="checkout_overviewelement rounded-circle"></div>
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
			<div class="col-md-12 col-sm-12">
				<div class="form-group col-md-6 col-sm-12">
					<h4>Rechnungsadresse</h4>
					<label for=""></label> <select class="form-control" id="invoiceAdressID" name="invoiceAdressID">
						<?php echo $invoiceAdressesOptions; ?>
					</select>
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<h4>Lieferadresse</h4>
					<label for=""></label> <select class="form-control" id="deliveryAdressID" name="deliveryAdressID">
						<option value="0">wie Rechnungsadresse</option>
						<?php echo $deliveryAdressesOptions; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div
				class="col-md-4 offset-md-8 col-sm-4 offset-sm-4 col-xs-4 offset-xs-4">
				<button type="submit" class="btn btn-primary">Weiter zu Zahlungsart</button>
				<?php
				echo form_close ();
				?>
			</div>
		</div>
	</div>
</div>



