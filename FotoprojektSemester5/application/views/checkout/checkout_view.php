
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Ihr Warenkorb</h1>
		<p class="lead text-muted">Hier können Sie Größe und Anzahl Ihrer Bilder bestimmen, oder diese aus dem Warenkorb entfernen.
		</p>
		
	</div>
	</section>
<div class="container">

								<div class="row">
									<div class="col-sm-2 col-xs-6">
									<img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>
									</div>
									<div class="col-sm-5 col-xs-6">
										 <ul style="list-style-type:none">
										 <li><h6>Bild 1</h6></li>
										 <li>Veranstaltung</li>
										 <li>Größe: X</li>
										 <li>Digital/Analog</li>
										 <li><h6>Einzelpreis: <i id="einzelpreis">1.99</i>€</h6></li>
										 </ul> 
									</div>
									<div class="col-sm-1">
									<h5>Anzahl:</h5></div>
							 <div class="form-group col-sm-2">
                        <p><input type="text" class="form-control" id="anzahl" onchange="preisaktualisieren()"></p>								
							</div>
							<div class="col-sm-1">
							<p></p>
							<h5>Preis</h5> <i id="aktuellerpreis">1.99€</i>
							</div>
							<div class="col-sm-1">
							<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></div>
							</div>
						<hr />	
						<div class="row">
						<div class="col-sm-0 col-s-0"></div>
						<div class="col-sm-2 col-xs-10">
						<h6>Nettopreis:</h6>
						<h6>Mehrwertsteuer(19%):</h6>
						<h6>Versandkosten:</h6>
						<h5>Gesamtpreis:</h5>
							</div>
						<div class="col-sm-1 col-xs-2">
						<h6><i id="nettopreis">1.62€</i></h6>
						<h6 id="mehrwertsteuer">0.38€</h6>
						<h6 id="versandkosten">1.00€</h6>
						<h5 id="Gesamtpreis">2.99€</h5>
						</div>	
						</div>	
						<div class="row">
							<div class="col-sm-9 col-s-12">
							</div>
							<div class="col-sm-3 col-s-12"><a href="#" class="btn btn-success btn-block">Zur Kasse<i class="fa fa-angle-right"></i></a>
							</div>
						</div>
			<hr />
				
</div>
<script>

function preisaktualisieren()
{
var einzelpreis = document.getElementById("einzelpreis").innerHTML;
var anzahl = document.getElementById("anzahl").value;

if (anzahl < 1) {
    document.getElementById("anzahl").value = 1;
} else if (isNaN(anzahl)) {
	document.getElementById("anzahl").value = 1;
} else {
	document.getElementById("aktuellerpreis").innerHTML = parseFloat(einzelpreis)*parseFloat(anzahl) + "€";
} 
}


function nettopreis()
{
var aktuellerpreis = document.getElementById("aktuellerpreis").innerHTML;
document.getElementById("nettopreis").innerHTML = aktuellerpreis*0.81 + "€";
}

/*
function mehrwertsteuer()
{
var aktuellerpreis = document.getElementById("aktuellerpreis").innerHTML;
}

function gesamtpreis()
{
}
*/

</script>