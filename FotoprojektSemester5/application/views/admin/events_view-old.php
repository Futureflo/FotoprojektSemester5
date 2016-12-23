
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Admin Events View</h1>
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
					<th>URL</th>
				</tr>
			</thead>
			<tbody>

				<?php
				foreach ( $events as $event ) {
					echo "<tr class='searchable'>";
					echo "<td>" . $event->even_id. "</td>";
					echo "<td>" . $event->even_name. "</td>";
					echo "<td>" . $event->even_url . "</td>";
					
					echo "<tr>";
 				}
				?>

				
			</tbody>
		</table>
	</div>
</div>
