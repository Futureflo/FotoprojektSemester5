<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Neues Event erstellen</title>
<link rel="stylesheet" href="../css/fps5.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet"
	href="../_sonstiges/bootstrap-4.0.0-alpha.5/dist/css/bootstrap.min.css"
	integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi"
	crossorigin="anonymous">
</head>
<body>
	<section class="jumbotron text-xs-center">

			
		
	<div class="new_event">

		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1">
			<h1 class="jumbotron-heading">Neues Event erstellen</h1>
					<?php
					$attributes = array (
							"name" => "newevent" 
					);
					echo form_open ( "Event/newEvent", $attributes );
					?>
					
					<div class="form-new_event">

						<div>
							<br>
							<!-- <input type="text" class="form-control input-sm chat-input" placeholder="Event Name" name="even_name" value="<?php
							
							echo set_value ( 'even_name' );
							?>"/>  -->
							<input type="text" class="form-control input-sm chat-input" name="even_name" placeholder="Event Name" /> <span
								class="text-danger"><?php
								
								echo form_error ( 'even_name' );
								?></span> <br>
							<!--  <input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="<?php
							
							echo set_value ( 'even_date' );
							?>"/>  -->
							
							<div class="row">
							<div class="col-sm-12">
							<div class="form-group">
							<input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="<?php echo(date("Y-m-d")); ?>" /> 
							<span class="text-danger"><?php
								
								echo form_error ( 'even_date' );
								?></span></span>
							</div>
							</div>
							</div>
								
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<select class="form-control" name="even_status">
												<option value="">&Ouml;ffentlich</option>
												<option value="">Privat</option>
											</select> <span class="text-danger">
												<?php
												
												echo form_error ( 'even_status' );
												?>
												</span>
										</div>
									</div>
								</div>
								
								
								
						<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<select class="form-control" name="even_prpr_id">
							
		                    															<?php
																						foreach ( $price_profiles as $price_profile ) {
																							echo '<option value=' . $price_profile->prpr_id . '>' . $price_profile->prpr_description . '</option>';
																						}
																						?>
																						</select>
																						<span class="text-danger">
												<?php
												
												echo form_error ( 'even_prpr_id' );
												?>
												</span>
										</div>
									</div>
								</div>
							      
							
							
							<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<select class="form-control" name="even_prsu_id">
							
		                   														 <?php
																						
																						foreach ( $printers as $printer ) {
																							echo '<option value=' . $printer->prsu_id . '>' . $printer->prsu_email . '</option>';
																						}
																						
																						?>
																							</select>
																						<span class="text-danger">
												<?php
												
												echo form_error ( 'even_prpr_id' );
												?>
												</span>
										</div>
									</div>
								</div>
							     

		                    <div class="event-btn-wrapper">
								<span class="group-btn">
									<button name="submit" type="submit"
										class="btn btn-success btn-md">Anlegen</button>
								</span>
							</div>
						</div>
					
					<?php
					
					echo form_close ();
					?>
					<?php
					
					echo $this->session->flashdata ( 'msg' );
					?>
				</div>
				</div>

			</div>
		</div>

	</section>
</body>
