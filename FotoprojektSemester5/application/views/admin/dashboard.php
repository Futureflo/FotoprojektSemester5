<section style="padding-top: 70px"></section>
<div class="contrainer">
	<div class="row">
		<h1 class="offset-md-1 col-md-2" ><?php echo $DashboardViewHeader; ?></h1>
	</div>
</div>





<?php 	
	setCollape($orders, 1);
	echo '<br />';
	setCollape($orders, 2);
	echo '<br />';
	setCollape($orders, 3);
	echo '<br />';
	setCollape($orders, 4);
	echo '<br />';
	setCollape($orders, 5);




	function setCollape($orders, $modeID) {
		/* modeID
		 * 1 = Daily
		 * 2 = Weekly
		 * 3 = monthly
		 * 4 = Yearky
		 */
		
		$titelCollaps = "";
		$summeOrder = 0;
		$summeMwSt = 0;

		
		switch ($modeID) {
			case 1:
				
				$titelCollapse = "Heutiger Umsatz: ";
				break;
			case 2:
				$titelCollapse = "Wöchentlicher Umsatz: ";
				break;
			case 3:
				$titelCollapse = "Monatlicher Umsatz: ";
				break;
			case 4:
				$titelCollapse = "Jährlicher Umsatz: ";
				break;
			case 5:
				$titelCollapse = "Kompletter Umsatz: ";
				break;
		}
		
		foreach ( $orders as $order ) {
		
			if (checkerDate($order, $modeID)) {
				$summeOrder += $order->orde_sum;
				$summeMwSt += 0.19 * $order->orde_sum;
			}
		}
		
		
		echo '<div class="row offset-md-2 col-md-8">';
			//Dive für Card
			echo '<div class="">';
				//Div für Card Header
				echo '<div class="card-header" role="tab" id=heading">';
					//Div für h4
					echo '<h4 class= "mb-0">';
						//a-section für überschrift
						echo '<a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapse" href="#collapse' . $modeID . '">';
							echo $titelCollapse . $summeOrder . '€ davon MwSt.: '. $summeMwSt .'€';
							//echo $orderDate . $SumDaily . 'Bestellnummer: ' . $order->orde_no . ' | Datum: ' . $order->orde_date . ' | Summe: ' . $order->orde_sum . '€';
						echo '</a>';
						//Div-Ende für h4
					echo '</h4>';
					
					//Div für Inhalt
					echo '<div id="collapse' . $modeID . '" class="collapse show " role="tabpanel" aria-labelledby="heading">';
						//Div
						echo '<div class="card-block">';
							// Anfang Tabelle
							echo '<table class="table">';
								echo "<thead>";
									echo "<tr>";
									echo "<th><h5>Bestellnummer</h5></th>";
									echo "<th><h5>Besteller</h5></th>";
									echo "<th><h5>Bestelldatum</h5></th>";
									echo "<th><h5>Bestellsumme</h5></th>";
									echo "</tr>";
								echo '</thead>';
								
								echo "<tbody>";
								foreach ( $orders as $order ) {
									if (checkerDate($order, $modeID)) {
										$summeOrder += $order->orde_sum;
										echo "<tr>";
										echo "<td>" . $order->orde_no . "</td>";
										echo "<td>" . $order->user_name . "</td>";
										echo "<td>" . $order->orde_date . "</td>";
										echo "<td>" . $order->orde_sum . "</td>";

										echo "</tr>";
									}
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
			//Div-Ende für Card
			echo '</div>';
			echo '<br />';
		//Div-Ende für Row
		echo '</div>';
		echo '<br></br>';
	}
		
		function checkerDate($order, $modeID)
		{
			
			switch ($modeID) {
				case 1:
					$checkParameter = date("d/m/Y");
					if (date("d/m/Y", strtotime($order->orde_date)) == $checkParameter)
					{
						return true;
					}
					return false;
					
					break;
					
				case 2:
					$checkParameter = date("W/m/Y");
					if (date("W/m/Y", strtotime($order->orde_date)) == $checkParameter)
					{
						return true;
					}
					return false;
					break;
				case 3:
					$checkParameter = date("m/Y");
					if (date("m/Y", strtotime($order->orde_date)) == $checkParameter)
					{
						return true;
					}
					return false;
					break;
				case 4:
					$checkParameter = date("Y");
					if (date("Y", strtotime($order->orde_date)) == $checkParameter)
					{
						return true;
					}
					return false;
					break;
				case 5:
					return true;
					break;
			}
			

		}
		
	
	
?>