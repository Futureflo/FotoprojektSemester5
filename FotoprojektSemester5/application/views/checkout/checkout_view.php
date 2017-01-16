
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Ihr Warenkorb</h1>
		<p class="lead text-muted">Hier können Sie Größe und Anzahl Ihrer Bilder bestimmen, oder diese aus dem Warenkorb entfernen.</p>
	</div>
</section>
<div class="container">	
		<?php
		$shoppingcart_positions = $cart->shoppingcart_positions;
		foreach ( $shoppingcart_positions as $shoppingcart_position ) {
			
			$price = $shoppingcart_position->product_variant->price ['price_sum'];
			$amount = $shoppingcart_position->scpo_amount;
			$prodname = $shoppingcart_position->product_variant->prod_name;
			$size = $shoppingcart_position->product_variant->prty_description;
			
			// Event zu Produkt-Variante ermitteln
			$even_id = $shoppingcart_position->product_variant->prod_even_id;
			$event = Event::getSingleEventById ( $even_id );
			
			// Für jede Warenkorpostion eine neue HTML-Zeile
			echo '<div class="row"> ';
			
			// Spalte 1: Bild
			echo '<div class="col-sm-2 col-xs-6">';
			echo '<img src="http://placehold.it/100x100" alt="..."
					class="img-responsive" />
					</div>';
			
			// Spalte 2: Produktinfo
			echo '<div class="col-sm-4 col-xs-6">';
			echo '<ul style="list-style-type: none">';
			echo '<li><h6>' . $prodname . '</h6></li>';
			echo '<li>Veranstaltung: ' . $event->even_name . '</li>';
			echo '<li>Größe: ' . $size . '</li>';
			echo '<li>Digital/Analog</li>';
			echo '</div>';
			
			// Spalte 3: Preis
			echo '<div class="col-sm-1"><h5><i class="aktuellerpreis">' . $price . '</i>€</h5></div>';
			
			// Spalte 4: Menge
			echo '<div class="col-sm-1"><h5>Anzahl:</h5> </div>';
			echo '<div class="form-group col-sm-2">';
			echo "<p>" . '<input type="text" min="1" max="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" class="anzahl" value=' . $amount . ' onkeyup=change(this) >' . "</p>";
			echo '<input type="hidden" class="one" value=' . $price . '>';
			echo "</div>";
			
			// Spalte 5: Button
			echo '<div class="col-sm-1">';
			echo '<button class="btn btn-danger btn-sm">';
			echo '<i class="fa fa-trash-o"></i>';
			echo '</button>';
			echo '</div>';
			
			// Ende der HTML-Zeile
			echo '</div>';
		}
		?>
		<hr>
	<div class="row">
		<div class="col-sm-0 col-s-0"></div>
		<div class="col-sm-2 col-xs-10">
			<h6>Nettopreis:</h6>
			<h6>Mehrwertsteuer(19%):</h6>
			<!-- <h6>Versandkosten:</h6> -->
			<h5>Gesamtpreis:</h5>
		</div>

		<div class="col-sm-1 col-xs-2">
			<h6>
				<i id="nettopreis">1.62</i>€
			</h6>
			<h6>
				<i id="mehrwertsteuer">0.38</i>€
			</h6>
		<!-- <h6 id="versandkosten">0.00€</h6> -->	
			<h5>
				<i id="gesamtpreis">2.99</i>€
			</h5>
		</div>
	</div>
	<div class="row">
		
		<?php
		if ($this->session->userdata ( 'login' )) {
			echo form_open ( "Checkout/customer", '' );
		}
		?>
<button name="submit" type="submit" class="btn btn-success btn-block btn-md"
			<?php
			
			if (! $this->session->userdata ( 'login' )) {
				echo "data-toggle=\"modal\" data-target=\"#notLogedinModal\"";
			}
			?>>Zur Kasse</button>
			<?php
			echo form_close ();
			?>
	</div>


	<hr />

</div>


<!-- Modal -->
<div id="notLogedinModal" class="modal-xl fade modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-sm-8 offset-sm-3">
						<a onclick="login()" id="login_from_modal" href="#" class="btn btn-primary">Anmelden</a> <a href="<?php
						echo base_url ()?>checkout/guest"
							class="btn btn-secondary">Als Gast bestellen</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>



<script type="text/javascript">
    function login(){
        document.getElementById("login-btn").click();
    }


    function nettopreis() {
        var sum = document . getElementById ( "gesamtpreis" ) . innerHTML;
        var netto = document.getElementById("nettopreis"); 

        netto.innerHTML = parseFloat ( sum * 0.81 ) . toFixed ( 2 );
    }
    function mehrwertsteuer() {
        var sum = document . getElementById ( "gesamtpreis" ) . innerHTML;
        var taxes = document.getElementById("mehrwertsteuer"); 

        taxes.innerHTML = parseFloat ( sum * 0.19 ) . toFixed ( 2 );
    }
		

    $('#login_from_modal').click(function() {
        $('#notLogedinModal').modal('hide');
    });
    
    $(document).ready(function(){
	   articleSum();
	});
    
function articleSum(){
    var price = document.getElementsByClassName("aktuellerpreis");
    
    var sum = 0;
    
    for(var i = 0; i < price.length; i++){
        sum += parseFloat (price[i].innerHTML);
    }
    
    document.getElementById('gesamtpreis').innerHTML = sum.toFixed(2);
    nettopreis ();
    mehrwertsteuer ();
}
    
    
    function change(e){
        var row = e.parentNode.parentElement.parentElement;
        var price = row.getElementsByClassName('aktuellerpreis')[0];
        var number = e.value;
        var one = row.getElementsByClassName('one')[0].value;

        console.log(number);
        
        if (isNaN ( number )) {
            number = parseFloat(1);
        } else if (number < 1) {
            number = 1;
        } else {
            price.innerHTML = (parseFloat ( one ) * parseFloat ( number )).toFixed(2);
        }
        
        articleSum();
        console.log(number);
    }
    
    
    
    
    
    
    function preisaktualisieren()
    {
    var einzelpreis = document . getElementById ( "einzelpreis" ) . innerHTML;
    var anzahl = document . getElementById ( "anzahl" ) . value;

                if (anzahl < 1) {
        document.getElementById("anzahl").value = 1;
                } else if (isNaN ( anzahl )) {
        document.getElementById("anzahl").value = 1;
                } else {
        document.getElementById("aktuellerpreis").innerHTML = parseFloat ( einzelpreis ) * parseFloat ( anzahl );
                }
                nettopreis ();
                mehrwertsteuer ();
                gesamtpreis ();
            }
    function gesamtpreis() {
        var sum = document . getElementById ( "gesamtpreis" ) . innerHTML;
        document.getElementById("gesamtpreis").innerHTML = parseFloat ( aktuellerpreis );
		}
</script>

