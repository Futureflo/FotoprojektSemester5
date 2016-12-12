
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Single Picture View</h1>
		<p class="lead text-muted">Something short and leading about the
			collection below—its contents, the creator, etc. Make it short and
			sweet, but not too short so folks don't simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary">Main call to action</a> <a
				href="#" class="btn btn-secondary">Secondary action</a>
		</p>
	</div>
</section>

<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
	<h1>Product Types</h1>
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
