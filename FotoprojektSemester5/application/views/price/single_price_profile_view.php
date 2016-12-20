
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"> <?php echo'Preisprofil: ' . $price_profile[0]->prpr_description ?></h1>
	</div>
</section>

<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Bezeichnung</th>
					<th>Preis</th>
					<th>Typ</th>
				</tr>
			</thead>
			<tbody>

				<?php
				foreach ($price_profile[0]->prices as $price){
					echo "<tr class='searchable'>";
					echo "<td>" . $price->prty_description. "</td>";
					echo "<td>" . $price->prpt_price. '€' ."</td>";
					if ($price->prty_type == ProductPrintType::download)
					{
						echo "<td>" .'Download' ."</td>";
					}
					else echo "<td>" .'Druck' ."</td>";
				
					
					echo "<tr>";
				}
				?>

				
			</tbody>
		</table>
	</div>
</div>
