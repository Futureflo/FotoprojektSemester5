
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"> <?php
		echo 'Produkt: ' . $product->prod_name?></h1>
		
	</div>
	<?php
	echo " <img data-src='../../.." . $product->prod_filepath . "'" . " alt=" . $product->prod_name . " style= display: block;\"
					src=../../.." . $product->prod_filepath . ">";
	?>;
</section>


<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Bezeichnung</th>
				<th>Preis aus Preisprofil</th>
				<th>Preis spez (Aufschlag)</th>
				<th>Preis Druckerei</th>
				<th>Summe</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>


			<?php
			
			foreach ( $product->product_variants as $product_variant ) {
				echo "<tr class='searchable'>";
				echo "<td>" . $product_variant->prty_description . "</td>";
				echo "<td>" . $product_variant->price ['price_basic'];
				echo "<td>" . $product_variant->price ['price_specific'] . "</td>";
				echo "<td>" . $product_variant->price ['price_supplier'] . "</td>";
				echo "<td>" . $product_variant->price ['price_sum'] . "</td>";
				echo "<td>";
				btnorder ( $product_variant );
				echo "</td>";
				
				echo "<tr>";
			}
			function btnorder($product_variant) {
				echo form_open ( "ShoppingCart/insert", '', array (
						'scpo_prod_id' => $product_variant->prva_prod_id,
						'scpo_prty_id' => $product_variant->prva_prty_id,
						'scpo_amount' => 1 
				) );
				echo " <input type=\"submit\" name=\"Bestellen\" value=\"Bestellen\" class=\"btn btn-success\" />";
				echo form_close ();
			}
			?>	
		</tbody>
	</table>
</div>

