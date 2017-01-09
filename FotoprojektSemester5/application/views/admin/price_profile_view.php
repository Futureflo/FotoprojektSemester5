
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Preisprofile</h1>
	</div>
</section>

<div class="col-sm-9 col-md-10  main">
	<div class="table-responsive">
		<table class="table table-striped">
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
					echo btnedit ( $price_profile );
					echo "</center>";
					echo "</td>";
					
					echo "<tr>";
				}
				function btnedit($price_profile) {
					echo form_open ( "PriceProfile/showSinglePriceProfile/" . $price_profile->prpr_id );
					echo "<button class='btn btn-info' name='submit' type='submit' title='Preisprofil: \"" . $price_profile->prpr_description . "\" bearbeiten' aria-label='delete' >
							<i class='fa fa-pencil fa-lg' aria-hidden='True' style='color:white;'></i>
							</button>";
					echo form_close ();
				}
				?>
				

				
			</tbody>
		</table>
	</div>
</div>