 <section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"> <?php  echo 'Produkt: ' . $product[0]->prod_name ?></h1>	
	</div>
</section>


<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Bezeichnung</th>
				<th>Preis aus Preisprofi</th>
				<th>Preis spez.</th>
			</tr>
		</thead>
		<tbody>


			<?php  
			foreach ($product[0]->product_variants  as $product_variant) {
				echo "<tr class='searchable'>";
					echo "<td>" . $product_variant->prty_description. "</td>";
					echo "<td>" . $product_variant->price[0]->prpt_price. "</td>";
					echo "<td>" . $product_variant->prva_price_specific. "</td>";
				echo "<tr>";
			}
			 ?>
 

				
		</tbody>
	</table>
</div>
	
	
