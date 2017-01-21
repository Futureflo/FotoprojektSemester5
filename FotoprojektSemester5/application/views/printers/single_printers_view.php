<style type="text/css">
form {
     display:inline;
}
.button {
    display: block;
    width: 99%;
}
.btn-sm{   
    width: 49%;
}
</style>


<section style="padding-top: 70px">
	<div class="container">
		<?php
		if (isset ( $message )) {
			echo "<div class='alert alert-danger'>";
			echo $message . "</div>";
		}
		?>
</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-7">
			<p class="h1" id="test" onclick="setPager()">
			<?php
			echo 'Druckerei: ' . $printer->adre_name?>
			</p>
		</div>
	</div>
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
						<th></th>
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
					echo '<button class="btn btn-success button">';
					echo '<i class="fa fa-plus-square fa-lg"> Hinzufügen</i>';
					echo '</button>';
					echo "</td>";
					echo form_close ();
					
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
						echo '<i class="fa fa-refresh fa-lg"> Aktualisieren</i>';
						echo '</button>';
						echo form_close ();
						
						// Löschen Button
						// echo "<td>";
						echo form_open ( "PriceProfile/deletePricePrinter", '', array (
								'prty_description' => $price->prty_description,
								'prsu_id' => $printer->prsu_id,
								'prty_id' => $price->prty_id 
						) );
						
						echo '<button class="btn btn-danger btn-sm">';
						echo '<i class="fa fa-trash fa-lg"> Löschen</i>';
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
