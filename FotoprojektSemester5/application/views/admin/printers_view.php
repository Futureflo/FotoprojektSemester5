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
		<?php
		
		echo $PrintersViewHeader?>
		</p>
		</div>
			<div class="col-md-2">
				<?php
				if ($PrintersViewHeader != "Archivierte Druckereien") {
					echo '<a
					href="' . base_url () . 'printers/createPrinter/"
					class="btn btn-primary" role="button" href="createPrinter"> <i
					class="fa fa-plus-square fa-lg"></i> Druckerei anlegen</a>';
					// $data ['PrintersCreationViewHeader'] = "Druckerei anlegen";
				}
				?>
			</div>
		<div class="col-md-3">
			<input type="text" id="searchTerm" class="form-control"
				onkeyup="search()" placeholder="Suche Druckerei.." />
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="table-responsive">
				<table id="dataTable" class="table  table-bordered sortable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Druckereiname</th>
							<th>Erstellungsdatum</th>
							<th>Erstellt von</th>
							<th>Status</th>
							<th>Aktion</th>
						</tr>
					</thead>
					<tbody id="table_body">
			<?php
			foreach ( $printers as $printer ) {
				
				echo "<tr class='searchable'>";
				echo "<td>" . $printer->prsu_id . "</td>";
				echo "<td>" . $printer->adre_name . "</td>";
				echo "<td>" . $printer->prsu_createdon . "</td>";
				echo "<td>" . $printer->user_firstname . " " . $printer->user_name . "</td>";
				// echo "<td>" . $printer->prsu_createdby . "</td>";
				switch ($printer->prsu_status) {
					case 1 :
						echo "<td> Aktiv </td>";
						break;
					case 2 :
						echo "<td> Gelöscht </td>";
						break;
				}
				echo "<td>";
				
				if ($printer->prsu_status == 1) {
					echo btnEdit ( $printer );
					echo btnDelete ( $printer );
					echo btneditprinter ( $printer );
				} elseif ($printer->prsu_status == 2) {
					echo btnRecycle ( $printer );
				}
				echo "</td>";
				echo "</tr>";
			}
			function btnDelete($printer) {
				return "<a class='btn btn-danger' data-toggle='modal' data-target='#delete' title='Druckerei \"" . $printer->adre_name . "\" löschen' aria-label='delete' onclick='whichPrinterDelete(\"" . $printer->adre_name . "\", \"" . $printer->prsu_id . "\", \"" . $printer->prsu_email . "\")';><i class='fa fa-trash-o fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			function btnRecycle($printer) {
				return "<a class='btn btn-info' data-toggle='modal' data-target='#recycle' title='Druckerei \"" . $printer->adre_name . "\" aktivieren' aria-label='edit' style='margin-right:1rem' onclick='whichPrinterRecycle(\"" . $printer->adre_name . "\", \"" . $printer->prsu_id . "\", \"" . $printer->prsu_email . "\")';><i class='fa fa-recycle fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			function btnEdit($printer) {
				// echo "<a href='" . base_url () . "printers/editPrinter/' class='btn btn-info' title='Druckerei \"" . $printer->adre_name . "\" bearbeiten' aria-label='edit' style='margin-right:1rem' onclick='whichPrinterEdit(\"" . $printer->adre_name . "\", \"" . $printer->prsu_id . "\", \"" . $printer->prsu_email . "\")';><i class='fa fa-pencil fa-lg' aria-hidden='True' style='color:white;'></i></a>";
				// echo '<a href="' . base_url () . 'admin/printers_creation/"
				// class="btn btn-primary" role="button" href="printers_creation"> <i
				// class="fa fa-plus-square fa-lg"></i> Druckerei anlegen</a>';
				return "<a class='btn btn-info' data-toggle='modal' data-target='#edit' title='Druckerei \"" . $printer->adre_name . "\" bearbeiten' aria-label='edit' style='margin-right:1rem' onclick='whichPrinterEdit(\"" . $printer->adre_name . "\", \"" . $printer->prsu_id . "\", \"" . $printer->prsu_email . "\")';><i class='fa fa-pencil fa-lg' aria-hidden='True' style='color:white;'></i></a>";
			}
			function btneditprinter($printer) {
				echo form_open ( "Printers/showPrinterPrice/" . $printer->prsu_id );
				echo "<button class='btn btn-info' name='submit' type='submit' title='Printer: \"" . $printer->adre_name . "\" bearbeiten' aria-label='delete' >
			<i class='fa fa-building fa-lg' aria-hidden='True' style='color:white;'></i>
			</button>";
				echo form_close ();
			}
			// function btneditprinter($printer) {
			// // echo form_open ( "Printers/showPrinterPrice/" . $printer->prsu_id );
			// // redirect ( "Printers/showPrinterPrice/" . $printer->prsu_id );
			// // "<a href=( 'Printers/showPrinterPrice/' . $printer->prsu_id )></a>";
			// echo "<button class='btn btn-info' name='submit' type='submit' title='Printer: \"" . $printer->adre_name . "\"
			// bearbeiten' aria-label='delete' onClick='redirect(Printers/showPrinterPrice/\"" . $printer->prsu_id . "\")';>
			
			// <i class='fa fa-building fa-lg' aria-hidden='True' style='color:white;'></i>
			// </button>";
			// // echo form_close ();
			// }
			?>
			</tbody>
				</table>

			</div>
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-12 offset-md-5">
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
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<h4 class="modal-title custom_align" id="Heading">Druckerei löschen?</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-warning-sign"> </span>Möchten Sie
					die Druckerei "<span id="printerDelete"></span>" unwiderruflich löschen?
				</div>
			</div>
			<div class="modal-footer ">
				<form
					action="<?php
					
					echo base_url ();
					?>printers/deletePrinter/"
					method="post">
					<input id="printerDelete_hidden_field" type="hidden"
						name="printerDelete_hidden_field" value="">
					<button type="submit" class="btn btn-danger">
						<span class="glyphicon glyphicon-ok-sign"></span>Druckerei löschen
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span>Abbrechen
					</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>




