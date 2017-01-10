<section class="jumbotron text-xs-center">
	<section class="text-xs-left">
		<div class="container">
			<?php
			echo form_open ( 'Newsletter/unregister' );
			?>
			<div class="">
				<h2>Newsletterabmeldung:</h2>
				<br>
				<input type="text" class="form-control input-sm chat-input" placeholder="E-Mail Adresse*" name="email"/>
				<br />
				<div class="form-group">
			   
			  </div>
				
				<div id="fehler_span" class="text-danger"><?php
				
				echo $this->session->flashdata ( 'newsletterMsg' );
				?></div>
				<span class="group-btn">    
		            	<button name="submit" type="submit" class="btn btn-primary btn-md">Abmelden</button>
		        </span>
			</div>
		</div>

	</section>
</section>