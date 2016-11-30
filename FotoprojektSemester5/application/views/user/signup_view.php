<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Signup Form</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<?php $attributes = array("name" => "signupform");
			echo form_open("signup/index", $attributes);?>
			<legend>Signup</legend>
			
			<div class="form-group">
				<label for="name">First Name</label>
				<input class="form-control" name="user_firstname" placeholder="Your First Name" type="text" value="<?php echo set_value('user_firstname'); ?>" />
				<span class="text-danger"><?php echo form_error('user_firstname'); ?></span>
			</div>			
		
			<div class="form-group">
				<label for="name">Last Name</label>
				<input class="form-control" name="user_name" placeholder="Last Name" type="text" value="<?php echo set_value('user_name'); ?>" />
				<span class="text-danger"><?php echo form_error('user_name'); ?></span>
			</div>
		
			<div class="form-group">
				<label for="email">Email ID</label>
				<input class="form-control" name="user_email" placeholder="Email-ID" type="text" value="<?php echo set_value('user_email'); ?>" />
				<span class="text-danger"><?php echo form_error('user_email'); ?></span>
			</div>

			<div class="form-group">
				<label for="subject">Password</label>
				<input class="form-control" name="user_password" placeholder="Password" type="password" />
				<span class="text-danger"><?php echo form_error('user_password'); ?></span>
			</div>

			<div class="form-group">
				<label for="subject">Confirm Password</label>
				<input class="form-control" name="user_cpassword" placeholder="Confirm Password" type="password" />
				<span class="text-danger"><?php echo form_error('user_cpassword'); ?></span>
			</div>

			<div class="form-group">
				<button name="submit" type="submit" class="btn btn-info">Signup</button>
				<button name="cancel" type="reset" class="btn btn-info">Cancel</button>
			</div>
			<?php echo form_close(); ?>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="<?php echo base_url(); ?>index.php/login">Login Here</a>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url("js/jquery-1.10.2.js"); ?>"></script>
</body>
</html>