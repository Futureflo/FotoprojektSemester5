<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event bearbeiten</title>
</head>
<body>
	<section class="jumbotron text-xs-center">
		<div class="new_event">
			<div class="container">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<h1 class="jumbotron-heading">Event bearbeiten</h1>
					<?php echo form_open ( "Event/edit/" ); ?>
					
					<div class="form-new_event">

							<div class="row">
					<div class="form-group">
						<div class="col-sm-12">
            				<label class="form-control-label">Eventname:</label>
							<input type="input" class="form-control input-sm chat-input" placeholder="Eventname" name="edit_even_name" id="edit_even_name" value="<?php echo($event[0]->even_name); ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-12">
            				<label class="form-control-label">Eventveranstalter (E-Mail Adresse):</label>
							<input type="input" class="form-control input-sm chat-input" placeholder="Eventverantstalter" name="edit_host_email" id="edit_host_email value="<?php echo($event[0]->even_host_email); ?>"">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-12">
            				<label class="form-control-label">Datum:</label>
            				<input type="date" class="form-control input-sm chat-input" placeholder="2017-01-01" name="edit_even_date" id="edit_even_date" value="<?php echo($event[0]->even_date); ?>">
						</div>
					</div>
				</div>
				<div class="row" id="div_edit_even_password" >
					<div class="form-group">
						<div class="col-sm-12">
            				<label class="form-control-label">Passwort:</label>
							<input type="input" class="form-control input-sm chat-input" name="edit_even_password" id="edit_even_password" value="<?php echo($event[0]->even_password); ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-12">
            				<label class="form-control-label">Status:</label>
							<select class="form-control" name="edit_even_status" id="edit_even_status">
							<!--
								1 = gesperrt
								2 = privat (nicht öffentlich)
								3 = öffentlich
								4 = gelöscht 
							-->
								<option value="3">&Ouml;ffentlich</option>
								<option value="2">Privat</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-12">
            				<label class="form-control-label">Preisprofil:</label>
							<select class="form-control" name="edit_even_prpr_id" id="edit_even_prpr_id">
								<option value="-1">kein Preisprofil verfuegbar</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-12">
            				<label class="form-control-label">Druckerei:</label>
							<select class="form-control" name="edit_even_prsu_id" id="edit_even_prsu_id">
								<option value="-1">keine Druckerei verfuegbar</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p align="left" class="h5">Verfügbare Preisprofile</p>
						<div class="table-respnsive">
							<table class="table table-sm table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Bezeichnung</th>
										<th>Endpreis</th>
									</tr>
								</thead>
								<tbody align="left" id="table_prpr">
								</tbody>
							</table>
						</div>
					</div>
				</div>


				<div class="event-btn-wrapper">
					<span class="group-btn">
						<button name="submit" type="submit"
							class="btn btn-success btn-md">Bearbeiten</button>
					</span>
				</div>
					
					<?php echo form_close (); ?>
					<?php echo $this->session->flashdata ( 'msg' ); ?>
				</div>
					</div>

				</div>
			</div>
		</div>

	</section>


	<script type="text/javascript">

	function getProductVariants() {
		var prpr_element = document.getElementById('even_prpr_id');
		var even_prpr_id = prpr_element.options[prpr_element.selectedIndex].value;
		
		var prsu_element = document.getElementById('even_prsu_id');
		var even_prsu_id = prsu_element.options[prsu_element.selectedIndex].value;
		
	    var insertURL = "<?php
					
					echo base_url ()?>/Event/getProductVariantsForPrinterPriceProfileAsJson";
	   
	    // the script where you handle the form input.
	    var request = $.ajax({
	           type: "POST",
	           url: insertURL,
	           data: {priceid: even_prpr_id, printerid: even_prsu_id},
	           success: function(data)
	           {
	              // alert(data); // show response from the php script.

	               var response = jQuery.parseJSON(data);

	               $("#table_prpr tr").remove();
	               
					for(var i  in response){
						createTable(response[i].prty_description, response[i].price.price_sum);
					}	                
	           }
	         });
	    request.fail(function (jqXHR, textStatus) {
		    alert("Das gewählte Produkt kann aktuell nicht aktualisiert werden, wenden Sie sich bitte an den Administrator.")
		});

	}

	function createTable(description, sum){
		var table = document.getElementById('table_prpr');

		var tr = document.createElement('tr');
		var td_desc = document.createElement('td');
		var td_sum = document.createElement('td');
		
		td_desc.innerHTML = description;
		td_sum.innerHTML = sum + ' €';

		tr.appendChild(td_desc);
		tr.appendChild(td_sum);

		table.appendChild(tr);
	}	

	$( document ).ready(function() {
		getProductVariants();
	});
	</script>



</body>
