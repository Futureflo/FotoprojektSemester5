
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
		<div class="col-md-7">
		<p class="h1" id="test" onload="setPager()">
			Benutzer Newsletter
		</p>
		</div>
			<div class="col-md-2">
				<a class="btn btn-success" href="<?php
				
				echo base_url ();
				?>admin/createNewsletterCSV/">
	  			<i class="fa fa-download fa-lg"></i> CSV-Export</a>
			</div>
		<div class="col-md-3">
			<input type="text" id="searchTerm" class="form-control"
				onkeyup="search()" placeholder="Suche Benutzer..." />
		</div>
		</div>
		<div class="row">
		<div class="col-sm-12 col-md-12">
		<div class="table-responsive">
			<table id="dataTable"
				class="table  table-bordered sortable">
				<thead>
					<tr>
						<th>Titel</th>
						<th>Nachname</th>
						<th>Vorname</th>
						<th>e-Mail</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody id="table_body">
			<?php
			foreach ( $neleRegisteredUser as $user ) {
				echo "<tr class='searchable'>";
				echo "<td>" . $user->Anrede . "</td>";
				echo "<td>" . $user->Nachname . "</td>";
				echo "<td>" . $user->Vorname . "</td>";
				echo "<td>" . $user->E_Mail . "</td>";
				echo "<td>";
				echo btnDelete ( $user );
				echo "</td>";
				echo "</tr>";
			}
			
			foreach ( $neleUnknownUser as $user ) {
				echo "<tr class='searchable'>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td>" . $user->E_Mail . "</td>";
				echo "<td>";
				echo btnDeleteUnknown ( $user );
				echo "</td>";
				echo "</tr>";
			}
			function btnDelete($user) {
				return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Benutzer \"" . $user->E_Mail . "\" löschen'  onclick='whichUser(\"" . $user->E_Mail . "\")'; aria-label='delete'><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			function btnDeleteUnknown($user) {
				return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Benutzer \"" . $user->E_Mail . "\" löschen' onclick='whichUser(\"" . $user->E_Mail . "\")'; aria-label='delete'><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
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
		       		</span>Möchten Sie den Benutzer aus der Newsletterliste entfernen?
		       	</div>
	 		</div>
		  	<div class="modal-footer ">
		        <form action="<?php
										
										echo base_url ();
										?>admin/deleteUserFromNewsletterlist/" method="post">
			        <input id="user_hidden_field" type="hidden" name="userDelete_hidden_field" value="">
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
$('.signinform').submit(function() { 
   $(this).ajaxSubmit({ 
       type : "POST",
       //set the data type
       dataType:'json',
       url: 'index.php/user/signin', // target element(s) to be updated with server response 
       cache : false,
       //check this in Firefox browser
       success : function(response){ console.log(response); alert(response)},
       error: onFailRegistered
   });        
   return false; 
}); 
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

    function whichUser(email){
        document.getElementById("user_hidden_field").value = email;
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
