<section class="jumbotron text-xs-center">
	<section class="text-xs-left">
		<div class="container">
			<?php echo form_open('Contact/');?>
			<div class="">
				<h2>Kontaktiere uns:</h2>
				<br> 
				<input type="text" class="form-control input-sm chat-input" placeholder="Vor- und Nachname*" name="name" value="<?php echo set_value ( 'name' );?>"/>
				<br />
				<input type="text" class="form-control input-sm chat-input" placeholder="E-Mail Adresse*" name="email" value="<?php echo set_value ( 'email' );?>"/>
				<br />
				<input type="text" class="form-control input-sm chat-input" placeholder="Telefonnummer" name="telNum" value="<?php echo set_value ( 'telNum' );?>"/>
				<br />
				<div class="form-group">
			    <select class="form-control" id="subject" name="subject">
			      <option style="color: grey">Betreff wählen*</option>
			      <option>Rechnung</option>
			      <option>Bestellung</option>
			      <option>Account</option>
			      <option>Sonstiges</option>
			    </select>
			  </div>
				<div class="form-group">

  <textarea class="form-control" rows="5" placeholder="Nachricht eingeben*" id="message" name="message" value="<?php echo set_value ( 'telNum' );?>"></textarea>
				</div>
				<div id="fehler_span" class="text-danger"><?php  echo $this->session->flashdata('contactMsg'); ?></div>
				<span class="group-btn">    
		            	<button name="submit" type="submit" class="btn btn-primary btn-md">Absenden</button>
		        </span>
			</div>
		</div>

	</section>
</section>