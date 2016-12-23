<section style="padding-top: 70px"></section>


<div class="contrainer">
	<div class="row">
	
		<h1 class="offset-md-1 col-md-2" >Events</h1>
		<button onclick="validate()" id="login" name="submit" type="button" 
		 class="btn btn-primary col-md-2">+ Event anlegen</button>


		<div class="offset-md-4 col-md-2">
			<input type="text" id="searchTerm" class="form-control"
			 onkeyup="search()" placeholder="Search for user..."/>
		</div>
	</div>
	
	
	<div class="row">
		<div class="offset-md-1 col-md-10">
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
		
					</table>
			</div>
		</div>
		
	
	</div>



</div>



