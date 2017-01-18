

<section class="jumbotron text-xs-center" style="padding-bottom: 1rem">
	<div class="container">
		<h1 class="jumbotron-heading">Ihre Bestellung</h1>
		<p class="lead text-muted">Bestätigen</p>
	</div>
</section>
<?php
echo form_open ( "Order/newOrder", '', array (
		'shca_id' => $cart->shca_id 
) );
?>

<div class="container">
	<div class="row">

		<div class="col-md-6 col-xs-12">

			<!-- Postionen -->
			<!--  <h5>Bestellung überprüfen</h5>-->

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Bild</th>
						<th>Produktinfo</th>
						<th>Anzahl</th>
						<th>Preis</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
		<?php
		$shoppingcart_positions = $cart->shoppingcart_positions;
		foreach ( $shoppingcart_positions as $shoppingcart_position ) {
			
			$price = $shoppingcart_position->product_variant->price ['price_sum'];
			$amount = $shoppingcart_position->scpo_amount;
			$prodname = $shoppingcart_position->product_variant->prod_name;
			$size = $shoppingcart_position->product_variant->prty_description;
			$prty_type = $shoppingcart_position->product_variant->prty_type;
			
			// Event zu Produkt-Variante ermitteln
			$even_id = $shoppingcart_position->product_variant->prod_even_id;
			$event = Event::getSingleEventById ( $even_id );
			
			// Für jede Warenkorpostion eine neue HTML-Zeile
			echo "<tr>";
			
			// Spalte 1: Bild
			echo "<td>";
			echo '<img src="http://placehold.it/100x100" alt="..." class="img-responsive" />';
			echo "</td>";
			
			// Spalte 2: Produktinfo
			echo '<td>' . $event->even_name . '<br/>';
			echo '' . $prodname . '<br/>';
			echo '' . $size . '<br/>';
			if ($prty_type == ProductPrintType::print) {
				echo '' . 'Druck' . '<br/>';
			} else {
				echo '' . 'Download' . '</td>';
			}
			echo '<td>' . $amount . '</td>';
			echo '<td class="sum">' . $price * $amount . '€</td>';
			
			// // Spalte 3: Preis
			// echo '<div class="col-sm-1"><h5><i id="aktuellerpreis">' . $price . '</i>€</h5></div>';
			
			// // Spalte 4: Menge
			// echo '<div class="col-sm-1"><h5>Anzahl:</h5> </div>';
			// echo '<div class="form-group col-sm-2">';
			// echo "<p>" . '<input type="text" class="form-control" id="anzahl" value=' . $amount . ' onchange=preisaktualisieren()>' . "</p>";
			// echo "</div>";
			
			// Spalte 5: Button
			echo '<td>';
			echo '<button class="btn btn-danger btn-sm">';
			echo '<i class="fa fa-trash-o"></i>';
			echo '</button>';
			echo '</td>';
			
			echo "</tr>";
		}
		?>
					</tbody>
			</table>
		</div>
		
		<div class="col-md-6 col-xs-12">
			<div class="form-group col-xs-12">
				<label class="h5" for="delivery">Lieferadresse</label>
			    <?php
							echo "<select class=\"form-control\" name=\"orde_de_adre_id\" id=\"delivery\">";
							foreach ( $adresses as $adress ) {
								echo '<option value=' . $adress->adre_id . '>';
								
								echo '<b>' . $adress->adre_name . ' </b>';
								echo $adress->adre_street . ', ' . $adress->adre_city . ', ' . $adress->adre_zip . ' ' . $adress->country->coun_nicename;
								
								echo "</option>";
							}
							echo "</select>";
							?>
			  </div>
			<div class="form-group col-xs-12">
				<label class="h5" for="payadress">Rechnungsadresse</label>
			  	<?php
						echo "<select name=\"orde_in_adre_id\" class=\"form-control\" id=\"payadress\">";
						foreach ( $adresses as $adress ) {
							echo '<option value=' . $adress->adre_id . '>';
							
							echo '<b>' . $adress->adre_name . ' </b>';
							echo $adress->adre_street . ', ' . $adress->adre_city . ', ' . $adress->adre_zip . ' ' . $adress->country->coun_nicename;
							
							echo "</option>";
						}
						echo "</select>";
						?>
			  </div>
			<div class="form-group col-xs-12">
				<label class="h5" for="payment">Zahlungsmethode</label>
			  <?php
					echo "<select name=\"orde_pain_id\" class=\"form-control\" id=\"payment\">";
					echo "<option> PayPal </option>";
					echo "</select>";
					?>
					<hr>
			  </div>
			  
			  
			  <div class="col-xs-12">
				<div class="col-xs-7">
					<h6>Nettopreis:</h6>
					<h6>Mehrwertsteuer(19%):</h6>
					<h6>Versandkosten:</h6>
					<h5>Gesamtpreis:</h5>
				</div>			  
				<div class="col-xs-5">
					<h6 align="right" id="netto"></h6>
					<h6 align="right" id="taxes"></h6>
					<h6 align="right">0,00 €</h6>
					<h5 align="right" onload="sum()" id="endSum"></h5>
				</div>
			</div>
		</div>

	</div>
</div>


<div class="container">
	<hr>
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<button name="submit" type="submit"
				class="btn btn-success btn-block btn-md">zahlungspflichtig bestellen</button>
		</div>
	</div>


	<hr />
</div>

<?php
echo form_close ();
?>

<script type="text/javascript">
function sum(f){
	var sums = document.getElementsByClassName('sum');
	var sum = 0;
	var endSum = document.getElementById('endSum');

	for(var i = 0; i < sums.length; i++){
		sum += parseFloat(sums[i].innerHTML);
	}
	endSum.innerHTML = sum + ' €';
	otherPrice(sum);
}

function otherPrice(s){
	var netto = document.getElementById('netto');
	var taxes = document.getElementById('taxes');

	netto.innerHTML = parseFloat ( s * 0.81 ) . toFixed ( 2 ) + ' €';
	taxes.innerHTML = parseFloat ( s * 0.19 ) . toFixed ( 2 ) + ' €';
}

window.addEventListener('load', sum, false);

</script>

