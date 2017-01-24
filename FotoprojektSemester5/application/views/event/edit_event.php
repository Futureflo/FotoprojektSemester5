<head>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head><section class="jumbotron">
	<div class="container">
		<h1 class="jumbotron-heading">Event bearbeiten</h1>
		<?php echo form_open("event/edit/".$event->even_id); ?>
		<br>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label col-form-label-lg">Eventname</label>
			<div class="col-sm-10">
				<input type="input" class="form-control form-control-lg" placeholder="Eventname" name="even_name" id="even_name" value="<?php echo($event->even_name); ?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label col-form-label-lg">Email</label>
			<div class="col-sm-10">
				<input type="input" class="form-control form-control-lg" placeholder="Veranstaltermail" name="even_host_email" id="even_host_email" value="<?php echo($event->even_host_email); ?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label col-form-label-lg">Datum</label>
			<div class="col-sm-10">
				<input type="input" class="form-control form-control-lg" placeholder="Datum" name="even_date" id="even_date" value="<?php echo($event->even_date); ?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label col-form-label-lg">Status</label>
			<div class="col-sm-10">
				<select class="form-control form-control-lg" name="even_status" id="even_status" onchange="showhidePasswordfield()">
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

		<div class="form-group row" style="display: none;" id="even_password_div">
			<label class="col-sm-2 col-form-label col-form-label-lg">Passwort</label>
			<div class="col-sm-10">
				<input type="input" class="form-control form-control-lg" placeholder="Passwort" name="even_password" id="even_password" value="<?php echo($event->even_password); ?>">
			</div>
		</div>


		<div class="form-group row">
			<label class="col-sm-2 col-form-label col-form-label-lg">Preisprofil</label>
			<div class="col-sm-10">
				<select class="form-control" name="even_prpr_id" id="even_prpr_id" onchange="getProductVariants()">
                <?php
					foreach ($price_profiles as $price_profile) {
					    echo '<option value=' . $price_profile->prpr_id . '>' . $price_profile->prpr_description . '</option>';
					}
				?>
                </select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label col-form-label-lg">Druckerei</label>
			<div class="col-sm-10">
				<select class="form-control" name="even_prsu_id" id="even_prsu_id" onchange="getProductVariants()">
                <?php
				 	foreach ($printers as $printer) {
				 		echo '<option value=' . $printer->prsu_id . '>' . $printer->prsu_email . '</option>';
				 	}
				?>
                </select>
			</div>
		</div>

		<div class="form-group row">
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

		<div class="form-group row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<button name="submit" type="submit" class="btn btn-danger btn-md" value="back">zur&uuml;ck</button>
				<button name="submit" type="submit" class="btn btn-success btn-md" value="update">Aktuallisieren</button>
			</div>
		</div>


                    
		<?php echo form_close(); echo $this->session->flashdata('msg'); ?>
	</div>
</section>


<script src="http://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(function() {
     $( "#even_date" ).datepicker({ dateFormat: 'yy-mm-dd'}); 
     if ($( "#even_date" )) {}
});
	
	function showhidePasswordfield(){
		if($("#even_status").val() == 2){
			$("#even_password_div").show();
		}
		else{
			$("#even_password_div").hide();
		}
	}
	$("#even_status").val(<?php echo $event->even_status; ?>);
	showhidePasswordfield();


    function getProductVariants() {
        var prpr_element = document.getElementById('even_prpr_id');
        var even_prpr_id = prpr_element.options[prpr_element.selectedIndex].value;
        
        var prsu_element = document.getElementById('even_prsu_id');
        var even_prsu_id = prsu_element.options[prsu_element.selectedIndex].value;
        
        var insertURL = "<?php echo base_url();?>/Event/getProductVariantsForPrinterPriceProfileAsJson";
      
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