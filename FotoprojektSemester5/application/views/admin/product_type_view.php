
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Alle Formate</h1>
	</div>
</section>

<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Bezeichnung</th>
					<th>Typ</th>
					<th>Fotograf</th>
				</tr>
			</thead>
			<tbody>

				<?php
				foreach ( $product_types as $pt ) {
					echo "<tr class='searchable'>";
					echo "<td>" . $pt->prty_id. "</td>";
					echo "<td>" . $pt->prty_description. "</td>";
					if ($pt->prty_type == ProductPrintType::download)
					{
						echo "<td>" .'Download' ."</td>";
					}
					else echo "<td>" .'Druck' ."</td>";
					
					echo "<td>" .$pt->prty_user_id."</td>";
					
					echo "<tr>";
 				}
				?>

				
			</tbody>
		</table>
	</div>
</div>
