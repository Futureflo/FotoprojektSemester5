
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"> <?php
		echo 'Druckerei: ' . $printer->adre_name?></h1>
	</div>
</section>


		
<div class="container">
	<?php
	echo $this->session->flashdata ( 'PrintSupplierPrice' );
	?>
		
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="table-responsive">
				<table id="dataTable"
					class="table  table-bordered sortable">
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
						echo '<button class="btn btn-success btn-sm">';
						echo '<i class="fa fa-plus-square fa-lg"> Hinzufügen</i>';
						echo '</button>';
						echo "</td>";
						echo form_close ();
						?>
						
										<?php
										foreach ( $printer->prices as $price ) {
											echo "<tr class='searchable'>";
											
											echo "<td>" . $price->prty_description . "</td>";
											echo form_open ( "PriceProfile/updatePricePrinter", '', array (
													'prty_description' => $price->prty_description,
													'prsu_id' => $printer->prsu_id,
													'prty_id' => $price->prty_id 
											) );
											
											echo "<td>";
											echo "<input id=\"prsp_price\" name=\"prsp_price\" type=\"number\" min=\"0\" step=\"0.01\" value=" . $price->prsp_price . ">";
											echo "</td>";
											
											// Update Button
											echo "<td>";
											echo '<button class="btn btn-info btn-sm">';
											echo '<i class="fa fa-refresh fa-lg"> aktualisieren</i>';
											echo '</button>';
											echo "</td>";
											echo form_close ();
											
											// Löschen Button
											echo "<td>";
											echo form_open ( "PriceProfile/deletePricePrinter", '', array (
													'prty_description' => $price->prty_description,
													'prsu_id' => $printer->prsu_id,
													'prty_id' => $price->prty_id 
											) );
											
											echo '<button class="btn btn-danger btn-sm">';
											echo '<i class="fa fa-trash fa-lg"> löschen</i>';
											echo '</button>';
											echo form_close ();
											
											echo "</td>";
											
											echo "<tr>";
										}
										
										?>
		
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
