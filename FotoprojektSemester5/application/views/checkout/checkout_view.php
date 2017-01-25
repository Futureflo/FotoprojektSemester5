
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Ihr Warenkorb</h1>
		<p class="lead text-muted">Hier können Sie Größe und Anzahl Ihrer Bilder bestimmen, oder diese aus dem Warenkorb entfernen.</p>
	</div>
</section>
<div class="container">
	<div class="row" id="cart_div">	
		<?php
		if (isset ( $cart->shoppingcart_positions )) {
			$shoppingcart_positions = $cart->shoppingcart_positions;
			foreach ( $shoppingcart_positions as $shoppingcart_position ) {
				
				$price = $shoppingcart_position->product_variant->price ['price_sum'];
				$amount = $shoppingcart_position->scpo_amount;
				$prodname = $shoppingcart_position->product_variant->prod_name;
				$size = $shoppingcart_position->product_variant->prty_description;
				$prod_filepath = $shoppingcart_position->product_variant->prod_filepath;
				
				// Event zu Produkt-Variante ermitteln
				$even_id = $shoppingcart_position->product_variant->prod_even_id;
				$event = Event::getSingleEventById ( $even_id );
				
				// Für jede Warenkorpostion eine neue HTML-Zeile
				echo '<div class="row"> ';
				
				echo '<div class="col-md-6 col-sm-12">';
				
				// Spalte 1: Bild
				echo '<div class="col-md-6 col-sm-6">';
				
				echo " <img data-src='../" . $prod_filepath . "'" . " alt=" . $prodname . " . src=../" . $prod_filepath . " style=\"width:auto ;height:auto; display: inline;\">";
				echo '</div>';
				
				// Spalte 2: Produktinfo
				echo '<div class="col-md-6 col-sm-6">';
				echo '<ul style="list-style-type: none">';
				echo '<li><h6>' . $prodname . '</h6></li>';
				echo '<li>Veranstaltung: ' . $event->even_name . '</li>';
				echo '<li>Größe: ' . $size . '</li>';
				
				switch ($shoppingcart_position->product_variant->prty_type) {
					case ProductPrintType::prints :
						{
							echo "<li>" . 'Druck' . "</li>";
							break;
						}
					case ProductPrintType::download :
						{
							echo "<li>" . 'Download' . "</li>";
							break;
						}
					case ProductPrintType::article :
						{
							echo "<li>" . 'Artikel' . "</li>";
							break;
						}
					default :
						{
							echo "<li>" . 'Undefiniert' . "</li>";
							break;
						}
				}
				
				echo '</div>';
				echo '</div>';
				
				echo '<div class="col-md-6 col-sm-12">';
				// Spalte 3: Preis
				echo '<div class="col-md-2 col-sm-3"><h5><i class="aktuellerpreis">' . $price * $amount . '</i>€</h5></div>';
				
				echo form_open ( '/', '' );
				// Spalte 4: Menge
				echo '<div class="col-md-4 col-sm-3"><h5>Anzahl:</h5> </div>';
				echo '<div class="form-group col-md-4 col-sm-3">';
				echo "<p>" . '<input type="text" maxLength="4" onblur="updateAmount(this)" onchange="this.value = minmax(this, 1, 1000)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" class="anzahl" value=' . $amount . ' name="scpo_amount" >' . "</p>";
				echo '<input type="hidden" class="one" value=' . $price . '>';
				echo '<input type="hidden" name="amount_hidden" value="">';
				echo '<input type="hidden" name="scpo_prod_id" value=' . $shoppingcart_position->scpo_prod_id . '>';
				echo '<input type="hidden" name="scpo_prty_id" value=' . $shoppingcart_position->scpo_prty_id . '>';
				echo '<input type="hidden" name="scpo_shca_id" value=' . $shoppingcart_position->scpo_shca_id . '>';
				echo "</div>";
				
				echo form_close ();
				
				// Spalte 5: Button
				echo form_open ( "Shoppingcart/delete", '', array (
						'scpo_prod_id' => $shoppingcart_position->scpo_prod_id,
						'scpo_prty_id' => $shoppingcart_position->scpo_prty_id,
						'scpo_amount' => $amount,
						'scpo_shca_id' => $shoppingcart_position->scpo_shca_id 
				) );
				
				echo '<div class="col-md-2 col-sm-3">';
				echo '<button class="btn btn-danger btn-sm">';
				echo '<i class="fa fa-trash-o"></i>';
				echo '</button>';
				echo '</div>';
				
				// // Spalte 6: aktualisieren
				// echo form_open ( "Shoppingcart/delete", '', array (
				// 'scpo_prod_id' => $shoppingcart_position->scpo_prod_id,
				// 'scpo_prty_id' => $shoppingcart_position->scpo_prty_id,
				// 'scpo_amount' => $amount,
				// 'scpo_shca_id' => $shoppingcart_position->scpo_shca_id
				// ) );
				
				// echo '<div class="col-sm-1">';
				// echo '<button class="btn btn-success btn-sm">';
				// echo '<i class="fa fa fa-check"></i>';
				// echo '</button>';
				// echo '</div>';
				
				// Ende der HTML-Zeile
				echo '</div>';
				echo '</div>';
				echo form_close ();
			}
		}
		?>
		</div>
	<hr>
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
				<i id="nettopreis"></i>€
			</h6>
			<h6>
				<i id="mehrwertsteuer"></i>€
			</h6>

			<h6>
				<i id="versandkosten"></i>0.00€
			</h6>

			<h5>
				<i id="gesamtpreis"></i>€
			</h5>
		</div>
	</div>
	<div class="row">
		
		<?php
		if ($this->session->userdata ( 'login' )) {
			echo form_open ( "Checkout/reset", '' );
		}
		?>
