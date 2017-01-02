<section style="padding-top: 70px"></section>


<div class="contrainer">
	<div class="row">
	
		<h1 class="offset-md-1 col-md-2" >Events</h1>

		<div class="offset-md-6 col-md-2">
			<input type="text" id="searchTerm" class="form-control"
			 onkeyup="search()" placeholder="Search for user..."/>
		</div>


	</div>
	
	
	<div class="row">
		<div class="offset-md-1 col-md-10">
			<div class="table-responsive">
					<table id="dataTable"
						class="table  table-bordered sortable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Bezeichnung</th>
								<th>URL</th>
								<th>Status</th>
								<th>Aktion</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ( $events as $event ) {
									echo "<tr class='searchable'>";
									echo "<td>" . $event->even_id. "</td>";
									echo "<td>" . $event->even_name. "</td>";
									//echo "<td>" . $event->even_status . "</td>";
									echo "<td> <a href=http://www.snap-gallery.de/event/" . $event->even_url . " target='_blank'>www.snap-gallery.de/event/" . $event->even_url . "</a></td>";
									
									switch ($event->even_status) {
										case 1:
											echo "<td> Gesperrt </td>";
											echo "<td>" . btnEventUnlock($event);
											echo btnEventDelete($event) . "</td>";
											break;
										case 2:
											echo "<td> Privat </td>";
											echo "<td>" . btnEventLock($event);
											echo btnPublic($event);
											echo btnEventDelete($event) . "</td>";
											break;
										case 3:
											echo "<td> Öffentlich </td>";
											echo "<td>" . btnEventLock($event);
											echo btnPrivate($event);
											echo btnEventDelete($event) . "</td>";
											break;
										case 4:
											echo "<td> Gelöscht </td>";
											echo btnEventDelete($event) . "</td>";
											break;
									}
									
									
									// echo "<td>" . btnEventDelete($event) . "</td>";
									echo "<tr>";
				 				}
				 				function btnEventDelete($event) {
				 					//return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Benutzer \"" . $user->user_name . "\" löschen' aria-label='delete' onclick='whichUser(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
				 					return '<button onclick="validate()" id="new" title="Löschen" name="submit" type="button" class="btn btn-danger fa fa-trash-o fa-lg" data-toggle="modal" data-target="#delete"></button>';
				 				}
				 				function btnEventLock($event) {
				 					return '<button onclick="lockEvent(' . $event->even_id .')" title="Sperren" class="btn btn-warning fa fa-ban fa-lg" style="margin-right:1rem"></button>';
				 				}
				 				function btnEventUnlock($event) {
				 					return '<button title="Freigeben" onclick="unlockEvent(' . $event->even_id .')" class="btn btn-success fa fa-unlock fa-lg" style="margin-right:1rem"></button>';
				 				}
				 				function btnPrivate($event)
				 				{
				 					return '<button title="Privat setzen" onclick="unlockEvent(' . $event->even_id .')" class="btn btn-primary fa fa-minus-circle fa-lg" style="margin-right:1rem"></button>';
				 				}
				 				function btnPublic($event)
				 				{
				 					return '<button title="Öffentlich setzen" onclick="unlockEvent(' . $event->even_id .')" class="btn btn-info fa fa-share fa-lg" style="margin-right:1rem"></button>';
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
				        <form action="<?php
												
												echo base_url ();
												?>admin/deleteUser/" method="post">
					        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>Events löschen</button>
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

<script>
function lockEvent(eventID) {
	    $.ajax({
	    		  type: "POST",
	    		  url: "<?php echo site_url (); ?>/event/lockEventById/"+eventID,
	    		  dataType: 'html',
	    		

	    		});
	    location.reload();
}

function unlockEvent(eventID) {
	
}
</script>


