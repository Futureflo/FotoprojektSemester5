 <section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"> <?php
		echo 'Produkt: ' . $product->prod_name?></h1>	
	</div>
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
				
				echo "<tr>";
			}
			?>
 

				
		</tbody>
	</table>
</div>
	
	
