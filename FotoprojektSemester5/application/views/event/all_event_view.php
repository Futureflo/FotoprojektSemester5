<section style="padding-top: 100px"></section>


<div class="contrainer">
	<div class="row">
	
		<h1 class="offset-md-2 col-md-2" >&Uuml;bersicht</h1>
		
		
		<button onclick="validate()" id="new" name="submit" type="button" 
		 class="btn btn-danger fa fa-trash-o col-md-1" data-toggle='modal' data-target='#delete'></button>
		 
		<a href="<?php echo base_url(); ?>/event/"><button id="erase" name="submit" type="button" 
		 class="btn btn-primary fa fa-plus-square offset-md-1 col-md-1"></button></a>

		<div class="offset-md-1 col-md-2">
			<input type="text" id="searchTerm" class="form-control"
			 onkeyup="search()" placeholder="Search for user..."/>
		</div>


	</div>
	<section style="padding-top: 50px"></section>
	
	<form action="<?php echo base_url (); ?>Event/deleteEvent/" method="post">
	<div class="row">
		<div class="offset-md-2 col-md-8"><?php echo $this->session->flashdata ( 'msgReg' ); ?>
			<div class="table-responsive">
					<table id="dataTable"
						class="table table-striped table-bordered sortable table-hover">
						<thead>
							<tr>
								<th></th>
								<th>ID</th>
								<th>Bezeichnung</th>
								<th>Status</th>
								<th>URL</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ( $events as $event ) {
									echo "<tr>";
									echo "<td><input type='checkbox' name='chk_group[]' value='" . $event->even_id."'></td>";
									echo "<td>" . $event->even_id. "</td>";
									echo "<td>" . $event->even_name. "</td>";
									//echo "<td>" . $event->even_status . "</td>";
									
									switch ($event->even_status) {
										case 1:
											echo "<td> Gesperrt </td>";
											break;
										case 2:
											echo "<td> Privat </td>";
											break;
										case 3:
											echo "<td> Öffentlich </td>";
											break;
										case 4:
											echo "<td> Gelöscht </td>";
											break;
									}
									
									echo "<td> <a href=http://www.snap-gallery.de/event/" . $event->even_url . " target='_blank'>www.snap-gallery.de/event/" . $event->even_url . "</a></td>";
									
									echo "<tr>";
				 				}
							?>
						</tbody>
					</table>
			</div>
		</div>
		
		<div class="modal fade" id="delete" tabindex="-1" role="dialog"
		aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
			    	<div class="modal-header">
			       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			        	<h4 class="modal-title custom_align" id="Heading">Events löschen?</h4>
			 		</div>
			   		
			   		<div class="modal-body">   
						<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
				       		</span>Möchten Sie die markierten Events löschen?
				       	</div>
			 		</div>
				  	
				  	<div class="modal-footer ">
				   
					        <input type="submit" class="btn btn-danger" value="Events löschen"><span class="glyphicon glyphicon-ok-sign"></span>
					        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
				        </form>
					</div>
				</div>
			    	<!-- /.modal-content --> 
				</div>
			      <!-- /.modal-dialog --> 
		</div>
		
		
		
	</div>
</div>

<script language="javascript">
function check(element)
 {
   element.checked = !element.checked;
 }
</script>

