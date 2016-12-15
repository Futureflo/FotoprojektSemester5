
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
			<h1 class="jumbotron-heading"><?php echo 'Meine Bestellungen'?> </h1>
		</div>
	</section>
	
<!-- Beispiel aus
https://jsfiddle.net/KyleMit/DSGxz/ 
-->

<div class="panel-group" id="accordion">
  
  <?php
			foreach($orders as $order)
			{
				echo "<div class=\"panel panel-default\" id=\panel". $order->orde_id .  ">"; 
					echo "<div class=\"panel-heading\">";
						echo "<h4 class= \"panel-title\">";
								echo "<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse" . $order->orde_id . "\">";
								echo "Bestellnummer: " . $order->orde_no . " | Datum: " .  $order->orde_date .  " | Summe: " . $order->orde_sum . "€";
								echo "</a>";
						echo "</h4>";			
					echo "</div>";
					echo "<div id=\"collapse" . $order->orde_id . "\" class=\"panel-collapse collapse\">";
						echo "<div class=\"panel-body\">";
											
						foreach($order->order_position as $op)
						{
							echo "<table class=\"table table-striped\">";
							echo "<tr>". "<th>Event:</th>". "<th>" . $op->even_name . "</th></tr>";
							echo "<tr>". "<th>Name:</th>". "<th>" . $op->prod_name . "</th></tr>";
							echo "<tr>". "<th>Menge:</th>". "<th>" . $op->orpo_amount . "</th></tr>";
							echo "<tr>". "<th>Preis:</th>". "<th>" . $op->orpo_price . "€</th></tr>";
							echo "<tr>". "<th>Format:</th>". "<th>" . $op->prty_description . "</th></tr>";
							
							if ($op->prty_type == ProductPrintType::download)
							{
								echo "<tr>". "<th>Bestelltyp:</th>". "<th>" . 'Download' . "</th></tr>";
							}
							else echo "<tr>". "<th>Bestelltyp:</th>". "<th>" . 'Druck' . "</th></tr>";
							
							echo "</tr>";
							echo "</table>";
							echo "<p>";
							
							echo "_______________________________________________________________________________________________________<br>";
	
						}
							
						echo "</div>";
					echo "</div>";
    			echo "</div>";
  			
			}
?>
</div>