
<section style="padding-top: 70px">
	<div class="container">
		<?php
		if (isset ( $user_id )) {
			echo "<div class='alert alert-danger'>";
			echo "Der Benutzer mit der ID: " . $user_id . " wurde gelöscht</div>";
		}
		?>
</div>
</section>


<div class="container">
		<div class="row">
		<div class="col-md-3">
		<p class="h1" id="test" onclick="setPager()">Users</p>
		</div>
		
		<div class="col-md-6">
			<a class="btn btn-success" href="#">
  			<i class="fa fa-user-plus fa-lg"></i> Benutzer anlegen</a>
		</div>
		
		<div class="col-md-3">
			<input type="text" id="searchTerm" class="form-control"
				onkeyup="search()" placeholder="Search for user..." />
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
						<th>Nachname</th>
						<th>Vorname</th>
						<th>e-Mail</th>
						<!-- <th>Passwort</th> -->
						<th>Rolle</th>
						<th>Status</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody id="table_body">
			<?php
			foreach ( $users as $user ) {
				switch ($user->user_status) {
					default :
					case 0 : // undefiniert
						$statusText = "undefiniert";
						break;
					case 1 : // Admin
						$statusText = "registriert";
						break;
					case 2 : // Besteller
						$statusText = "aktiv";
						break;
					case 3 : // Fotograf
						$statusText = "gesperrt";
						break;
					case 4 : // Veranstalter
						$statusText = "gelöscht";
						break;
				}			
				echo "<tr class='searchable'>";
				echo "<td>" . $user->user_id . "</td>";
				echo "<td>" . $user->user_name . "</td>";
				echo "<td>" . $user->user_firstname . "</td>";
				echo "<td>" . $user->user_email . "</td>";
				// echo "<td>" . $user->user_password . "</td>";
				echo "<td>" . $user->usro_name . "</td>";
				echo "<td>" . $statusText . "</td>";
				echo "<td>";

				echo "<center>";
					if ($user->user_status == 1 || $user->user_status == 3){
						echo btnEdit($user);
						echo btnUnlockUser($user);
						echo btnDelete($user);
					}elseif ($user->user_status == 2){
						echo btnEdit($user);
						echo btnLockUser($user);
						echo btnDelete($user);
					}elseif ($user->user_status == 4){
						echo btnRecycle($user);
					};
				echo "</center>";
				echo "</td>";
				echo "</tr>";
			}
			
			function btnDelete($user){
				return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Benutzer \"" . $user->user_name . "\" löschen' aria-label='delete' onclick='whichUser(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			
			function btnEdit($user){
				return "<a class='btn btn-info' data-toggle='modal' data-target='#editUser' title='Benutzer \"" . $user->user_name . "\" bearbeiten' aria-label='edit' style='margin-right:1rem' onclick='whichUser(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-pencil fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			
			function btnLockUser($user){
				return "<a class='btn btn-warning' data-toggle='modal' data-target='#lockUser' title='Benutzer \"" . $user->user_name . "\" sperren' aria-label='lock' style='margin-right:1rem' onclick='whichUserLock(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-ban fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			
			function btnUnlockUser($user){
				return "<a class='btn btn-success' data-toggle='modal' data-target='#unlockUser' title='Benutzer \"" . $user->user_name . "\" entsperren' aria-label='unlock' style='margin-right:1rem' onclick='whichUserUnlock(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-unlock fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			
			function btnRecycle($user){
				return "<a class='btn btn-success' data-toggle='modal' data-target='#recycle' title='Benutzer \"" . $user->user_name . "\" wiederherstellen' aria-label='Recicle' onclick='whichUser(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';><i class='fa fa-recycle fa-lg' aria-hidden='True' style='color:white;'></i></a>";
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
	        	<h4 class="modal-title custom_align" id="Heading">User löschen?</h4>
	 		</div>
	   		<div class="modal-body">   
				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
		       		</span>Möchten Sie den Benutzer "<span id="user"></span>" unwiederruflich löschen?
		       	</div>
	 		</div>
		  	<div class="modal-footer ">
		        <form action="<?php echo base_url();?>admin/deleteUser/" method="post">
			        <input id="user_hidden_field" type="hidden" name="user_hidden_field" value="">
			        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>Benutzer löschen</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
		        </form>
			</div>
		</div>
    	<!-- /.modal-content --> 
	</div>
      <!-- /.modal-dialog --> 
</div>

<div class="modal fade" id="lockUser" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
	       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        	<h4 class="modal-title custom_align" id="Heading">Benutzer sperren?</h4>
	 		</div>
	   		<div class="modal-body">   
				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
		       		</span>Möchten Sie den Benutzer "<span id="userLock"></span>" sperren?
		       	</div>
	 		</div>
		  	<div class="modal-footer ">
		        <form action="<?php echo base_url();?>admin/lockUser/" method="post">
			        <input id="userLock_hidden_field" type="hidden" name="userLock_hidden_field" value="">
			        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>Benutzer sperren</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
		        </form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="unlockUser" tabindex="-1" role="dialog"
	aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">

	    <div class="modal-content">
	    	<div class="modal-header">
	       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        	<h4 class="modal-title custom_align" id="Heading">User entsperren?</h4>
	 		</div>
	   		<div class="modal-body">   
				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
		       		</span>Möchten Sie den Benutzer "<span id="userUnlock"></span>" wieder entsperren?
		       	</div>
	 		</div>
		  	<div class="modal-footer ">
		        <form action="<?php echo base_url();?>admin/unlockUser/" method="post">
			        <input id="userUnlock_hidden_field" type="hidden" name="userUnlock_hidden_field" value="">
			        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>Benutzer entsperren</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abbrechen</button>
		        </form>
			</div>
		</div>
    	<!-- /.modal-content --> 
	</div>
      <!-- /.modal-dialog --> 
</div>

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

    function whichUser(vorname, nachname, id){
        document.getElementById("user").innerHTML = vorname + " " + nachname;
        document.getElementById("user_hidden_field").value = id;
    }

    function whichUserLock(vorname, nachname, id){
        document.getElementById("userLock").innerHTML = vorname + " " + nachname;
        document.getElementById("userLock_hidden_field").value = id;
    }

    function whichUserUnlock(vorname, nachname, id){
        document.getElementById("userUnlock").innerHTML = vorname + " " + nachname;
        document.getElementById("userUnlock_hidden_field").value = id;
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
<script src="<?php echo base_url();?>js/sorttable.js"></script>
