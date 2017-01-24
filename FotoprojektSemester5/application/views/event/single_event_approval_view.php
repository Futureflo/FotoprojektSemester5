<div style="visibility: hidden;" id="shoppingCartInsertURL"><?php
echo base_url ();
?>Shoppingcart/insert</div>
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"><?php
		echo $event->even_name;
		?></h1>
	</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="table-responsive">
				<table id="dataTable"
					class="table  table-bordered sortable">
					<thead>
						<tr>
							<th>Bild</th>
							<th>Typ</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ( $products_prv as $product ) {
						echo "<td>";
						// Wenn die Bilder gesperrt sind und ein User angemeldet ist, dann sollen diese nicht angezeigt werden
						$user_role = $this->session->userdata ( 'user_role' );
						// if ($product->prod_status == ProductStatus::prv_approved && $user_role == UserRole::User)
						// continue;
						
						$product->prod_complete_filepath = base_url () . $product->prod_filepath;
						
						echo " <img class=\"mypictureborder\" data-src='../../" . $product->prod_filepath . "'" . " alt=" . $product->prod_name . " style=\"width:304px;height:228px; display: block;\"
					src=../../" . $product->prod_filepath . " onclick='openModal(" . json_encode ( $product ) . ")'>";
						echo "</a>";
						
						echo btn_update ( $product );
						echo "</td>";
					}
					// Löschen button
					function btn_update($product) {
						echo form_open ( "Event/approveProducts", '', array (
								'prod_id' => $product->prod_id 
						) );
						echo "<td>";
						echo "<button class='btn btn-info' name='submit' type='submit'>";
						echo "<i class='fa fa-thumbs-up   fa-lg' aria-hidden='True' style='color:white;'></i>";
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

<button type="button" id="buttonModal" data-toggle="modal"
	data-target="#bestellungModal" style="display: none"></button>



<!-- Modal -->
<div id="bestellungModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Bestellung aufgeben</h4>
			</div>

			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<img class="img-responsive" id="modalImg"
								style="max-width: 100%; height: auto;">
						</div>
						<br />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="container">
					<div class="row">
						<?php
						
						echo form_open ( '/', 'id="addToCartForm"', array (
								'even_prsu_id' => $event->even_prsu_id 
						) );
						?>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<div class="col-md-3 col-sm-2 col-xs-2">
								<p>Art:
								
								
								<p />
							</div>
							<div class="col-md-9 col-sm-10 col-xs-10">
								<div class="form-group">
									<select class="form-control" id="beschreibungSelect"
										name="beschreibungSelect">
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<input type="submit" name="In den Warenkorb"
								value="In den Warenkorb" class="btn btn-success" />
						</div>
						<!--<input type="hidden" id="scpo_prod_id" value="">
						<input type="hidden" id="scpo_prty_id" value=""> --!-->
						<input type="hidden" id="scpo_amount" name="scpo_amount" value="1">
						<!-- array ('scpo_prod_id' => $product_variant->prod_id, 'scpo_prty_id' => $product_variant->prty_id, 'scpo_amount' => 1 ) ); !-->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
echo '<script>';
echo 'var userrole;';
echo 'userrole = ' . $this->session->userdata ( 'user_role' );
echo '</script>';

?>