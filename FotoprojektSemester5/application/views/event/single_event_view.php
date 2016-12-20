
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
				echo form_open_multipart("Product/insert", array("name" => "newproduct"), array('even_id' => $event[0]->even_id));
				?>
				<div class="form-insert_product">
					<input type="file" name="dateiupload" class="btn">
   				 	<input type="submit" name="btn[upload]" class="btn btn-success">
				</div>
 </form>
			
			<?php echo $this->session->flashdata('msg'); ?>					
		</div>
	</div>
</div>

<div class="table-responsive">
	
	<table class="table table-striped">
			<?php
				echo "<tr>". "<th>ID:</th>". "<th>" . $event[0]->even_id . "</th></tr>";
				echo "<tr>". "<th>Bezeichung:</th>". "<th>" . $event[0]->even_name . "</th></tr>";
				echo "<tr>". "<th>Datum:</th>". "<th>" . $event[0]->even_date . "</th></tr>";
				echo "<tr>". "<th>URL:</th>". "<th>" . $event[0]->even_url . "</th></tr>";
				echo "<tr>". "<th>Event Fotograf:</th>". "<th>" . $event[0]->user_firstname . " ". $event[0]->user_name . "</th></tr>";
				echo "</tr>";
			?>
	</table>
</div>
	

<div class="album text-muted">
	<div class="container">

		<div class="row">
		<?php
			foreach($products as $product){
				echo "<div class=\"card\">";
				echo "<div class=\"lazyload\">";
				echo "<!--";
				echo " <img data-src=../../" . $product->prod_filepath . "\" alt=" . $product->prod_name . "\"
					style=\"width:304px;height:228px; display: block;\"
					src=../../" . $product->prod_filepath . ">";
				echo "<p class=\"card-text\">" . $product->prod_name . " | " . $product->prty_description . "</p>";
				echo "-->";
				echo "</div>";
				echo "</div>";
			}
			
			?>
		</div>
	</div>
</div>


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bilder kaufen</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-sm-12">
      		
      		</div>
      		<div class="row">
      			<div class="col-sm-6"></div>
      		<div class="row">
      			<div class="col-sm-6"></div>
      		<button type="button" class="btn btn-primary">Digital</button>
      			<div class="col-sm-6"></div>
      		<button type="button" class="btn btn-primary">Digital</button>
      			</div>
       		
      	</div>
      
              <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
        <button type="button" class="btn btn-default">In den Warenkorb</button>
      </div>
    </div>

  </div>
</div>