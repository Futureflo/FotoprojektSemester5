<head>
	  <link rel="stylesheet" href="<?php echo base_url(); ?>/css/font-awesome.min.css">
</head>
<section class="jumbotron text-xs-center"><h1 class="jumbotron-heading">Eventbilder bearbeiten</h1><?php //echo $debugmsg; ?></section>
<div class="container">
	<div class="row col-sm-12">
		<?php foreach ($events as $event) : ?>
		<table class="table table-inverse" style="margin-bottom: 2px;">
		  <thead onclick="showhideDetails(<?php echo $event->even_id; ?>)" id="thead_<?php echo $event->even_id; ?>" style="cursor:pointer;">
		    <tr>
		      <th style="width: 33%;"><?php echo $event->even_name; ?></th>
		      <th style="width: 33%;"><span id="span_priv_<?php echo $event->even_id; ?>"" ><?php echo $event->amount_private; ?></span> von <?php echo count($event->all_products); ?> Bilder gesperrt</th>
		      <th style="width: 33%; text-align: right;"><i class="fa fa-angle-down" aria-hidden="true" style="font-size: 2em;" id="thead_symbol_<?php echo $event->even_id; ?>"></i></th>
		    </tr>
		  </thead>
		  <tbody style=" width: 100%;">
		    <tr>
		    	<table class="table table-sm" style="display: none;" id="tableDetailed_<?php echo $event->even_id; ?>"  class="detailsTable">
		    		<thead>
						<tr>
							<th>Bild</th>
							<th>Name</th>
							<th>Freigeben/Sperren</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($event->all_products as $Product) : ?>
						<tr>
							<td><img src="<?php echo  base_url() . $Product->FullFilePath; ?>" alt="..." class="img-responsive" /></td>

							<td><?php echo $Product->prod_name; ?></td>

							<td><div class="checkbox checkbox-slider--b-flat checkbox-slider-md"">
									<label><input type="checkbox" id="checkbox<?php echo $Product->prod_id; ?>" <?php if($Product->prod_status == 1) echo "checked"; ?> onChange="changeProductStatus(<?php echo $Product->prod_id; ?>, <?php echo $event->even_id; ?>)"><span></span></label>
									<?php
										if($event->even_user_id == $this->session->userdata ( 'user_id' ))
										{
											echo '<button type="button" class="btn btn-danger fa fa-trash-o fa-lg" data-toggle="modal" data-target="#deleteProduct'.$Product->prod_id.'" title="Löschen"></button>';
										}
									?>
								</div></td>



						<div class="modal fade" id="deleteProduct<?php echo ($Product->prod_id); ?>" tabindex="-1" role="dialog"
								aria-labelledby="edit" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
												<h4 class="modal-title custom_align" id="Heading">Produkt löschen?</h4>
											</div>
											
											<div class="modal-body">   
												<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
													</span>Möchten Sie <?php echo $Product->prod_name; ?> unwideruflich löschen?
												</div>
											</div>
											
											<div class="modal-footer ">
												
													<button type="submit" class="btn btn-danger"  onclick="deleteProduct(<?php echo $Product->prod_id; ?>)"><span class="glyphicon glyphicon-ok-sign"></span>Produkt löschen</button>
													<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
												</form>
											</div>
										</div>
											<!-- /.modal-content --> 
										</div>
										  <!-- /.modal-dialog --> 
								</div>


						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

		    </tr>
		  </tbody>
		</table>
		<?php endforeach; ?>
	</div>
</div>


<script>

function changeProductStatus($id, $eventid){
    var lock = "<?php echo site_url (); ?>product/lockProductByID/"+$id;
    var unlock = "<?php echo site_url (); ?>product/unlockProductByID/"+$id;


	if ($('#checkbox'+$id).is(':checked')) {
		var amount_private = parseInt($('#span_priv_'+$eventid).html());
		amount_private = amount_private - 1;
		$('#span_priv_'+$eventid).html(amount_private);

		var request = $.ajax({
			type: "POST",
			url: lock,
			data: null, // serializes the form's elements.
			success: function(data)
			{
				//alert(data); // show response from the php script.
				//location.reload();
			}});
	}
	else{
		var amount_private = parseInt($('#span_priv_'+$eventid).html());
		amount_private = amount_private + 1;
		$('#span_priv_'+$eventid).html(amount_private);

	 var request = $.ajax({
           type: "POST",
           url: unlock,
           data: null, // serializes the form's elements.
           success: function(data)
           {
               //alert(data); // show response from the php script.
				//location.reload();
           }
         });

	}
}

function deleteProduct($id){
    var deletURL = "<?php echo site_url (); ?>product/deleteProductByID/"+$id;

	 var request = $.ajax({
           type: "POST",
           url: deletURL,
           data: null, // serializes the form's elements.
           success: function(data)
           {
               //alert(data); // show response from the php script.
				location.reload();
           }
         });

}

function showhideDetails($id){
	$("#tableDetailed_"+$id).toggle();
	var classListSymbol = $("#thead_symbol_"+$id).attr('class').split(/\s+/);
	if(classListSymbol[1] == "fa-angle-down"){
		$("#thead_symbol_"+$id).removeClass("fa-angle-down");
		$("#thead_symbol_"+$id).addClass("fa-angle-up");
	}
	else{
		$("#thead_symbol_"+$id).addClass("fa-angle-down");
		$("#thead_symbol_"+$id).removeClass("fa-angle-up");
	}
}
</script>