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
			echo 'Preisprofil: ' . $price_profile->prpr_description?>
			</p>
		</div>
	</div>
	<?php
	echo $this->session->flashdata ( 'PriceProfile' );
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
					if ($price_profile->edit_flag == 1) {
						btn_add ( $price_profile );
					}
					
					foreach ( $price_profile->prices as $price ) {
						echo "<tr class='searchable'>";
						echo "<td>" . $price->prty_description . "</td>";
						
						// Update Button
						if ($price_profile->edit_flag == 1) {
							btn_update ( $price_profile, $price );
						} else {
							echo "<td>" . $price->prpt_price . " €</td>";
						}
						
						// Löschen Button
						if ($price_profile->edit_flag == 1) {
							btn_delete ( $price_profile, $price );
						}
						
						echo "</td>";
						
						echo "<tr>";
					}
					function btn_add($price_profile) {
						echo form_open ( "PriceProfile/addPriceProductType", '', array (
								'prpt_prpr_id' => $price_profile->prpr_id 
						) );
						echo "<td>";
						echo "<select name=\"prpt_prty_id\">";
						foreach ( $price_profile->unused_prty as $prty ) {
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
						echo '<button class="btn btn-success button" style="width:100%">';
						echo '<i class="fa fa-plus-square fa-lg"> Hinzufügen</i>';
						echo '</button>';
						echo "</td>";
						echo form_close ();
					}
					function btn_update($price_profile, $price) {
						echo form_open ( "PriceProfile/updatePriceProductType", '', array (
								'prty_description' => $price->prty_description,
								'prpt_prpr_id' => $price_profile->prpr_id,
								'prty_id' => $price->prty_id 
						) );
						echo "<td>";
						echo "<input id=\"prpt_price\" name=\"prpt_price\" type=\"number\" min=\"0\" step=\"0.01\" value=" . $price->prpt_price . ">€";
						echo "</td>";
						
						echo "<td>";
						echo '<button class="btn btn-info btn-sm" title="Preis aktualisieren">';
						echo '<i class="fa fa-refresh fa-lg"></i>';
						echo '</button>';
						echo form_close ();
					}
					function btn_delete($price_profile, $price) {
						echo form_open ( "PriceProfile/deletePriceProductType", '', array (
								'prty_description' => $price->prty_description,
								'prpt_prpr_id' => $price_profile->prpr_id,
								'prty_id' => $price->prty_id 
						) );
						
						echo '<button class="btn btn-danger btn-sm" title="Format löschen">';
						echo '<i class="fa fa-trash fa-lg"></i>';
						echo '</button>';
						echo form_close ();
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