<button name="submit" type="submit" class="btn btn-success btn-block btn-md" id="checkout-btn"
			<?php
			if (isset ( $cart->shoppingcart_positions ) == FALSE) {
				echo " disabled ";
			}
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
						echo base_url ()?>checkout"
							class="btn btn-secondary">Als Gast bestellen</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>



<script type="text/javascript">
function updateAmount(element) {
    var insertURL = "<?php
				
				echo base_url ()?>/Shoppingcart/update";
   
    // the script where you handle the form input.
    var request = $.ajax({
           type: "POST",
           url: insertURL,
           data: $(element.parentNode.parentNode.parentNode).serialize(), // serializes the form's elements.
           success: function(data)
           {
               //alert(data); // show response from the php script.
           }
         });
    request.fail(function (jqXHR, textStatus) {
	    alert("Das gewählte Produkt kann aktuell nicht aktualisiert werden, wenden Sie sich bitte an den Administrator.")
	});

}




    function login(){
        document.getElementById("login-btn").click();
    }
    
    function minmax(value, min, max) 
    {
    	value.parentNode.nextSibling.nextSibling.value = value.value;

        change(value);
        if(parseInt(value.value) < min || isNaN(parseInt(value.value))){
        	change(value); 
        	value.parentNode.nextSibling.nextSibling.value = 1;
            return 1; 
        }else if(parseInt(value.value) > max){
        	change(value); 
        	value.parentNode.nextSibling.nextSibling.value = 1000;
            return 1000; 
        }else return value.value;
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

function checkCart(){
	var button = document.getElementById('checkout-btn');
	var div = document.getElementById('cart_div');
	console.log('start');
	console.log(div.childElementCount);
	if(div.childElementCount <= 0){
		button.disabled = "true";
		console.log('dis');
	}
}
      
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
    	console.log(e);
    	 var row = e.parentNode.parentNode.parentNode.parentNode.parentNode;
         var price = row.getElementsByClassName('aktuellerpreis')[0];
         var number = e.value;
         var one = row.getElementsByClassName('one')[0].value;
        
        if (isNaN ( number )) {
            number = parseFloat(1);
        } else if (number < 1) {
            number = 1;
        } else {
            price.innerHTML = (parseFloat ( one ) * parseFloat ( number )).toFixed(2);
        }
        
        articleSum();
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

