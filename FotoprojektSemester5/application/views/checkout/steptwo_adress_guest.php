
<?php
echo form_open('Checkout');
?>
<section class="jumbotron text-xs-center" style="padding-bottom: 1rem">
	<div class="container">
		<h1 class="jumbotron-heading">Ihre Bestellung</h1>
	</div>
</section>
<hr>


<div class="container">
	<?php echo validation_errors(); ?>
</div>

<div class="container">
	<div class="checkout_border">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="checkout_overviewelements_connector"></div>
				<div class="checkout_overviewelement_left">
					<div
						class="checkout_overviewelement rounded-circle checkout_overviewelement_active"></div>
					<div class="checkout_overviewelement_text">Adresse</div>
				</div>
				<div class="checkout_overviewelement_middle">
					<div class="checkout_overviewelement rounded-circle"></div>
					<div class="checkout_overviewelement_text">Zahlungsart</div>
				</div>
				<div class="checkout_overviewelement_right">
					<div class="checkout_overviewelement rounded-circle"></div>
					<div class="checkout_overviewelement_text">Best&auml;tigen</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2 style="text-decoration: underline;">Rechnungsadresse</h2>
				<div class="form-group col-md-6 col-sm-12">
					<label for="gender">Anrede</label> <select class="form-control" id="inv_gender">
						<option>Herr</option>
						<option>Frau</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="vorname">Vorname</label> <input type="text"
						class="form-control" id="inv_vorname" name="inv_vorname" value="<?php echo set_value('inv_vorname'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="nachname">Nachname</label> <input type="text"
						class="form-control" id="inv_nachname" name="inv_nachname" value="<?php echo set_value('inv_nachname'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="street">Straße und Hausnummer</label> <input type="text"
						class="form-control" id="inv_street" name="inv_street" value="<?php echo set_value('inv_street'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="plz">PLZ</label> <input class="form-control"
						type="text" id="inv_plz" name="inv_plz" value="<?php echo set_value('inv_plz'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="city">Stadt</label> <input type="text"
						class="form-control" id="inv_city" name="inv_city" value="<?php echo set_value('inv_city'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="country">Land</label> <select class="form-control"
						id="inv_country" name="inv_country" >
						<?php echo $countryoptions; ?>
					</select>
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="birthday">Geburtsdatum</label> <input
						class="form-control" type="date" id="birthday" name="birthday" value="<?php echo set_value('birthday'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="mail">E-Mail Adresse</label> <input type="text"
						class="form-control" id="mail" name="mail" value="<?php echo set_value('mail'); ?>">
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<button type="button" class="btn btn-secondary"
						id="payment_adress_btn" name="payment_adress_btn">Abweichende Liferadresse</button>
				</div>
			</div>

			<div class="col-md-12 col-sm-12" style="display: none;"
				id="payment_adress">
				<h2 style="text-decoration: underline;">Lieferadresse</h2>
				<div class="form-group col-md-6 col-sm-12">
					<label for="gender">Anrede</label> <select class="form-control"
						id="del_gender" name="del_gender">
						<option>Herr</option>
						<option>Frau</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="vorname">Vorname</label> <input type="text"
						class="form-control" id="del_vorname" name="del_vorname" value="<?php echo set_value('del_vorname'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="nachname">Nachname</label> <input type="text"
						class="form-control" id="del_nachname" name="del_nachname" value="<?php echo set_value('del_nachname'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="street">Straße und Hausnummer</label> <input type="text"
						class="form-control" id="del_street" name="del_street" value="<?php echo set_value('del_street'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="plz">PLZ</label> <input class="form-control"
						type="text" id="del_plz" name="del_plz" value="<?php echo set_value('del_plz'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="city">Stadt</label> <input type="text"
						class="form-control" id="del_city" name="del_city" value="<?php echo set_value('del_city'); ?>">
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="country">Land</label> <select class="form-control"
						id="del_country" name="del_country">
						<?php echo $countryoptions; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<!--<label class="form-check-label"> <input class="form-check-input"
					type="checkbox"> Als Kunde anlegen.
				</label> <br> --><label class="form-check-label" > <input class="form-check-input" type="checkbox" onchange="agbClicked(this)"> Ich stimme den <a href="<?php echo base_url ()?>privacypolicy" style="text-decoration: underline;">Datenschutzrichtlinien</a> sowie den <a href="<?php echo base_url ()?>termsandconditions" style="text-decoration: underline;">AGBs</a> zu. </label>
			</div>

			<div class="col-md-4 offset-md-8 col-sm-4 offset-sm-4 col-xs-4 offset-xs-4">
				<button type="submit" class="btn btn-primary" disabled="FALSE" id="subm" >Weiter zu Zahlungsart</button>
      	 		<input type="hidden" name="hiddenDifferentDeliveryAdress" id="hiddenDifferentDeliveryAdress" value="<?php echo set_value('hiddenDifferentDeliveryAdress'); ?>">
				<?php echo form_close (); ?>
			</div>
		</div>
	</div>
</div>

<script>
var differentDeliveryAdress; 

$(document).ready(function(){ 

	//First Call, hidden field is empty
	if($("#hiddenDifferentDeliveryAdress").val() == "")
	{	
		//set hidden field and js var to false
		differentDeliveryAdress = false;
		$("#hiddenDifferentDeliveryAdress").val(differentDeliveryAdress);
	}
	else{
		//set js var to value of hidden field
		differentDeliveryAdress = $("#hiddenDifferentDeliveryAdress").val();
		if($("#hiddenDifferentDeliveryAdress").val()=="true")
			//expand del. if on true
			$("#payment_adress").fadeToggle("slow");
	}

	$("#payment_adress_btn").click(function() { 
		$("#payment_adress").fadeToggle("slow");

		//change value of js var and hidden field when user clicks on toggle button
		if(differentDeliveryAdress){
			differentDeliveryAdress = false;
			$("#hiddenDifferentDeliveryAdress").val(differentDeliveryAdress);
		}
		else{
			differentDeliveryAdress = true;
			$("#hiddenDifferentDeliveryAdress").val(differentDeliveryAdress);
		}
	});

	  
	});


//enable/disable submit button if toc checkbox is checked/unchecked
function agbClicked(chkBox)
 {
 	if(chkBox.checked)
    	$("#subm").prop("disabled",false);
    else
    	$("#subm").prop("disabled",true);
 }

</script>