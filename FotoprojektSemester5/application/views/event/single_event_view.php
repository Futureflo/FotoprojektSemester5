
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"><?php
		echo $event->even_name;
		?></h1>
		<!-- 		<p class="lead text-muted">Something short and leading about the
			collection below—its contents, the creator, etc. Make it short and
			sweet, but not too short so folks don't simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary">Main call to action</a> <a
				href="#" class="btn btn-secondary">Secondary action</a>
		</p> -->
	</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<?php
			echo form_open_multipart ( "Product/insert", array (
					"name" => "newproduct" 
			), array (
					'even_id' => $event->even_id 
			) );
			?>
				<div class="form-insert_product">
<!-- 				<input type="file" multiple name="dateiupload[]" /> <input type="submit" name="btn[upload]" class="btn btn-success" /> -->
			</div>
<!-- 			</form> -->
			
			<?php
			
			echo $this->session->flashdata ( 'msg' );
			?>					
		</div>
	</div>
</div>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info" data-toggle="modal" -->
<!-- 	data-target="#bestellungModal">Modal Version 1</button> -->

<div class="table-responsive">

	<table class="table table-striped">
			<?php
// 			echo "<tr>" . "<th>ID:</th>" . "<th>" . $event->even_id . "</th></tr>";
			echo "<tr>" . "<th>Bezeichung:</th>" . "<th>" . $event->even_name . "</th></tr>";
			echo "<tr>" . "<th>Datum:</th>" . "<th>" . $event->even_date . "</th></tr>";
			echo "<tr>" . "<th>URL:</th>" . "<th>" . $event->even_url . "</th></tr>";
			echo "<tr>" . "<th>Event Fotograf:</th>" . "<th>" . $event->user_firstname . " " . $event->user_name . "</th></tr>";
			echo "</tr>";
			?>
	</table>
</div>


<div class="album text-muted">
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
// 			echo "<p class=\"card-text\">" . $product->prod_name . "</p>";
			echo "-->";
			echo "</div>";
			echo "</div>";
		

		}
		
		?>
		</div>
	</div>
</div>

<button type="button" id="buttonModal" data-toggle="modal" data-target="#bestellungModal" style="display:none"></button>

<script>

function openModal(product){
	document.getElementById("buttonModal").click();
	var modalImg=document.getElementById("modalImg");

	modalImg.setAttribute("alt",product.prod_name);
	modalImg.setAttribute("src",product.prod_complete_filepath.replace("_thumb",""));
	modalImg.setAttribute("data-src",product.prod_complete_filepath.replace("_thumb",""));

// 	alert(product.prod_id);
// 	alert(entry.prty_id);

	removeOptions(document.getElementById("beschreibungSelect"));
		
	var bestelloptionen = document.getElementById("beschreibungSelect");
	product.product_variants.forEach(function(entry) {
	   	var option = document.createElement("option");
		option.text = entry.prty_description + " - " + entry.price.price_sum + "€";
		option.id = product.prod_id;
		option.prty_id = entry.prty_id;
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

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Bestellung aufgeben</h4>
			</div>
			<!--  Ende Header -->

			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-md-12" >
							<img class="img-responsive" id="modalImg" style="max-width:100%; height:auto;">
						</div>
						<br />
					
						<!--  col-md-12 -->
					</div>
					<!--  row -->
				</div>
				<!--  container -->
			</div>
			<!--  modal body -->

			<div class="modal-footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">	
							<div class="col-md-3 col-sm-2 col-xs-2">
								<p>Art:<p />		
							</div>
		
							<div class="col-md-9 col-sm-10 col-xs-10">
		
								<div class="form-group">
									<select class="form-control" id="beschreibungSelect">
									</select>
								</div>
							</div>
						</div>
				
							
		
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<!-- 								<div class="col-md-6 col-sm-6 col-xs-12">	 -->
<!-- 									<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button> -->
<!-- 								</div>				 -->
					
							<?php							
							
							 	echo form_open ( "ShoppingCart/insert", '',
							 			'');
// 							 			array (
// 							 			'scpo_prod_id' => $product_variant->prod_id,
// 							 			'scpo_prty_id' => $product_variant->prty_id,
// 							 			'scpo_amount' => 1
// 							 	) );
							 	echo " <input type=\"submit\" name=\"In den Warenkorb\" value=\"In den Warenkorb\" class=\"btn btn-success\" />";
							 	echo form_close ();
							 
							 ?>
					
				     		 
						</div>	

<!-- 							<input type="hidden" class="form-control" name="scpo_amount" value="1"> -->
<!-- 							<input type="hidden" class="form-control" name="scpo_prty_id" value=""> -->
<!-- 							<input type="hidden" class="form-control" name="scpo_prod_id" value=""> -->
							

					</div>
				</div>
			</div>


		</div>
		<!--  modal content -->
	</div>
	<!--  modal dialog-->
</div>
<!--  modal -->