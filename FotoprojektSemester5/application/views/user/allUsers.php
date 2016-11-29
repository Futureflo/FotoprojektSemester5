
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">User Example</h1>
		<p class="lead text-muted">Hier werden alle User aus der DB ausgelesen
			und ausgegeben.</p>
	</div>
</section>
<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
	<h1>Users</h1>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>user_id</th>
					<th>user_name</th>
					<th>user_firstname</th>
					<th>user_email</th>
					<th>user_password</th>
					<th>user_role_id</th>
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
				echo "<th>" . $user->user_role_id . "</th>";
				echo "<tr>";
			}
			?>

				
			</tbody>
		</table>
	</div>
</div>

