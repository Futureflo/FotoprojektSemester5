
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
		<p class="h1">Users</p>
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
				echo "<center><a class='btn btn-danger' href='path/to/settings' aria-label='Delete'>";
					echo "<i class='fa fa-trash-o' aria-hidden='true'></i></a></center></td>";
				echo "<tr>";
			}
			?>
			</tbody>
			</table>
		</div>
	</div>
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
</script>
<script src="<?php echo base_url();?>js/sorttable.js"></script>
