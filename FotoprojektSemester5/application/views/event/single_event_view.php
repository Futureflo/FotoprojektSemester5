<div style="visibility: hidden;" id="shoppingCartInsertURL"><?php
echo base_url ();
?>Shoppingcart/insert</div>
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"><?php
		echo $event->even_name;
		?></h1>

	</div>
</section>


<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-12">

			<ul class="nav nav-pills nav-justified">
				<li class="nav-item"><a class="nav-link active" href="#"
					id="public_pill">Event Bilder</a></li>
				<li class="nav-item"><a class="nav-link" href="#" id="private_pill">Private
						Bilder</a></li>
			</ul>

		</div>
		<div class="col-md-6 col-sm-12">
			<?php
			echo form_open_multipart ( "Product/insert", array (
					"name" => "newproduct" 
			), array (
					'even_id' => $event->even_id 
			) );
			?>
			
			<?php
			if ($this->session->userdata ( 'login' )) {
				echo "<div class='form-insert_product' id='upload_div'> <input type='file' multiple name='dateiupload[]' /> <input type='submit' name='btn[upload]' class='btn btn-success' /> </div>";
			}
			?>
	
			</form>
			<?php
			
			echo $this->session->flashdata ( 'upload' );
			?>

		</div>
	</div>
</div>


<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info" data-toggle="modal" -->
<!-- 	data-target="#bestellungModal">Modal Version 1</button> -->

<!-- <div class="table-responsive"> -->

<!-- 	<table class="table table-striped"> -->
<?php
// // echo "<tr>" . "<th>ID:</th>" . "<th>" . $event->even_id . "</th></tr>";
// echo "<tr>" . "<th>Bezeichung:</th>" . "<th>" . $event->even_name . "</th></tr>";
// echo "<tr>" . "<th>Datum:</th>" . "<th>" . $event->even_date . "</th></tr>";
// echo "<tr>" . "<th>URL:</th>" . "<th>" . $event->even_url . "</th></tr>";
// echo "<tr>" . "<th>Event Fotograf:</th>" . "<th>" . $event->user_firstname . " " . $event->user_name . "</th></tr>";
// echo "</tr>";
// ?>
<!-- 	</table> -->
<!-- </div> -->




<div class="album text-muted" id="public">
	<div class="container">

		<div class="row">
		<?php
		foreach ( $products as $product ) {
			$product->prod_complete_filepath = base_url () . $product->prod_filepath;
			
			echo "<div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12 mycard\">";
			echo "<div class=\"lazyload\">";
			echo "<!--";
			echo "<a class=\"thumbnail\">";
			echo " <img class=\"mypictureborder\" data-src='../../" . $product->prod_filepath . "'" . " alt=" . $product->prod_name . " style=\"width:304px;height:228px; display: block;\"
					src=../../" . $product->prod_filepath . " onclick='openModal(" . json_encode ( $product ) . ")'>";
			echo "</a>";
			// echo "<p class=\"card-text\">" . $product->prod_name . "</p>";
			echo "-->";
			echo "</div>";
			echo "</div>";
		}
		
		?>
		</div>
	</div>
</div>

<div class="album text-muted" id="private">
	<div class="container">

		<div class="row">
		<?php
		foreach ( $products as $product ) {
			$product->prod_complete_filepath = base_url () . $product->prod_filepath;
			
			echo "<div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12 mycard\">";
			echo "<div class=\"lazyload\">";
			echo "<!--";
			echo "<a class=\"thumbnail\">";
			echo " <img class=\"mypictureborder\" data-src='../../" . $product->prod_filepath . "'" . " alt=" . $product->prod_name . " style=\"width:304px;height:228px; display: block;\"
					src=../../" . $product->prod_filepath . " onclick='openModal(" . json_encode ( $product ) . ")'>";
			echo "</a>";
			// echo "<p class=\"card-text\">" . $product->prod_name . "</p>";
			echo "-->";
			echo "</div>";
			echo "</div>";
		}
		
		?>
		</div>
	</div>
</div>

<button type="button" id="buttonModal" data-toggle="modal"
	data-target="#bestellungModal" style="display: none"></button>

