
<section style="padding-top: 70px">
	<div class="container">
		<?php
		if (isset ( $message )) {
			echo "<div class='alert alert-danger'>";
			echo $message . "</div>";
		}
		?>
</div>
</section>


<div class="container">
		<div class="row">
		<div class="col-md-6">
		<p class="h1" id="test" onclick="setPager()">
		<?php
		
		echo $PrintersViewHeader?>
		</p>
		</div>
		<button onclick="validate()" id="create" name="submit" type="button"
  			class="btn btn-primary fa fa-plus-square offset-md-1 col-md-2">  Druckerei anlegen</button>
		<div class="col-md-3">
			<input type="text" id="searchTerm" class="form-control"
				onkeyup="search()" placeholder="Search for print shops..." />
		</div>
		</div>
		<div class="row">
		<div class="col-sm-12 col-md-12">
		<div class="table-responsive">
			<table id="dataTable"
				class="table  table-bordered sortable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Druckereiname</th>
						<th>Erstellungsdatum</th>
						<th>Erstellt von</th>
						<th>Status</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody id="table_body">
			<?php
			foreach ( $printers as $printer ) {
				
				echo "<tr class='searchable'>";
				echo "<td>" . $printer->prsu_id . "</td>";
				echo "<td>" . $printer->adre_name . "</td>";
				echo "<td>" . $printer->prsu_createdon . "</td>";
				echo "<td>" . $printer->prsu_createdby . "</td>";
				switch ($printer->prsu_status) {
					case 1 :
						echo "<td> Aktiv </td>";
						// echo "<td>" . btnEventUnlock($event);
						// echo btnEventDelete($event) . "</td>";
						break;
					case 2 :
						echo "<td> Gesperrt </td>";
						// echo "<td>" . btnEventLock($event);
						// echo btnPublic($event);
						// echo btnEventDelete($event) . "</td>";
						break;
				}
				echo "<td>";
				
				if ($printer->prsu_status == 1) {
					echo btnEdit ( $printer );
					echo btnDelete ( $printer );
				}
				echo "</td>";
				echo "</tr>";
			}
			function btnDelete($printer) {
				return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Druckerei \"" . $printer->adre_name . "\" löschen' aria-label='delete' onclick='whichPrinter(\"" . $printer->adre_name . "\", \"" . $printer->prsu_id . "\", \"" . $printer->prsu_email . "\")';><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			function btnEdit($printer) {
				return "<a class='btn btn-info' data-toggle='modal' data-target='#editPrinter' title='Druckerei \"" . $printer->adre_name . "\" bearbeiten' aria-label='edit' style='margin-right:1rem' onclick='whichPrinter(\"" . $printer->adre_name . "\", \"" . $printer->prsu_id . "\", \"" . $printer->prsu_email . "\")';><i class='fa fa-pencil fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			?>
			</tbody>
			</table>
			
		</div>
	</div>
</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-4">
			<nav aria-label="Page navigation">
				<ul class="pagination" id="parent_pagination">
					<li class="page-item" id="first_page"><a class="page-link"
						onclick="setActive('-')" tabindex="-1" aria-label="Previous"> <span
							aria-hidden="true">&laquo;</span> <span class="sr-only">Previous</span>
					</a></li>
					<!--    <li class="page-item active" id="first_page"><a class="page-link" onclick="pagination(1)">1</a></li> -->
					<li class="page-item"><a class="page-link" onclick="setActive('+')"
						aria-label="Next"> <span aria-hidden="true">&raquo;</span> <span
							class="sr-only">Next</span>
					</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>




<div class="modal fade" id="delete" tabindex="-1" role="dialog"
	aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">

	    <div class="modal-content">
	    	<div class="modal-header">
	       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        	<h4 class="modal-title custom_align" id="Heading">Druckerei löschen?</h4>
	 		</div>
	   		<div class="modal-body">   
				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
		       		</span>Möchten Sie die Druckerei "<span id="printer"></span>" unwiderruflich löschen?
		       	</div>
	 		</div>
		  	<div class="modal-footer ">
		        <form action="<?php
										
										echo base_url ();
										?>admin/deletePrinter/" method="post">
			        <input id="printer_hidden_field" type="hidden" name="printerDelete_hidden_field" value="">
			        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>Druckerei löschen</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
		        </form>
			</div>
		</div>
    	<!-- /.modal-content --> 
	</div>
      <!-- /.modal-dialog --> 
</div>
