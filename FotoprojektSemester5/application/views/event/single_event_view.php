
<section class="jumbotron text-xs-center">
	<div class="container">
	<h1 class="jumbotron-heading"><?php echo $event->even_name;?></h1>	
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
				echo form_open_multipart("Product/insert", array("name" => "newproduct"), array('even_id' => $event->even_id));
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
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Open Modal</button>
<div class="table-responsive">
	
	<table class="table table-striped">
			<?php
				echo "<tr>". "<th>ID:</th>". "<th>" . $event->even_id . "</th></tr>";
				echo "<tr>". "<th>Bezeichung:</th>". "<th>" . $event->even_name . "</th></tr>";
				echo "<tr>". "<th>Datum:</th>". "<th>" . $event->even_date . "</th></tr>";
				echo "<tr>". "<th>URL:</th>". "<th>" . $event->even_url . "</th></tr>";
				echo "<tr>". "<th>Event Fotograf:</th>". "<th>" . $event->user_firstname . " ". $event->user_name . "</th></tr>";
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
				echo " <img data-src='../../" . $product->prod_filepath ."'". " alt=" . $product->prod_name .
					" style=\"width:304px;height:228px; display: block;\"
					src=../../" . $product->prod_filepath . ">";
				echo "</a>";
				echo "<p class=\"card-text\">" . $product->prod_name . "</p>";
				echo "-->";
				echo "</div>";
				echo "</div>";
			}
			
			?>
		</div>
	</div>
</div>





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
    	<div class="container">
      		<div class="row">
      			<div class="col-md-6">
      		
				<img src="http://www.basteldichblue.com/Public/BMDE/12/Viereckiges%20Scoubidou%20x4/4726_200x200.jpg" class="img-responsive" alt="Cinque Terre">
       		
      			</div>
      			
      			<div class="col-md-6">
      			<button class="btn" data-toggle="collapse" data-target="#digital">Digital</button>
				
				<div id="digital" class="collapse">
				<br />
				<div class="form-group">
			    <select class="form-control" id="größeSelect">
			      <option style="color: grey">Größe wählen*</option>
			      <option>Small</option>
			      <option>Medium</option>
			      <option>Large</option>
			      <option>ExtraLarge</option>
			    </select>
			    </div> 
				<input type="text" class="form-control input-sm chat-input" placeholder="Menge" name="menge"/>
				<textarea class="form-control" rows="1" cols="10" placeholder="Preis" readonly="readonly"></textarea>
      			
      			</div>
      			
      			<button class="btn" data-toggle="collapse" data-target="#analog">Analog</button>
      			
      			
      			<div id="analog" class="collapse">
      			<br />
      			<div class="form-group">
			    <select class="form-control" id="formatSelect">
			      <option style="color: grey">Format wählen*</option>
			      <option>Bild</option>
			      <option>Tasse</option>
			      <option>Format</option>
			      <option>Penistattoo</option>
			    </select>
			    </div>
			    <div class="form-group">
			     <select class="form-control" id="größeSelect">
			      <option style="color: grey">Größe wählen*</option>
			      <option>Small</option>
			      <option>Medium</option>
			      <option>Large</option>
			      <option>ExtraLarge</option>
			    </select>
			    </div> 
			    <div class="form-group">
			        <select class="form-control" id="rahmenSelect">
			      <option style="color: grey">Bilderrahmen wählen*</option>
			      <option>Mit Bilderrahmen</option>
			      <option>Ohne Bilderrahmen</option>
			    </select>
			    </div> 
			    <div class="form-group">
			        <select class="form-control" id="materialSelect">
			      <option style="color: grey">Material wählen*</option>
			      <option>Matt</option>
			      <option>Glänzend</option>
			      <option>Hochwertig</option>
			      <option>Billig scheiß</option>
			    </select>
			    </div> 
			    <textarea class="form-control" rows="1" cols="10" placeholder="Preis" readonly="readonly"></textarea>
			    
      			</div> 
      			 
      			</div>
     	 	</div>
       	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
        <button type="button" class="btn btn-default">In den Warenkorb</button>
      </div>
    </div>
	</div>
  </div>
</div>