<script>
function openModal(product){
	document.getElementById("buttonModal").click();
	var modalImg=document.getElementById("modalImg");
	modalImg.setAttribute("alt",product.prod_name);
	modalImg.setAttribute("src",product.prod_complete_filepath.replace("_thumb",""));
	modalImg.setAttribute("data-src",product.prod_complete_filepath.replace("_thumb",""));
// 	alert(product.prod_id); -> 
// 	alert(entry.prty_id); - scpo_prty_id
// 	1 - scpo_amount
// 	array ('scpo_prod_id' => $product_variant->prod_id, 'scpo_prty_id' => $product_variant->prty_id, 'scpo_amount' => 1 ) );
// 	
	$( "#scpo_prod_id" ).val(product.prod_id);
	$( "#scpo_prty_id" ).val(product.prty_id);
	$( "#scpo_amount" ).val(1);
	//document.getElementById("scpo_prod_id").value(product.prod_id);
	//document.getElementById("scpo_prty_id").value(entry.prty_id);
	//document.getElementById("scpo_amount").value(1);
	removeOptions(document.getElementById("beschreibungSelect"));
		
	var bestelloptionen = document.getElementById("beschreibungSelect");
	product.product_variants.forEach(function(entry) {
	   	var option = document.createElement("option");
		option.text = entry.prty_description + " - " + entry.price.price_sum + "€";
		option.value = product.prod_id+"-"+entry.prty_id;
		//option.prty_id = 
		bestelloptionen.add(option);
		
	});
 
}
function removeOptions(selectbox)
{
    var i;
    for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
    {
        selectbox.remove(i);
    }
}
</script>


<!-- Modal -->
<div id="bestellungModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Bestellung aufgeben</h4>
			</div>

			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<img class="img-responsive" id="modalImg"
								style="max-width: 100%; height: auto;">
						</div>
						<br />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="container">
					<div class="row">
						<?php
						
						echo form_open ( '/', 'id="addToCartForm"', array (
								'even_prsu_id' => $event->even_prsu_id 
						) );
						?>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<div class="col-md-3 col-sm-2 col-xs-2">
								<p>Art:
								
								
								<p />
							</div>
							<div class="col-md-9 col-sm-10 col-xs-10">
								<div class="form-group">
									<select class="form-control" id="beschreibungSelect"
										name="beschreibungSelect">
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<input type="submit" name="In den Warenkorb"
								value="In den Warenkorb" class="btn btn-success" />
						</div>
						<!--<input type="hidden" id="scpo_prod_id" value="">
						<input type="hidden" id="scpo_prty_id" value=""> --!-->
						<input type="hidden" id="scpo_amount" name="scpo_amount" value="1">
						<!-- array ('scpo_prod_id' => $product_variant->prod_id, 'scpo_prty_id' => $product_variant->prty_id, 'scpo_amount' => 1 ) ); !-->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
echo '<script>';
echo 'var userrole;';
echo 'userrole = ' . $this->session->userdata ( 'user_role' );
echo '</script>';

?>

<script>
$("#addToCartForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var insertURL = $("#shoppingCartInsertURL").html();
    // alert(url);
    // the script where you handle the form input.
    var request = $.ajax({
           type: "POST",
           url: insertURL,
           data: $("#addToCartForm").serialize(), // serializes the form's elements.
           success: function(data)
           {
               //alert(data); // show response from the php script.
               $('#bestellungModal').modal('hide')
           }
         });
    request.fail(function (jqXHR, textStatus) {
	    alert("Das gewählte Produkt kann aktuell nicht hinzugefügt werden, wenden Sie sich bitte an den Administrator.")
        $('#bestellungModal').modal('hide')
	});

});

// hide user upload and picture
$(document).ready(function(){ 
	$("#private").hide();
	if(userrole == 2){
		$("#upload_div").hide();
	}
});

// show user upload and pictures
$("#private_pill").click(function() { 
	$("#private").fadeIn("slow");
	$("#public").fadeOut("slow");
	$(this).addClass('active').parent().siblings().children().removeClass('active');

	if(userrole == 2){
		$("#upload_div").fadeIn("slow");
	}
});

// change user pictures to fotograf pictures
$("#public_pill").click(function() { 
	$("#private").fadeOut("slow");
	$("#public").fadeIn("slow");
	$(this).addClass('active').parent().siblings().children().removeClass('active');

	if(userrole == 2){
		$("#upload_div").fadeOut("slow");
	}
});
</script>