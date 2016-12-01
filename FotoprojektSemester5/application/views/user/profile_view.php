<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Profile</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h4>Profile Summary</h4>
			<hr/>
			<p>Name: <?php echo $user_name; ?></p>
			<p>Email: <?php echo $user_email; ?></p>
			<p>...</p>
		</div>
		<div class="col-md-8">
			<p>lorem ipsum dolum</p>
			<p>lorem ipsum dolum</p>
			<p>lorem ipsum dolum</p>
			<p>...</p>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
</body>
</html>