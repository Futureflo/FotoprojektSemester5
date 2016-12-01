<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Login Form | KodingMadeSimple.com</title>
	<link rel="stylesheet" href="../css/fps5.css">  
	 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../_sonstiges/bootstrap-4.0.0-alpha.5/dist/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
</head>
<body>

<div class="login-center">
<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4">
		<?php $attributes = array("name" => "loginform");
			echo form_open("login/", $attributes);?>
			
			<div class="form-login">
                    <h4>FPS5</h4>
                    <input type="text" class="form-control input-sm chat-input" placeholder="Enter Email-ID" name="user_email" value="<?php echo set_value('user_email'); ?>"/>
                    <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                    </br>
                    <input type="password" class="form-control input-sm chat-input" placeholder="password" name="user_password" value="<?php echo set_value('user_password'); ?>"/>
                    <span class="text-danger"><?php echo form_error('user_password'); ?></span>
                    </br>
                    <div class="login-btn-wrapper">
                    <span class="group-btn">    
                    	<button name="submit" type="submit" class="btn btn-primary btn-md">login</button>
                    </span>
                    </div>
               </div>

		<?php echo form_close(); ?>
		<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4 text-center">			
				<p class="new-user-ref">New User? <a href="<?php echo base_url(); ?>index.php/signup">Sign Up Here</a></p>
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
