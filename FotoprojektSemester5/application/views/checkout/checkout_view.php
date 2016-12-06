
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Ihr Warenkorb</h1>
		<p class="lead text-muted">Hier können Sie Größe und Anzahl Ihrer Bilder bestimmen, oder diese aus dem Warenkorb entfernen.
		</p>
		
	</div>
</section>
<div class="container">
<div style="overflow-x:auto;">
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr class="hidden-xs-down">
							<th style="width:50%">Produkt</th>
							<th style="width:10%">Preis</th>
							<th style="width:8%">Größe</th>
							<th style="width:22%" class="text-center">Anzahl</th>
							<th style="width:10%">Preis</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-3">
									<img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>
									</div>
									<div class="col-sm-3">
										<h4>Bild 1</h4>
										<p class="hidden-sm-down">Veranstaltung</p>
										<p class="hidden-sm-down">Fotograf</p>
									</div>
								</div>
							</td>
							<td class="col-sm-1" data-th="Price">1.99€</td>
							<td data-th="Größe">
								 <div class="dropdown row">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Größe
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                        <li><a href="#">XS</a></li>
                        <li><a href="#">S</a></li>
                        <li><a href="#">M</a></li>
                        <li><a href="#">L</a></li>
                        <li><a href="#">XL</a></li>
                        </ul>
                        </div>
                        </td>
   							<td data-th="Anzahl">
								<input type="number" class="form-control text-center">
							</td>
							<td data-th="Subtotal" class="text-center">1.99€</td>
							<td class="actions" data-th="">
								<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
								<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td class="hidden-sm-down"><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Weitershoppen</a></td>
							<td colspan="2"></td>
							<td class="text-center"><strong>Gesamtpreis 1.99€</strong></td>
							<td><a href="#" class="btn btn-success btn-block">Zur Kasse<i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
				</div>
</div>
