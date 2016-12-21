
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Preisprofile</h1>
	</div>
</section>

<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
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
					echo "<td>" . $price_profile->prpr_id. "</td>";
					echo "<td>" . $price_profile->prpr_description. "</td>";
					
					echo "<td>";
					
					echo "<center>";
					echo btnshow($price_profile);
					echo "</center>";
					echo "</td>";
					
					echo "<tr>";
 				}
 				
 				function btnshow($price_profile){
 					return "<a class='btn btn-info' data-toggle='modal' data-target='#delete' title='Preisprofil \"" . $price_profile->prpr_description . "\" öffnen' aria-label='edit' onclick='whichUser()';><i class='fa fa-pencil fa-lg' aria-hidden='True' style='color:white;'></i></a>";
 				}
				?>

				
			</tbody>
		</table>
	</div>
</div>