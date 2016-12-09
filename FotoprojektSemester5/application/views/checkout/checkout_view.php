
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Ihr Warenkorb</h1>
		<p class="lead text-muted">Hier können Sie Größe und Anzahl Ihrer Bilder bestimmen, oder diese aus dem Warenkorb entfernen.
		</p>
		
	</div>
	</section>
<div class="container">

								<div class="row">
									<div class="col-sm-3">
									<img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>
									</div>
									<div class="col-sm-3">
										<h5>Bild 1</h5>
										<p class="hidden-sm-down">Veranstaltung
										Fotograf</p>
										<h6>Einzelpreis: <i id="einzelpreis">1.99</i>€</h6>
									</div>
									<div class="col-sm-2">
									<h5>Größe</h5>
									<p>
									<h5>Anzahl</h5></div>
							 <div class="form-group col-sm-3">
                <select id="Grösse" class="form-control">
                    <option>XS</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                </select>
                        <p><input type="number" class="form-control" id="anzahl" onclick="preisaktualisieren()"></p>
								<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
								<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
							</div>
							<div class="col-sm-1">
							<p></p>
							<h5>Preis</h5> <i id="aktuellerpreis">1.99€</i>
							</div>
							</div>
						<div class="row">
							<div class="col-sm-7 col-s-12"><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Weitershoppen</a>
							</div>
							<div class="col-sm-2 col-s-12"><strong>Gesamtpreis 1.99€</strong>
							</div>
							<div class="col-sm-3 col-s-12"><a href="#" class="btn btn-success btn-block">Zur Kasse<i class="fa fa-angle-right"></i></a>
							</div>
						</div>
			
				
</div>
<script>

function preisaktualisieren()
{
var einzelpreis = document.getElementById("einzelpreis").innerHTML;
var anzahl = document.getElementById("anzahl").value;

document.getElementById("aktuellerpreis").innerHTML = parseFloat(einzelpreis)*parseFloat(anzahl) + "€";
}

</script>