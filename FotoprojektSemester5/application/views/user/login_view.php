<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Login Form | KodingMadeSimple.com</title>
</head>
<body>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
		<?php $attributes = array("name" => "loginform");
			echo form_open("login/index", $attributes);?>
			<legend>Login</legend>
			<div class="form-group">
				<label for="name">Email-ID</label>
				<input class="form-control" name="user_email" placeholder="Enter Email-ID" type="text" value="<?php echo set_value('user_email'); ?>" />
				<span class="text-danger"><?php echo form_error('user_email'); ?></span>
			</div>
			<div class="form-group">
				<label for="name">Password</label>
				<input class="form-control" name="user_password" placeholder="Password" type="password" value="<?php echo set_value('user_password'); ?>" />
				<span class="text-danger"><?php echo form_error('user_password'); ?></span>
			</div>
			<div class="form-group">
				<button name="submit" type="submit" class="btn btn-info">Login</button>
				<button name="cancel" type="reset" class="btn btn-info">Cancel</button>
			</div>
		<?php echo form_close(); ?>
		<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		New User? <a href="<?php echo base_url(); ?>index.php/signup">Sign Up Here</a>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url("js/jquery-1.10.2.js"); ?>"></script>
</body>
</html>
