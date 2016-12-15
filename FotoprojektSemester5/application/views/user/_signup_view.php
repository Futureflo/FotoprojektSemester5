<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Signup Form</title>
	<link rel="stylesheet" href="../css/fps5.css"> 
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../_sonstiges/bootstrap-4.0.0-alpha.5/dist/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
</head>
<body>
<div class="signup-center">
<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<?php $attributes = array("name" => "signupform");
			echo form_open("signup/index", $attributes);?>
			
			<div class="form-login">
                    <h4>FPS5</h4>
                    <div class="row">
                    	<div class="col-xs-6 col-md-6">
                    		<input type="text" class="form-control input-sm chat-input" placeholder="First Name" name="user_firstname" value="<?php echo set_value('user_firstname'); ?>"/>
                    		<span class="text-danger"><?php echo form_error('user_firstname'); ?></span>
                    	</div>
                    	<div class="col-xs-6 col-md-6">
                    		<input type="text" class="form-control input-sm chat-input" placeholder="Last Name" name="user_name" value="<?php echo set_value('user_name'); ?>"/>
                    		<span class="text-danger"><?php echo form_error('user_name'); ?></span>
                    	</div>
                    </div>
                    <br>
                    	<input type="text" class="form-control input-sm chat-input" placeholder="Email-ID" name="user_email" value="<?php echo set_value('user_email'); ?>"/>
                    	<span class="text-danger"><?php echo form_error('user_email'); ?></span>
                    <br>
                   		<input type="password" class="form-control input-sm chat-input" placeholder="Password" name="user_password" value="<?php echo set_value('user_password'); ?>"/>
                    	<span class="text-danger"><?php echo form_error('user_password'); ?></span>
                    <br>
                    	<input type="password" class="form-control input-sm chat-input" placeholder="Confirm Password" name="user_cpassword" value="<?php echo set_value('user_cpassword'); ?>"/>
                    	<span class="text-danger"><?php echo form_error('user_cpassword'); ?></span>
                    <br>
                    <div class="login-btn-wrapper">
                    <span class="group-btn">    
                    	<button name="submit" type="submit" class="btn btn-primary btn-md">Signup</button>
                    </span>
                    </div>
               </div>
			
		<!-- <legend>Signup</legend>
			
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
			</div>  -->	
			<?php echo form_close(); ?>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4 text-center">		
		<p class="new-user-ref">Already Registered? <a href="<?php echo base_url(); ?>index.php/login">Login Here</a></p>
		</div>
	</div>
</div>	
</div>
</div>
<script type="text/javascript" src="<?php echo base_url("js/jquery-1.10.2.js"); ?>"></script>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="../_sonstiges/bootstrap-4.0.0-alpha.5/dist/js/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="../_sonstiges/bootstrap-4.0.0-alpha.5/dist/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

</body>
</html>