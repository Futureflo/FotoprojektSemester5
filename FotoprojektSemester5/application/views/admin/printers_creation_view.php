<section class="jumbotron text-xs-left">
<div class="container">

<div id="fehler_span" class="text-danger"><?php
echo $this->session->flashdata ( 'msgReg' );
?></div>

		<div class="row">
					<?php
					echo form_open_multipart ( 'admin/printers_creation/' );
					?>

				<div class="form-group">
				<fieldset class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="jumbotron-heading">Druckerei Angaben:</h3>
							<br>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input type="text" class="form-control" name="addressname" value="<?php
					
					echo set_value ( 'addressname' );
					?>" placeholder="Druckerei Name"> <span class="text-danger">
							<?php
							
							echo form_error ( 'addressname' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<select class="form-control" name="country">
							<option>Deutschland</option>
						</select> <span class="text-danger">
							<?php
							
							echo form_error ( 'country' );
							?>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-3">
					<input type="text" class="form-control" name="zip" value="<?php
					
					echo set_value ( 'zip' );
					?>" placeholder="PLZ"> <span class="text-danger">
							<?php
							
							echo form_error ( 'zip' );
							?>
							</span>
				</div>
				<div class="col-sm-9 col-xs-9">
					<input type="text" class="form-control" name="city"  value="<?php
					
					echo set_value ( 'city' );
					?>"placeholder="Ort"> <span class="text-danger">
							<?php
							
							echo form_error ( 'city' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-9 col-xs-9">
					<input type="text" class="form-control" name="street" value="<?php
					
					echo set_value ( 'street' );
					?>" placeholder="Straße"> <span class="text-danger">
							<?php
							
							echo form_error ( 'street' );
							?>
							</span>
				</div>
				<div class="col-sm-3 col-xs-3">
					<input type="text" class="form-control" name="housenumber" value="<?php
					
					echo set_value ( 'housenumber' );
					?>" placeholder="Hausnr"> <span class="text-danger">
							<?php
							
							echo form_error ( 'housenumber' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="email" class="form-control" name="email" value="<?php
					
					echo set_value ( 'email' );
					?>" placeholder="E-Mail"> <span class="text-danger">
							<?php
							
							echo form_error ( 'email' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="email" class="form-control" name="cemail" value="<?php
					
					echo set_value ( 'cemail' );
					?>" placeholder="E-Mail wiederholen"> <span class="text-danger">
							<?php
							
							echo form_error ( 'cemail' );
							?>
							</span>
				</div>
			</div>
			<br>
			<div class="row">
					<div class="col-md-4 offset-md-4">
						<button name="submit" type="submit" class="btn btn-primary btn-md btn-block">Speichern</button>
					</div>
			</div>
			<input id="type_hidden_field" type="hidden" name="type_hidden_field" value="">
			<?php
			
			echo form_close ();
			?>
		</div>
	</div>
</section>