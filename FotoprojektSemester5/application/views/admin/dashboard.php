<section style="padding-top: 70px"></section>
<div class="contrainer">
	<div class="row">
		<h1 class="offset-md-1 col-md-2" ><?php echo $DashboardViewHeader; ?></h1>
	</div>
</div>





<?php 	

	$SumDaily = 0;
	
	foreach ( $orders as $order ) {
		
		$orderDate = date("m/d/Y", strtotime($order->orde_date));

		if ($orderDate == date('01/09/2017'))
		{
			$SumDaily += $order->orde_sum;
		}
		
		
	}
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
							echo "Heutiger Umsatz: " . $SumDaily . '€';
							//echo $orderDate . $SumDaily . 'Bestellnummer: ' . $order->orde_no . ' | Datum: ' . $order->orde_date . ' | Summe: ' . $order->orde_sum . '€';
						echo '</a>';
						//Div-Ende für h4
					echo '</h4>';
					
				//Div-Ende für Card Header
				echo '</div>';
			//Div-Ende für Card
			echo '</div>';
		//Div-Ende für Row
		echo '</div>';

		
	
	
?>