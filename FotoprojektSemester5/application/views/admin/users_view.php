
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
	<div class="col-sm-10 offset-sm-1 col-md-10 offset-md-1">
		<h1>Users</h1>
		<input type="text" id="searchTerm" class="search_box"
			onkeyup="search()" />
		<div class="table-responsive">
			<table id="dataTable"
				class="table table-striped table-bordered sortable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nachname</th>
						<th>Vorname</th>
						<th>e-Mail</th>
						<th>Passwort</th>
						<th>Rolle</th>
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
				echo "<td>" . $user->user_password . "</td>";
				echo "<td>" . $user->usro_name . "</td>";
				echo "<tr>";
			}
			?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
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
                  if (td.toLowerCase().includes(input.toLowerCase())) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
            } 
          }
    }
</script>
<script src="<?php echo base_url();?>js/sorttable.js"></script>
