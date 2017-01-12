
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Alle Formate</h1>
	</div>
</section>


<div class="col-sm-9 col-md-10 main">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Bezeichnung</th>
					<th>Typ</th>
					<th>Breite</th>
					<th>Höhe</th>
					<th>Fotograf</th>
				</tr>
			</thead>
			<tbody>


				<?php
				echo form_open ( "ProductType/addProductType" );
				
				echo "<td>";
				echo "<input id=\"prty_description\" name=\"prty_description\">";
				echo "</td>";
				
				echo "<td>";
				echo "<select name=\"prty_type\">";
				echo "<option value=" . ProductPrintType::print . ">" . "Druck" . "</option>";
				echo "<option value=" . ProductPrintType::download . ">" . "Download" . "</option>";
				echo "<option value=" . ProductPrintType::article . ">" . "Artikel" . "</option>";
				echo "</select>";
				echo "</td>";
				
				echo "<td>";
				echo "<input id=\"prty_width\" name=\"prty_width\" type=\"number\" min=\"0\" step=\"1\" value=\"0.00\">";
				echo "</td>";
				
				echo "<td>";
				echo "<input id=\"prty_height\" name=\"prty_height\" type=\"number\" min=\"0\" step=\"1\" value=\"0.00\">";
				echo "</td>";
				
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
				// Hinzufügen button
				function btn_add() {
					echo "<td>";
					echo " <input type=\"submit\" name=\"Bestellen\" value=\"Hinzufügen\" class=\"btn btn-success\" />";
					echo "</td>";
				}
				?>
				
								<?php
								foreach ( $product_types as $pt ) {
									echo "<tr class='searchable'>";
									echo "<td>" . $pt->prty_description . "</td>";
									
									switch ($pt->prty_type) {
										case ProductPrintType::print :
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
									
									echo "<td>" . $pt->prty_width . "</td>";
									echo "<td>" . $pt->prty_height . "</td>";
									echo "<td>" . $pt->user_name . "</td>";
									
									if ($pt->user_flag == 1)
										btn_delete ( $pt );
									
									echo "<tr>";
								}
								// Löschen button
								function btn_delete($pt) {
									echo form_open ( "ProductType/deleteProductType", '', array (
											'prty_id' => $pt->prty_id,
											'prty_description' => $pt->prty_description 
									) );
									echo "<td>";
									echo " <input type=\"submit\" name=\"Bestellen\" value=\"Löschen\" class=\"btn btn-danger\" />";
									echo "</td>";
									echo form_close ();
								}
								?>
				

				
			</tbody>
		</table>
	</div>
</div>
