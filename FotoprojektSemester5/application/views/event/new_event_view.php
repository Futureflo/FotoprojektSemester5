
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Neues Event erstellen</title>
	<link rel="stylesheet" href="../css/fps5.css"> 
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../_sonstiges/bootstrap-4.0.0-alpha.5/dist/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
</head>
<body>
	<section class="jumbotron text-xs-center">
		<div class="container">
			<h1 class="jumbotron-heading">Neues Event erstellen</h1>
			<p class="lead text-muted">Something short and leading about the
				collection below—its contents, the creator, etc. Make it short and
				sweet, but not too short so folks don't simply skip over it entirely.</p>
			<p>
				<a href="#" class="btn btn-primary">Main call to action</a> <a
					href="#" class="btn btn-secondary">Secondary action</a>
			</p>
		</div>
	</section>
	<div class="new_event">
		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1">
		
					<?php $attributes = array("name" => "newevent");
					echo form_open("Event/new", $attributes);?>
					
					<div class="form-new_event">
							<br>
		                    	<!-- <input type="text" class="form-control input-sm chat-input" placeholder="Event Name" name="even_name" value="<?php echo set_value('even_name'); ?>"/>  -->
		                    	<input type="text" class="form-control input-sm chat-input" placeholder="Event Name" name="even_name" value="TEST"/>
		                    	<span class="text-danger"><?php echo form_error('even_name'); ?></span>
							<br>
		                    	<!--  <input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="<?php echo set_value('even_date'); ?>"/>  -->
		                    	<input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="2016-12-08"/>
		                    	
		                    	
		                    	<span class="text-danger"><?php echo form_error('even_date'); ?></span>
							<br>
		                    	<input type="checkbox" class="form-control input-sm chat-input" placeholder="Öffentliches Event" name="even_status" value="<?php echo set_value('even_status'); ?>"/> Öffentliches event
		                    	<span class="text-danger"><?php echo form_error('even_status'); ?></span>
				
		                    <div class="event-btn-wrapper">
		                    <span class="group-btn">    
		                    	<button name="submit" type="submit" class="btn btn-success btn-md">Anlegen</button>
		                    </span>
		                    </div>
		               </div>
					
					<?php echo form_close(); ?>
					<?php echo $this->session->flashdata('msg'); ?>
				</div>
			</div>
		
		</div>
	</div>
</body>

