<section class="jumbotron text-xs-left">
<div class="container">

<div id="fehler_span" class="text-danger"><?php
echo $this->session->flashdata ( 'msgReg' );
?></div>

		<div class="row">
					<?php
					echo form_open ( 'PriceProfile/newPriceProfile' );
					?>

				<div class="form-group">
				<fieldset class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="jumbotron-heading">Preisprofil Angaben:</h3>
							<br>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input type="text" class="form-control" name="prpr_description" value="<?php
					
					echo set_value ( 'prpr_description' );
					?>" placeholder="Preisprofil Name"> <span class="text-danger">
							<?php
							
							echo form_error ( 'prpr_description' );
							?>
							</span>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
					<a> Kopie aus Preisprofil erstellen:</a>
						<select class="form-control" name="prpr_id">
							<option value = 0> </option>
                    		<?php
																						foreach ( $price_profiles as $price_profile ) {
																							echo '<option value=' . $price_profile->prpr_id . '>' . $price_profile->prpr_description . '</option>';
																						}
																						?>
						</select>
						<span class="text-danger">
							<?php
							
							echo form_error ( 'prpr_id' );
							?>
						</span>
					</div>
				</div>
			</div>
			
			
			<button name="submit" type="submit" class="btn btn-success btn-block btn-md" id="checkout-btn">Anlegen</button>
			<?php
			
			echo form_close ();
			?>
		</div>
	</div>
</section>




<script type="text/javascript">
 	function checkType(){
        var customer = document.getElementById('customer');
        var photograph = document.getElementById('photographer');
        var field = document.getElementById('type_hidden_field');
        
        if(customer.classList.contains('active')){
            field.value = "2";
        } else if(photograph.classList.contains('active')){
            field.value = "3";
        }
	}
    
    window.addEventListener('load', checkType, false);
</script>
