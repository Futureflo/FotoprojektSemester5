<section class="jumbotron text-xs-center">
	<section class="text-xs-left">
		<div class="container">
			<?php
			echo form_open ( 'newsletter/addUnregistered' );
			?>
			<div class="">
				<h2>Newsletteranmeldung:</h2>
				<br />
				<input type="text" class="form-control input-sm chat-input" placeholder="Email-ID" name="email" value="<?php
				
				echo set_value ( 'email' );
				?>"/>
						<?php
						if (validation_errors ( 'email' ) != null) {
							echo "<div class='alert alert-danger' style='margin-top: 1rem'>" . validation_errors () . "</div>";
						}
						?>
				<br />
				<div class="form-group">
			   
			  </div>
				
				<div id="fehler_span" class="text-danger"><?php
				
				echo $this->session->flashdata ( 'newsletterMsg' );
				?></div>
				<span class="group-btn">    
		            	<button name="submit" type="submit" class="btn btn-primary btn-md">Anmelden</button>
		        </span>
			</div>
		</div>

	</section>
</section>