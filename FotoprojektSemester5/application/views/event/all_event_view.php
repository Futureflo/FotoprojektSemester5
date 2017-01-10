<section style="padding-top: 70px"></section>


		
<div class="contrainer">

	<div class="row">
	
		<h1 class="offset-md-1 col-md-2" >Deine Events</h1>
<br>

		<div class="offset-md-6 col-md-2">
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
											echo "";
											break;
									}
									
									
									// echo "<td>" . btnEventDelete($event) . "</td>";
									echo "<tr>";
									?>
						
						<div class="modal fade" id="delete<?php echo($event->even_id); ?>" tabindex="-1" role="dialog"
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
													</span>Möchten Sie den "<?php echo($event->even_name); ?>" Event löschen?
												</div>
											</div>
											
											<div class="modal-footer ">
												<form action="<?php
																		
																		echo base_url ();
																		?>event/deleteEventById/<?php echo($event->even_id); ?>" method="post">
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
				 					//return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Benutzer \"" . $user->user_name . "\" löschen' aria-label='delete' onclick='whichUser(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
				 					return '<button onclick="validate()" id="new" title="Löschen" name="submit" type="button" class="btn btn-danger fa fa-trash-o fa-lg" data-toggle="modal" data-target="#delete'.$event->even_id.'"></button>';
				 				}
				 				function btnEventLock($event) {
				 					return '<button onclick="lockEvent(' . $event->even_id .')" title="Sperren" class="btn btn-warning fa fa-ban fa-lg" style="margin-right:1rem"></button>';
				 				}
				 				function btnEventUnlock($event) {
				 					return '<button title="Freigeben" onclick="unlockEvent(' . $event->even_id .')" class="btn btn-success fa fa-unlock fa-lg" style="margin-right:1rem"></button>';
				 				}
				 				function btnPrivate($event)
				 				{
				 					return '<button title="Privat setzen" onclick="privateEvent(' . $event->even_id .')" class="btn btn-primary fa fa-minus-circle fa-lg" style="margin-right:1rem"></button>';
				 				}
				 				function btnPublic($event)
				 				{
				 					return '<button title="Öffentlich setzen" onclick="publicEvent(' . $event->even_id .')" class="btn btn-info fa fa-share fa-lg" style="margin-right:1rem"></button>';
				 				}
							?>
						</tbody>
					</table>
			</div>
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
	     window.location.reload();
}

function unlockEvent(eventID) {
		    $.ajax({
	    		  type: "POST",
	    		  url: "<?php echo site_url (); ?>/event/unlockEventById/"+eventID,
	    		  dataType: 'html',
	    		

	    		});
	    window.location.reload();
}

function publicEvent(eventID) {
		    $.ajax({
	    		  type: "POST",
	    		  url: "<?php echo site_url (); ?>/event/changeStateToPublicById/"+eventID,
	    		  dataType: 'html',
	    		

	    		});
	       window.location.reload();
}


function privateEvent(eventID) {
		    $.ajax({
	    		  type: "POST",
	    		  url: "<?php echo site_url (); ?>/event/changeStateToPrivateById/"+eventID,
	    		  dataType: 'html',
	    		

	    		});
	    window.location.reload();
}
</script>




<script type="text/javascript">
    
    /**
        Erstellt einen Seitentab je 10 Datensätzen
    */
    function setPager(){
        var table = document.getElementById('dataTable');
        var tr = table.getElementsByClassName('searchable');
        var size = tr.length;
        var number = 1;
        
        while(size>0){
            size -= 10;
            createPager(number);
            number++;
        } 
        
    }
    
    function createPager(num){
        var node = document.createElement("LI");
        var a = document.createElement("A");
        var number = document.createTextNode(num);
        
        a.appendChild(number);
        node.appendChild(a);
        
        node.className += "page-item";
        a.className += "page-link";
        
        if(num === 1){
            node.className += " active";
        }
        
        a.onclick = function(){pagination(num);};
        node.onclick = function(){activeElement(num);};
        
        document.getElementById("first_page").appendChild(node);
    }
    
    /**
        Alle Inhalte der Reihen einer Tabelle werden auf die Eingabe abgeglichen. Bei Nicht Übereinstimmung wird die Reihe ausgeblendet.
    */
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

    function whichPrinter(name, id){
        document.getElementById("printer").innerHTML = name;
        document.getElementById("printer_hidden_field").value = id;
    }
    
    /**
        Die Daten werden auf 10 Datensätze pro Seite aufgeteilt
    */
   function pagination(page){
        var table, tr, td, i, j;
        table = document.getElementById('dataTable');
        tr = table.getElementsByClassName('searchable');
       
       for (j=0; j < tr.length; j++){
           tr[j].style.display = "none";
       }
       
       for (i=parseFloat((page*10)-10); i < parseFloat(page*10); i++){
           tr[i].style.display = "";
       }
    }
    
    /**
        Aktuelles Element wird farblich gekennzeichnet
    */
    function activeElement(num){
        var ul = document.getElementById("parent_pagination");
        var li = ul.getElementsByClassName("page-item");
        var ac;
        
        for(var i = 0; i < li.length; i++){
            if(li[i].classList.contains("active")){
                li[i].classList.remove("active");
            }
        }
        
        li[num].classList.add("active");
    }
    
    /**
        Das jeweilige nächste und vorliegende Element wird als Aktiv gekennzeichnet
    */
    function setActive(way){
        var ul = document.getElementById("parent_pagination");
        var li = ul.getElementsByClassName("page-item");
        var ac;
        
        for(var i = 0; i < li.length; i++){
            if(li[i].classList.contains("active")){
                li[i].classList.remove("active");
                ac = i;
            }
        }
            
        var min = ac - 1;
        var max = ac + 1;

        
        if(way === '+'){
            if(max < (li.length - 1)){
                li[ac + 1].classList.add("active");
                pagination(ac + 1);
            } else {
             li[ac].classList.add("active");
        }
        } else if (way === '-'){
            if(min > 0){
                li[ac - 1].classList.add("active");
                pagination(ac - 1);
            } else {
             li[ac].classList.add("active");
        }
        } else {
             li[ac].classList.add("active");
        }

    }
    window.addEventListener('load', setPager, false);
    window.addEventListener('load', pagination(1), false);
</script>
<script src="<?php
echo base_url ();
?>js/sorttable.js"></script>