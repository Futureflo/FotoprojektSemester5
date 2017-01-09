
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"> <?php
		echo 'Druckerei: ' . $printer->adre_name?></h1>
	</div>
</section>

<div class="col-sm-9 col-md-10  main">
<div>


</div>
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
				
				echo form_open ( "PriceProfile/addPricePrinter", '', array (
						'prsu_id' => $printer->prsu_id 
				) );
				echo "<td>";
				echo "<select name=\"prsp_prty_id\">";
				foreach ( $printer->unused_prty as $prty ) {
					echo "<option value=" . $prty->prty_id . ">";
					echo $prty->prty_description;
					echo "</option>";
				}
				echo "</select>";
				echo "</td>";
				
				echo "<td>";
				echo "<input id=\"prsp_price\" name=\"prsp_price\" type=\"number\" min=\"0\" step=\"0.01\" value=\"0.00\">";
				echo "</td>";
				echo "<td>";
				echo " <input type=\"submit\" name=\"Bestellen\" value=\"Hinzufügen\" class=\"btn btn-success\" />";
				echo "</td>";
				?>
				
								<?php
								foreach ( $printer->prices as $price ) {
									echo "<tr class='searchable'>";
									echo "<td>" . $price->prty_description . "</td>";
									echo "<td>" . $price->prsp_price . '€' . "</td>";
									echo "<tr>";
								}
								?>

				
			</tbody>
		</table>
	</div>
</div>
