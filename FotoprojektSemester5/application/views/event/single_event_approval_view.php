
<div style="visibility: hidden;" id="shoppingCartInsertURL"><?php
echo base_url ();
?>Shoppingcart/insert</div>
<section class="jumbotron text-xs-center"></section>

<div class="container">
	<div class="row">


		


<?php

for($i = 0; $i < 10; $i ++) :
	?>

			<?php
endfor
?>

			

	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-6 offset-md-3">
			<div class="table-responsive">
				<table class="table table-sm table-hover table-striped">
					<thead>
						<tr>
							<th>Event</th>
						</tr>
					</thead>
					<tbody>
					<?php
					
					for($i = 0; $i < 10; $i ++) :
						?>
						<tr>
							<td class="expandEvent" id="EventName<?=$i;?>">EventName<?=$i;?></td>
						</tr>

			<?php
					endfor
					?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
	<?php
	
	for($i = 0; $i < 10; $i ++) :
		?>
		<div class="col-sm-12 col-md-12">
			<div class="table-responsive expandableTable" id="EventName<?=$i;?>">
				<table class="table table-sm">
					<thead>
						<tr>
							<th>Bild</th>
							<th>Typ</th>
							<th>Freigeben/Sperren</th>
							<th>Spez. Preisaufschlag</th>
						</tr>
					</thead>
					<tbody>
<?php
		
		for($i = 0; $i < 10; $i ++) :
			?>
						<tr>
							<td><img src="http://placehold.it/100x100" alt="..." class="img-responsive" /></td>

							<td>Öffentlich/Privat</td>

							<td><div class="checkbox checkbox-slider--b-flat checkbox-slider-md"">
									<label><input type="checkbox" id="check_id" value=""><span></span></label>
								</div></td>

							<td><input type="number" min="0"></td>
						</tr>
		<?php
		endfor
		?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
	endfor
	?>
	</div>
</div>

<script>
$( document ).ready(function() {
	$(".expandableTable").hide();
	
	});

$(".expandEvent").click(function() { 
	$('.expandableTable').slideToggle("slow");
});
</script>