<div class="modal fade" id="recycle" tabindex="-1" role="dialog"
	aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<h4 class="modal-title custom_align" id="Heading">Druckerei wiederherstellen?</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-warning-sign"> </span>Möchten Sie
					die Druckerei "<span id="printerRecycle"></span>" wiederherstellen? 
				</div>
			</div>
			<div class="modal-footer ">
				<form
					action="<?php
					
					echo base_url ();
					?>printers/recyclePrinter/"
					method="post">
					<input id="printerRecycle_hidden_field" type="hidden"
						name="printerRecycle_hidden_field" value="">
					<button type="submit" class="btn btn-danger">
						<span class="glyphicon glyphicon-ok-sign"></span>Druckerei wiederherstellen
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span>Abbrechen
					</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog"
	aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<h4 class="modal-title custom_align" id="Heading">Druckerei bearbeiten?</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-warning-sign"> </span>Möchten Sie
					die Druckerei "<span id="printerEdit"></span>" bearbeiten?
				</div>
			</div>
			<div class="modal-footer ">
				<form
					action="<?php
					
					echo base_url ();
					?>printers/editPrinter/"
					method="post">
					<input id="printerEdit_hidden_field" type="hidden"
						name="printerEdit_hidden_field" value="">
					<button type="submit" class="btn btn-danger">
						<span class="glyphicon glyphicon-ok-sign"></span>Druckerei bearbeiten
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span>Abbrechen
					</button>
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

    function whichPrinterDelete(name, id){
        document.getElementById("printerDelete").innerHTML = name;
        document.getElementById("printerDelete_hidden_field").value = id;
    }
    function whichPrinterRecycle(name, id){
        document.getElementById("printerRecycle").innerHTML = name;
        document.getElementById("printerRecycle_hidden_field").value = id;
    }
    function whichPrinterEdit(name, id){
        document.getElementById("printerEdit").innerHTML = name;
        document.getElementById("printerEdit_hidden_field").value = id;
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
