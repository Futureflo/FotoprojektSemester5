
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading"><?php echo $event[0]->even_name;?></h1>
		<!-- 		<p class="lead text-muted">Something short and leading about the
			collection below—its contents, the creator, etc. Make it short and
			sweet, but not too short so folks don't simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary">Main call to action</a> <a
				href="#" class="btn btn-secondary">Secondary action</a>
		</p> -->
	</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<?php
			echo form_open_multipart ( "Product/insert", array (
					"name" => "newproduct" 
			), array (
					'even_id' => $event [0]->even_id 
			) );
			?>
				<div class="form-insert_product">
				<input type="file" name="dateiupload" class="btn"> <input
					type="submit" name="btn[upload]" class="btn btn-success">
			</div>
			</form>
			
			<?php echo $this->session->flashdata('msg'); ?>					
		</div>
	</div>
</div>

<div class="table-responsive">

	<table class="table table-striped">
	
			<?php
			echo "<tr>" . "<th>ID:</th>" . "<th>" . $event [0]->even_id . "</th></tr>";
			echo "<tr>" . "<th>Bezeichung:</th>" . "<th>" . $event [0]->even_name . "</th></tr>";
			echo "<tr>" . "<th>Datum:</th>" . "<th>" . $event [0]->even_date . "</th></tr>";
			echo "<tr>" . "<th>URL:</th>" . "<th>" . $event [0]->even_url . "</th></tr>";
			echo "<tr>" . "<th>Event Fotograf:</th>" . "<th>" . $event [0]->user_firstname . " " . $event [0]->user_name . "</th></tr>";
			echo "</tr>";
			?>
			
	</table>
</div>

<div class="album text-muted">
	<div class="container">

		<div class="row">
		<?php
		foreach ( $products as $product ) {			
			echo "<div class=\"card\">";
			echo "<div class=\"lazyload\">";
			echo "<!--";
			echo " <img data-src=../../../" . $product->prod_filepath . "\" alt=" . $product->prod_name . "\"
					style=\"width:304px;height:228px; display: block;\"
					src=../../../" . $product->prod_filepath . ">";
			echo "<p class=\"card-text\">" . $product->prod_name . " | " . $product->prty_description . "</p>";
			echo "-->";
			echo "</div>";
			echo "</div>";
		}
		
		?>

		</div>
	</div>
</div>


<svg xmlns="http://www.w3.org/2000/svg" width="356" height="280"
	viewBox="0 0 356 280" preserveAspectRatio="none"
	style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;">
	<defs>
	<style type="text/css"></style></defs>
	<text x="0" y="18"
		style="font-weight:bold;font-size:18pt;font-family:Arial, Helvetica, Open Sans, sans-serif">356x280</text></svg>