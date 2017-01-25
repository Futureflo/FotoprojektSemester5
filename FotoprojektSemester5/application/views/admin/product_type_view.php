
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
			echo $ProductViewHeader;
			?>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="table-responsive">
			<table id="dataTable"
				class="table  table-bordered sortable">
				<thead>
					<tr>
						<th>Bezeichnung</th>
						<th>Typ</th>
		<!-- 					<th>Breite</th> -->
		<!-- 					<th>Höhe</th> -->
						<th>Fotograf</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (! $archive_flag) {
						echo form_open ( "ProductType/addProductType" );
						
						echo "<td>";
						echo "<input id=\"prty_description\" name=\"prty_description\">";
						echo "</td>";
						
						echo "<td>";
						echo "<select name=\"prty_type\">";
						echo "<option value=" . ProductPrintType::prints . ">" . "Druck" . "</option>";
						echo "<option value=" . ProductPrintType::download . ">" . "Download" . "</option>";
						echo "<option value=" . ProductPrintType::article . ">" . "Artikel" . "</option>";
						echo "</select>";
						echo "</td>";
						
						// echo "<td>";
						// echo "<input id=\"prty_width\" name=\"prty_width\" type=\"number\" min=\"0\" step=\"1\" value=\"0.00\">";
						// echo "</td>";
						
						// echo "<td>";
						// echo "<input id=\"prty_height\" name=\"prty_height\" type=\"number\" min=\"0\" step=\"1\" value=\"0.00\">";
						// echo "</td>";
						
						echo "<td>";
						echo "<select name=\"prty_user_id\">";
						foreach ( $users as $user ) {
							echo "<option value=" . $user->user_id . ">";
							echo $user->user_firstname . " " . $user->user_name;
							echo "</option>";
						}
						echo "</select>";
						echo "</td>";
						btn_add ();
						echo form_close ();
					}
					
					foreach ( $product_types as $pt ) {
						echo "<tr class='searchable'>";
						echo "<td>" . $pt->prty_description . "</td>";
						
						switch ($pt->prty_type) {
							case ProductPrintType::prints :
								{
									echo "<td>" . 'Druck' . "</td>";
									break;
								}
							case ProductPrintType::download :
								{
									echo "<td>" . 'Download' . "</td>";
									break;
								}
							case ProductPrintType::article :
								{
									echo "<td>" . 'Artikel' . "</td>";
									break;
								}
							default :
								{
									echo "<td>" . 'Undefiniert' . "</td>";
									break;
								}
						}
						
						// echo "<td>" . $pt->prty_width . "</td>";
						// echo "<td>" . $pt->prty_height . "</td>";
						echo "<td>" . $pt->user_firstname . ' ' . $pt->user_name . "</td>";
						
						if ($archive_flag) {
							btn_recycle ( $pt );
						} else {
							if ($pt->edit_flag == 1)
								btn_delete ( $pt );
						}
						
						echo "<tr>";
					}
					
					// Hinzufügen button
					function btn_add() {
						echo "<td>";
						echo " <button type=\"submit\" name=\"Bestellen\" value=\"Hinzufügen\" role=\"button\" class=\"btn btn-primary\"> <i class=\"fa fa-plus-square fa-lg\"></i> Hinzufügen</button>";
						echo "</td>";
					}
					
					// Löschen button
					function btn_delete($pt) {
						echo form_open ( "ProductType/deleteProductType", '', array (
								'prty_id' => $pt->prty_id,
								'prty_description' => $pt->prty_description 
						) );
						echo "<td>";
						echo "<button class='btn btn-danger' name='submit' type='submit' title='Format: \"" . $pt->prty_description . "\" löschen' aria-label='delete' >";
						echo "<i class='fa fa-trash fa-lg' aria-hidden='True' style='color:white;'></i>";
						echo "</button>";
						echo "</td>";
						echo form_close ();
					}
					// Recycle button
					function btn_recycle($pt) {
						echo form_open ( "ProductType/recycleProductType", '', array (
								'prty_id' => $pt->prty_id,
								'prty_description' => $pt->prty_description 
						) );
						echo "<td>";
						echo "<button class='btn btn-success' name='submit' type='submit' title='Format: \"" . $pt->prty_description . "\" wiederherstellen' aria-label='delete' >";
						echo "<i class='fa fa-recycle fa-lg' aria-hidden='True' style='color:white;'></i>";
						echo "</button>";
						echo "</td>";
						echo form_close ();
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
