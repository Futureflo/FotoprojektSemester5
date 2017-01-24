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
		
		echo $this->session->flashdata ( 'PriceProfile' );
		?>
</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-7">
			<p class="h1" id="test" onclick="setPager()">
			Preisprofile
			</p>
		</div>
		<div class="col-md-2">
				<?php
				echo '<a
					href="' . base_url () . 'admin/priceprofile_creation/"
					class="btn btn-primary" role="button" href="printers_creation"> <i
					class="fa fa-plus-square fa-lg"></i> Preisprofil</a>';
				?>
			</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="table-responsive">
				<table id="dataTable"
					class="table  table-bordered sortable">
					<thead>
					<tr>
						<th>ID</th>
						<th>Bezeichnung</th>
	
					</tr>
					</thead>
					<tbody>
						<?php
						foreach ( $price_profiles as $price_profile ) {
							echo "<tr class='searchable'>";
							echo "<td>" . $price_profile->prpr_id . "</td>";
							echo "<td>" . $price_profile->prpr_description . "</td>";
							
							echo "<td>";
							
							echo "<center>";
							if ($archive_flag == 0) {
								echo btnedit ( $price_profile );
								
								if ($price_profile->edit_flag == 1)
									echo btndelete ( $price_profile );
							} else {
								echo btnrecycle ( $price_profile );
							}
							echo "</center>";
						}
						echo "</td>";
						
						echo "<tr>";
						function btnedit($price_profile) {
							echo form_open ( "PriceProfile/showSinglePriceProfile/" . $price_profile->prpr_id );
							
							echo "<button class='btn btn-info' name='submit' type='submit' title='Preisprofil: \"" . $price_profile->prpr_description . "\" bearbeiten' aria-label='delete' >";
							
							if ($price_profile->edit_flag == 1) {
								echo "<i class='fa fa-pencil fa-lg' aria-hidden='True' style='color:white;'></i>";
							} else {
								echo "<i class='fa fa-eye fa-lg' aria-hidden='True' style='color:white;'></i>";
							}
							echo "</button>";
							echo form_close ();
						}
						function btndelete($price_profile) {
							echo form_open ( "PriceProfile/deletePriceProfile", '', array (
									'prpr_id' => $price_profile->prpr_id,
									'prpr_description' => $price_profile->prpr_description 
							) );
							
							echo "<button class='btn btn-danger' name='submit' type='submit' title='Preisprofil: \"" . $price_profile->prpr_description . "\" löschen' aria-label='delete' >";
							echo "<i class='fa fa-trash fa-lg' aria-hidden='True' style='color:white;'></i>";
							echo "</button>";
							echo form_close ();
						}
						function btnrecycle($price_profile) {
							echo form_open ( "PriceProfile/recyclePriceProfile", '', array (
									'prpr_id' => $price_profile->prpr_id,
									'prpr_description' => $price_profile->prpr_description 
							) );
							
							echo "<button class='btn btn-success' name='submit' type='submit' title='Preisprofil: \"" . $price_profile->prpr_description . "\" löschen' aria-label='delete' >";
							echo "<i class='fa fa-recycle fa-lg' aria-hidden='True' style='color:white;'></i>";
							echo "</button>";
							echo form_close ();
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
