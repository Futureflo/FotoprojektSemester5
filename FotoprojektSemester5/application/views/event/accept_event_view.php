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
<input type="text" class="form-control input-sm chat-input"
												placeholder="Passwort" name="password" />
												<input type="submit" name="open"
								value="Event öffnen" class="btn btn-success" />
<?php

form_close ()?>
					</div>
					</div>
					</div>