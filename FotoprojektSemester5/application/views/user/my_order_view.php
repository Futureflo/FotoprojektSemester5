
	<section class="jumbotron text-sm-center col-md-12">
		<div class="container">
			<h1 class="jumbotron-heading"><?php
			echo 'Meine Bestellungen'?> </h1>
		</div>
	
    </section>
  <div id="accordion" role="tablist" aria-multiselectable="true">
  
  <?php
		foreach ( $orders as $order ) {
			echo '<p></p>';
			echo '<div class="row offset-md-2 col-md-8">';
				//Dive für Card
				echo '<div class="">';
					//Div für Card Header
					echo '<div class="card-header" role="tab" id=heading">';
						//Div für h4
						echo '<h4 class= "mb-0">';
							//a-section für überschrift
							echo '<a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapse" href="#collapse' . $order->orde_id . '">';
							echo 'Bestellnummer: ' . $order->orde_no . ' | Datum: ' . $order->orde_date . ' | Summe: ' . number_format($order->orde_sum,2,',','.' ) . '€';
							echo '</a>';
						//Div-Ende für h4
						echo '</h4>';
						//Div für Inhalt
						echo '<div id="collapse' . $order->orde_id . '" class="collapse show " role="tabpanel" aria-labelledby="heading">';
							//Div 
							echo '<div class="card-block">';
								// Anfang Tabelle
								echo '<table class="table">';
									echo "<thead>";
										echo "<tr>";
											echo "<th><h5>Event</h5></th>";
											echo "<th><h5>Name</h5></th>";
											echo "<th><h5>Menge</h5></th>";
											echo "<th><h5>Preis</h5></th>";
											echo "<th><h5>Format</h5></th>";
											echo "<th><h5>Bestelltyp</h5></th>";
										echo "</tr>";
									echo '</thead>';

									foreach ( $order->order_position as $op ) {
									
										echo "<tbody>";
										echo "<tr>";
										echo "<td scope=\"row\">" . $op->even_name . "</td>";
										echo "<td>" . $op->prod_name . "</td>";
										echo "<td>" . $op->orpo_amount . "</td>";
										echo "<td>" . number_format($op->orpo_price,2,',','.' ) . "€</td>";
										echo "<td>" . $op->prty_description . "</td>";
									
										if ($op->prty_type == ProductPrintType::download) {
										
												echo "<td>" . btnDownload($order) . "</td>";										
											} else
												echo "<td>" . 'Druck' . "</td";
										}
									echo "</tr>";
									echo "</tbody>";
								//Ende Tabelle
								echo '</table>';
							//End Div
							echo '</div>';
						//Div-Ende für Inhalt
						echo '</div>';
				    //Div-Ende für Card Header
					echo '</div>';
					echo '<br>';
				//Div-Ende für Card
				echo '</div>';
			//Div-Ende für Row
			echo '</div>';
		}
		
		
		function btnDownload($order)
		{
			return '<button title="Download" onclick="btnSendDownload(' . $order->orde_id .')" class="btn btn-info fa fa-download fa-lg" style="margin-right:1rem"></button>';
		}
		?>
	
</div>
<script>
function btnSendDownload(OrderID) {
    $.ajax({
		  type: "POST",
		  url: "<?php echo site_url (); ?>/DownloadManager/manageDownload/"+OrderID,
		  dataType: 'html',
		});
	alert ('Email wurde versendet!');
	location.reload();
}
 </script>