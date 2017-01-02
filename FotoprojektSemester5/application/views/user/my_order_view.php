
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Neues Event erstellen</title>
	<link rel="stylesheet" href="../css/fps5.css"> 
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../_sonstiges/bootstrap-4.0.0-alpha.5/dist/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
</head>
<body>
	<section class="jumbotron text-xs-center">
		<div class="container">
			<h1 class="jumbotron-heading"><?php
			echo 'Meine Bestellungen'?> </h1>
		</div>
		<br>
<div class="panel-group" id="accordion">
  
  <?php
		foreach ( $orders as $order ) {
			echo "<div class=\"panel panel-default\" id=\panel" . $order->orde_id . ">";
			echo "<div class=\"panel-heading\">";
			echo "<h4 class= \"panel-title\">";
			echo "<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse" . $order->orde_id . "\">";
			echo "Bestellnummer: " . $order->orde_no . " | Datum: " . $order->orde_date . " | Summe: " . $order->orde_sum . "€";
			echo "</a>";
			echo "</h4>";
			echo "</div>";
			echo "<div id=\"collapse" . $order->orde_id . "\" class=\"panel-collapse collapse\">";
			echo "<div class=\"panel-body\">";
			?>
						<div class="row">
						<div class="col-sm-2 hidden-xs-down"><h5>Event</h5></div>
						<div class="col-sm-2 hidden-xs-down"><h5>Name</h5></div>
						<div class="col-sm-2 hidden-xs-down"><h5>Menge</h5></div>
						<div class="col-sm-2 hidden-xs-down"><h5>Preis</h5></div>
						<div class="col-sm-2 hidden-xs-down"><h5>Format</h5></div>
						<div class="col-sm-2 hidden-xs-down"><h5>Bestelltyp</h5></div>
						</div>
						
						
								<?php
			foreach ( $order->order_position as $op ) {
				echo "<div class=\"row\">";
				echo "<div class=\"col-sm-2 col-xs-6\">" . $op->even_name . "</div>";
				echo "<div class=\"col-sm-2 col-xs-6\">" . $op->prod_name . "</div>";
				echo "<div class=\"col-sm-2 col-xs-6\">" . $op->orpo_amount . "</div>";
				echo "<div class=\"col-sm-2 col-xs-6\">" . $op->orpo_price . "€</div>";
				echo "<div class=\"col-sm-2 col-xs-6\">" . $op->prty_description . "</div>";
				
				if ($op->prty_type == ProductPrintType::download) {
					echo "<div class=\"col-sm-2 col-xs-6\">" . 'Download' . "</div>";
				} else
					echo "<div class=\"col-sm-2 col-xs-6\">" . 'Druck' . "</div>";
				echo "</div>";
			}
			?>
			<?php
			// echo "</div>";
			echo "</div>";
			echo "</div>";
		}
		?>
</div>
	</section>