<section style="padding-top: 70px"></section>


		
<div class="contrainer">

	<div class="row">
	<div class=" offset-md-1 col-md-7">
		<p class="h1">Meine Events</p>
	</div>

		<div class="col-md-3">
			<input type="text" id="searchTerm" class="form-control"
			 onkeyup="search()" placeholder="Suche ..."/>
		</div>
</div>

	
	
	
	<div class="row">
		<div class="offset-md-1 col-md-10"><br>
				<?php
				if (isset ( $message )) {
					echo $message;
				}
				?>
		
		<div id="fehler_span" class="text-danger"><?php
		echo $this->session->flashdata ( 'msgReg' );
		?></div>
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
								if ($event->even_status == 4)
									continue;
								echo "<tr class='searchable'>";
								echo "<td>" . $event->even_id . "</td>";
								echo "<td>" . $event->even_name . "</td>";
								// echo "<td>" . $event->even_status . "</td>";
								echo "<td> <a href=http://www.snap-gallery.de/event/" . $event->even_url . " target='_blank'>www.snap-gallery.de/event/" . $event->even_url . "</a></td>";
								if ($this->session->userdata ( 'user_role' ) == 3) {
									switch ($event->even_status) {
										case 1 :
											echo "<td> Gesperrt </td>";
											echo "<td>" . btnEventUnlock ( $event );
											echo btnEdit ( $event );
											echo btnEventDelete ( $event ) . "</td>";
											break;
										case 2 :
											echo "<td> Privat </td>";
											echo "<td>" . btnEventLock ( $event );
											echo btnPublic ( $event );
											echo btnEdit ( $event );
											echo btnEventDelete ( $event ) . "</td>";
											break;
										case 3 :
											echo "<td> Öffentlich </td>";
											echo "<td>" . btnEventLock ( $event );
											echo btnPrivate ( $event );
											echo btnEdit ( $event );
											echo btnEventDelete ( $event ) . "</td>";
											break;
										case 4 :
											echo "<td> Gelöscht </td>";
											echo "<td>" . btnReycle ( $event ) . "</td>";
											break;
									}
								}
								
								if ($this->session->userdata ( 'user_role' ) == 2) {
									switch ($event->even_status) {
										case 1 :
											echo "<td> Gesperrt </td>";
											echo "<td>" . btnEventUnlock ( $event );
											echo "</td>";
											break;
										case 2 :
											echo "<td> Freigegeben </td>";
											echo "<td>" . btnEventLock ( $event );
											
											echo "</td>";
											break;
										case 3 :
											echo "<td> Öffentlich </td>";
											echo "<td>" . btnEventLock ( $event );
											echo btnPrivate ( $event );
											echo "</td>";
											break;
										case 4 :
											echo "<td> Gelöscht </td>";
											echo "<td>" . btnReycle ( $event ) . "</td>";
											break;
									}
								}
								
								// echo "<td>" . btnEventDelete($event) . "</td>";
								echo "<tr>";
								?>
						
						<div class="modal fade" id="delete<?php
								
								echo ($event->even_id);
								?>" tabindex="-1" role="dialog"
								aria-labelledby="edit" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
												<h4 class="modal-title custom_align" id="Heading">Event löschen?</h4>
											</div>
											
											<div class="modal-body">   
												<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
													</span>Möchten Sie den "<?php
								
								echo ($event->even_name);
								?>" Event löschen?
												</div>
											</div>
											
											<div class="modal-footer ">
												<form action="<?php
								
								echo base_url ();
								?>event/deleteEventById/<?php
								
								echo ($event->even_id);
								?>" method="post">
													<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>Event löschen</button>
													<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
												</form>
											</div>
										</div>
											<!-- /.modal-content --> 
										</div>
										  <!-- /.modal-dialog --> 
								</div>
								
									<?php
							}
							function btnEventDelete($event) {
								// return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Benutzer \"" . $user->user_name . "\" löschen' aria-label='delete' onclick='whichUser(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
								return '<button onclick="whichEvent(' . $event->even_id . ')" id="new" title="Löschen" name="submit" type="button" class="btn btn-danger fa fa-trash-o fa-lg" data-toggle="modal" data-target="#delete' . ($event->even_id) . '"></button>';
							}
							function btnEventLock($event) {
								return '<button onclick="lockEvent(' . $event->even_id . ')" title="Sperren" class="btn btn-warning fa fa-ban fa-lg" style="margin-right:1rem"></button>';
							}
							function btnEventUnlock($event) {
								return '<button title="Freigeben" onclick="unlockEvent(' . $event->even_id . ')" class="btn btn-success fa fa-unlock fa-lg" style="margin-right:1rem"></button>';
							}
							function btnPrivate($event) {
								return; // '<button title="Privat setzen" onclick="setPrivateById(' . $event->even_id .')" class="btn btn-primary fa fa-minus-circle fa-lg" style="margin-right:1rem"></button>';
							}
							function btnPublic($event) {
								return; // '<button title="Öffentlich setzen" onclick="setPublicById(' . $event->even_id .')" class="btn btn-info fa fa-share fa-lg" style="margin-right:1rem"></button>';
							}
							function btnReycle($event) {
								return '<button title="Öffentlich setzen" onclick="setPrivateById(' . $event->even_id . ')" class="btn btn-success fa fa-recycle fa-lg" style="margin-right:1rem"></button>';
							}
							function btnEdit($event) {
								return '<button title="Bearbeiten" onclick="window.location.href=\'' . base_url () . 'event/edit/' . $event->even_id . '\'" class="btn btn-success fa fa-edit fa-lg" style="margin-right:1rem"></button>';
							}
							?>
						</tbody>
					</table>
			</div>
		</div>
		

		
		
	</div>
