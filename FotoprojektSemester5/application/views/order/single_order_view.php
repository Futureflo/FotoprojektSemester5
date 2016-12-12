
<section class="jumbotron text-xs-center">
	<div class="container">
	<h1 class="jumbotron-heading"><?php echo 'Bestellung: ' . $order[0]->orde_no;?></h1>	
<!-- 		<p class="lead text-muted">Something short and leading about the
			collection below—its contents, the creator, etc. Make it short and
			sweet, but not too short so folks don't simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary">Main call to action</a> <a
				href="#" class="btn btn-secondary">Secondary action</a>
		</p> -->
	</div>
</section>


<div class="table-responsive">
	
	<table class="table table-striped">
			<?php
				echo "<tr>". "<th>ID:</th>". "<th>" . $order[0]->orde_id . "</th></tr>";
				echo "<tr>". "<th>Bezeichung:</th>". "<th>" . $order[0]->orde_no . "</th></tr>";
// 				echo "<tr>". "<th>Datum:</th>". "<th>" . $event[0]->even_date . "</th></tr>";
// 				echo "<tr>". "<th>URL:</th>". "<th>" . $event[0]->even_url . "</th></tr>";
 				echo "<tr>". "<th>Besteller: </th>". "<th>" . $order[0]->user_firstname . " ". $order[0]->user_name . "</th></tr>";
				echo "</tr>";
			?>
	</table>
</div>
	