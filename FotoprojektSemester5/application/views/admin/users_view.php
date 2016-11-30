
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Admin User View</h1>
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
	<h1>Users</h1>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nachname</th>
					<th>Vorname</th>
					<th>e-Mail</th>
					<th>Passwort</th>
					<th>Rolle</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ( $users as $user ) {
				echo "<tr>";
				echo "<th>" . $user->user_id . "</th>";
				echo "<th>" . $user->user_name . "</th>";
				echo "<th>" . $user->user_firstname . "</th>";
				echo "<th>" . $user->user_email . "</th>";
				echo "<th>" . $user->user_password . "</th>";
				echo "<th>" . $user->usro_name . "</th>";
				echo "<tr>";
			}
			?>

				
			</tbody>
		</table>
	</div>
</div>