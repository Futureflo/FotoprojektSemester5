
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Ihr Warenkorb</h1>
		<p class="lead text-muted">Hier können Sie Größe und Anzahl Ihrer
			Bilder bestimmen, oder diese aus dem Warenkorb entfernen.</p>
	</div>
</section>
<div class="container">
	<div class="row">
		
		<?php
		$shoppingcart_positions = $cart->shoppingcart_positions;
		foreach ( $shoppingcart_positions as $shoppingcart_position ) {
			
			$price = $shoppingcart_position->product_variant->price->prpt_price;
			$amount = $shoppingcart_position->scpo_amount;
			$prodname = $shoppingcart_position->product_variant->prod_name;
			$size = $shoppingcart_position->product_variant->prty_description;
			
			echo '<div class="col-sm-2 col-xs-6">';
			echo '<img src="http://placehold.it/100x100" alt="..."
					class="img-responsive" />
					</div>';
			
			echo '<div class="col-sm-4 col-xs-6">';
			
			echo '<ul style="list-style-type: none">';
			echo '<li><h6>' . $prodname . '</h6></li>';
			echo '<li>Veranstaltung</li>';
			echo '<li>Größe: ' . $size . '</li>';
			echo '<li>Digital/Analog</li>';
			echo '<li><h6>';
			
			echo '<div class="col-sm-1"><h5>' . $price . '<i id="aktuellerpreis">1.99</i>€</h5></div>';
		}
		?>
		</div>
		<div class="col-sm-1">
			<h5>Anzahl:</h5>
		</div>
		<div class="form-group col-sm-2">
			<p>
				<input type="text" class="form-control" id="anzahl"
					onchange="preisaktualisieren()">
			</p>
		</div>
		
		<div class="col-sm-1">
			<button class="btn btn-danger btn-sm">
				<i class="fa fa-trash-o"></i>
			</button>
		</div>
	</div>
	<hr />
		
		<div class="row">
		<div class="col-sm-0 col-s-0"></div>
		<div class="col-sm-2 col-xs-10">
			<h6>Nettopreis:</h6>
			<h6>Mehrwertsteuer(19%):</h6>
			<h6>Versandkosten:</h6>
			<h5>Gesamtpreis:</h5>
		</div>
		
		<div class="col-sm-1 col-xs-2">
			<h6>
				<i id="nettopreis">1.62</i>€
			</h6>
			<h6>
				<i id="mehrwertsteuer">0.38</i>€
			</h6>
			<h6 id="versandkosten">1.00€</h6>
			<h5>
				<i id="gesamtpreis">2.99</i>€
			</h5>
		
		<a href="#" class="btn btn-success btn-block">Zur Kasse <i class="fa fa-angle-right"></i></a>
		</div>
	</div>
	<hr />

</div>
<script>
function preisaktualisieren()
{
var einzelpreis = document.getElementById("einzelpreis").innerHTML;
var anzahl = document.getElementById("anzahl").value;

if (anzahl < 1) {
    document.getElementById("anzahl").value = 1;
} else if (isNaN(anzahl)) {
	document.getElementById("anzahl").value = 1;
} else {
	document.getElementById("aktuellerpreis").innerHTML = parseFloat(einzelpreis)*parseFloat(anzahl);
} 
nettopreis();
mehrwertsteuer();
gesamtpreis();
}


function nettopreis()
{
var aktuellerpreis = document.getElementById("aktuellerpreis").innerHTML;
document.getElementById("nettopreis").innerHTML = parseFloat(aktuellerpreis*0.81).toFixed(2);
}

function mehrwertsteuer()
{
var aktuellerpreis = document.getElementById("aktuellerpreis").innerHTML;
document.getElementById("mehrwertsteuer").innerHTML = parseFloat(aktuellerpreis*0.19).toFixed(2);
}


function gesamtpreis()
{
var aktuellerpreis = document.getElementById("aktuellerpreis").innerHTML;
document.getElementById("gesamtpreis").innerHTML = parseFloat(aktuellerpreis);
}


</script>