

<style type="text/css">
::selection {
	background-color: #E13300;
	color: white;
}

::-moz-selection {
	background-color: #E13300;
	color: white;
}

.error-template {
	padding: 40px 15px;
	text-align: center;
}

.error-actions {
	margin-top: 15px;
	margin-bottom: 15px;
}

.error-actions .btn {
	margin-right: 10px;
}
</style>

<section style="margin: 5rem 0rem 0rem 0rem;"></section>


<div class="container">
	<div class="row">
		<div class="error-template">
			<h1>Oops!</h1>
			<h2>Zugriffsfehler!</h2>
			<div class="error-details">
				Sie sind nicht berechtigt diese Seite zu betrachten!<br>
			</div>
			<div class="error-actions">
				<a href="<?php
				echo base_url ();
				?>" class="btn btn-primary"> <i class="fa fa-home" aria-hidden="true"></i> Auf die Startseite
				</a> <a href="<?php
				
				echo base_url ();
				?>contact" class="btn btn-secondary"> <i class="fa fa-envelope" aria-hidden="true"></i> Kontaktieren Sie uns
				</a>
			</div>
		</div>
	</div>
</div>
