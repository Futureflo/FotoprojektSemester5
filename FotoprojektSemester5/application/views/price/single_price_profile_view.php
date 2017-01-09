
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"> <?php
		echo 'Preisprofil: ' . $price_profile->prpr_description?></h1>
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
				
				echo form_open ( "PriceProfile/addPriceProductType", '', array (
						'prpt_prpr_id' => $price_profile->prpr_id 
				) );
				echo "<td>";
				echo "<select name=\"prpt_prty_id\">";
				foreach ( $unused_prty as $prty ) {
					echo "<option value=" . $prty->prty_id . ">";
					echo $prty->prty_description;
					echo "</option>";
				}
				echo "</select>";
				echo "</td>";
				
				echo "<td>";
				echo "<input id=\"prpt_price\" name=\"prpt_price\" type=\"number\" min=\"0\" step=\"0.01\" value=\"0.00\">";
				echo "</td>";
				echo "<td>";
				echo " <input type=\"submit\" name=\"Bestellen\" value=\"Hinzufügen\" class=\"btn btn-success\" />";
				echo "</td>";
				?>
				
								<?php
								foreach ( $price_profile->prices as $price ) {
									echo "<tr class='searchable'>";
									echo "<td>" . $price->prty_description . "</td>";
									echo "<td>" . $price->prpt_price . '€' . "</td>";
									if ($price->prty_type == ProductPrintType::download) {
										echo "<td>" . 'Download' . "</td>";
									} else
										echo "<td>" . 'Druck' . "</td>";
									
									echo "<tr>";
								}
								?>

				
			</tbody>
		</table>
	</div>
</div>