</div>
<script>
function deleteEventID(eventID) {
    $.ajax({
		  type: "POST",
		  url: "<?php
				
				echo site_url ();
				?>event/deleteEventById/"+eventID,
		  dataType: 'html',
		});
	location.reload();
}

function lockEvent(eventID) {
	    $.ajax({
	    		  type: "POST",
	    		  url: "<?php
									
									echo site_url ();
									?>event/lockEventById/"+eventID,
	    		  dataType: 'html',
	    		});
	    alert('Die Änderung wurde übernommen!');
	    location.reload();
}

function unlockEvent(eventID) {
    $.ajax({
		  type: "POST",
		  url: "<?php
				
				echo site_url ();
				?>event/unlockEventById/"+eventID,
		  dataType: 'html',
		});
    alert('Die Änderung wurde übernommen!');
	location.reload();
}

function setPublicById(eventID) {
    $.ajax({
		  type: "POST",
		  url: "<?php
				
				echo site_url ();
				?>event/changeStateToPublicById/"+eventID,
		  dataType: 'html',
		});
    alert('Die Änderung wurde übernommen!');
	location.reload();
}

function setPrivateById(eventID) {
    $.ajax({
		  type: "POST",
		  url: "<?php
				
				echo site_url ();
				?>event/changeStateToPrivateById/"+eventID,
		  dataType: 'html',
		});
    alert('Die Änderung wurde übernommen!');
	location.reload();
}

function search() {
    var input, table, tr, td, i;
    input = document.getElementById('searchTerm').value;
    table = document.getElementById('dataTable');
    tr = table.getElementsByClassName('searchable');
    
    var count = 0;
    
    // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
          for(var x = 0; x < tr[0].getElementsByTagName("td").length; x++){
            td = tr[i].getElementsByTagName("td")[x].innerHTML;
            if (td) {                    
                //Make case sensitive
                input = input.toLowerCase();
                td = td.toLowerCase();
                                    
              if (td.indexOf(input) == -1) {
                tr[i].style.display = "none";
              } else {
                 if(count < 10){ 
                    tr[i].style.display = "";
                    x = tr[0].getElementsByTagName("td").length;
                    count++;
                }
              }
            }
        } 
      }
}

function whichEvent(eventID){
    document.getElementById("eventIDspan").innerHTML = eventID;
    document.getElementById("event_hidden_field").value = eventID;
}

</script>

