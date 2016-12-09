
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Admin User View</h1>
		<p class="lead text-muted">Something short and leading about the
			collection below—its contents, the creator, etc. Make it short and
			sweet, but not too short so folks don't simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary">Main call to action</a> <a
				href="#" class="btn btn-secondary">Secondary action</a>
		</p>
	</div>
</section>

<div class="col-md-12">
	<div class="container">
		<div class="row">
		<div class="col-md-9">
		<p class="h1" id="test">Users</p>
		</div>
		<div class="col-md-3">
		<input type="text" id="searchTerm" class="form-control"
			onkeyup="search()" placeholder="Search for user..."/>
		</div>
		</div>
		</div>
		<div class="col-sm-10 offset-sm-1 col-md-10 offset-md-1">
		<div class="table-responsive">
			<table id="dataTable"
				class="table table-striped table-bordered sortable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nachname</th>
						<th>Vorname</th>
						<th>e-Mail</th>
						<!-- <th>Passwort</th> -->
						<th>Rolle</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
			<?php
			foreach ( $users as $user ) {
				echo "<tr class='searchable'>";
				echo "<td>" . $user->user_id . "</td>";
				echo "<td>" . $user->user_name . "</td>";
				echo "<td>" . $user->user_firstname . "</td>";
				echo "<td>" . $user->user_email . "</td>";
				//echo "<td>" . $user->user_password . "</td>";
				echo "<td>" . $user->usro_name . "</td>";
				echo "<td>";
				echo "<center><a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#delete' title='Benutzer \"" . $user->user_name . "\" löschen' aria-label='Delete' onclick='whichUser(\"" . $user->user_firstname . "\", \"" . $user->user_name . "\", \"" . $user->user_id . "\")';>";
					echo "<i class='fa fa-trash-o' aria-hidden='True' style='color:white;'></i></a></center></td>";
				echo "<tr>";
			}
			?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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

<script type="text/javascript">
    /**
        Alle Inhalte der Reihen einer Tabelle werden auf die Eingabe abgeglichen. Bei Nicht Übereinstimmung wird die Reihe ausgeblendet.
    */
    function search() {
        var input, table, tr, td, i;
        input = document.getElementById('searchTerm').value;
        table = document.getElementById('dataTable');
        tr = table.getElementsByClassName('searchable');
        
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
                    tr[i].style.display = "";
                    x = tr[0].getElementsByTagName("td").length;
                  }
                }
            } 
          }
    }

    function whichUser(vorname, nachname, id){
        document.getElementById("user").innerHTML = vorname + " " + nachname;
        document.getElementById("user_hidden_field").value = id;
    }
</script>
<script src="<?php echo base_url();?>js/sorttable.js"></script>
