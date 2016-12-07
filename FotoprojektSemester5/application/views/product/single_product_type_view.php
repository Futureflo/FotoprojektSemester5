
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Single Picture View</h1>
		<p class="lead text-muted">Something short and leading about the
			collection below—its contents, the creator, etc. Make it short and
			sweet, but not too short so folks don't simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary">Main call to action</a> <a
				href="#" class="btn btn-secondary">Secondary action</a>
		</p>
	</div>
</section>

<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
	<?php echo "<h1>Product Type: ".  $product_type[0]->prty_description. "</h1>"; ?>
	<div class="table-responsive">
		
		<table class="table table-striped">
				<?php
				 
				
					echo "<tr>". "<th>ID:</th>". "<th>" . $product_type[0]->prty_id . "</th></tr>";
					echo "<tr>". "<th>Bezeichung:</th>". "<th>" . $product_type[0]->prty_description . "</th></tr>";
					echo "<tr>". "<th>Typ:</th>"; 

					if ($product_type[0]->prty_type == ProductPrintType::Print)
					{
						echo "<th>" . 'Druck' . "</th>"; 
					}
					else echo "<th>" . 'Download' . "</th>";
					
					echo "<tr>". "<th>Höhe:</th>". "<th>" . $product_type[0]->prty_height. "</th></tr>";
					echo "<tr>". "<th>Breite:</th>". "<th>" . $product_type[0]->prty_width . "</th></tr>";
					
					
					echo "</tr>";
						
				?>
		</table>
	</div>
</div>
