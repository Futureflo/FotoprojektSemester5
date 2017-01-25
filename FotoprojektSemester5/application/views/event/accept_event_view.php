<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"><?php
		echo $event->even_name . " passwortgeschützt!"?></h1>
		<?php
		
		echo $this->session->flashdata ( 'wrong_code' );
		?>
	</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-10 offset-md-1">
						
<?php
$attributes = array (
		"name" => "newevent" 
);
echo form_open ( "Event/checkCode", '', array (
		'even_id' => $event->even_id,
		'even_url' => $event->even_url 
) );
?>

<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2">
						<input type="password" class="form-control input-sm chat-input" placeholder="Passwort" name="password" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-2 offset-sm-5 col-md-4 offset-md-4">
						<input type="submit" name="open" value="Event öffnen" class="btn btn-primary btn-block" />
					</div>
				</div>
			</div>

			
<?php

form_close ()?>
					</div>
	</div>
</div>