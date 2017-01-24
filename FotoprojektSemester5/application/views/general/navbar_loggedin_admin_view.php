
<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
	<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar" aria-controls="exCollapsingNavbar"
		aria-expanded="false" aria-label="Toggle navigation"></button>
	<div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar">
		<a class="navbar-brand" href="<?php
		echo base_url ();
		?>">SnapUp</a>
		<ul class="nav navbar-nav">
			<div class="float-sm-right">
				<li class="nav-item active ">
					<a class="nav-link" href="<?php
					echo base_url ();
					?>">Home <span class="sr-only"></span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php
					echo base_url ();
					?>admin/dashboard/">Dashboard 
					</a>
				</li>
				

						
				<li class="nav-item dropdown" aria-labelledby="exCollapsingNavbar">
					<a class="nav-link dropdown-toggle" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
					</a>
					<div class="dropdown-menu dropdown-menu-admin" aria-labelledby="supportedContentDropdown">
						<a class="dropdown-item" href="<?php
						echo base_url ();
						?>admin/users/">Benutzer</a>
							 
						<a class="dropdown-item" href="<?php
						echo base_url ();
						?>admin/events/">Events</a>
							 
						<a class="dropdown-item" href="<?php
						echo base_url ();
						?>admin/printers/">Druckereien (System)</a>
							 
						<a class="dropdown-item" href="<?php
						echo base_url ();
						?>admin/product_types/">Formate</a>
							 
						<a class="dropdown-item" href="<?php
						echo base_url ();
						?>admin/price_profiles/">Preisprofile</a>
							
						<a class="dropdown-item" href="<?php
						echo base_url ();
						?>admin/nele_users/">Benutzer Newsletter</a> 
						</div>
				</li>
				
				<li class="nav-item dropdown" aria-labelledby="exCollapsingNavbar"><a class="nav-link dropdown-toggle" href="http://example.com"
					id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archiv</a>
					<div class="dropdown-menu dropdown-menu-admin" aria-labelledby="supportedContentDropdown">
					
						 <a class="dropdown-item" href="<?php
							
							echo base_url ();
							?>admin/archivedUsers/">Benutzer</a> 
						 <a class="dropdown-item" href="<?php
							
							echo base_url ();
							?>admin/archivedEvents/">Event</a>
						 <a class="dropdown-item" href="<?php
							
							echo base_url ();
							?>admin/archivedPrinters/">Druckereien (System)</a> 
						 <a class="dropdown-item" href="<?php
							
							echo base_url ();
							?>admin/archivedProduct_types/">Formate</a> 
						 <a class="dropdown-item" href="<?php
							
							echo base_url ();
							?>admin/archivedPrice_profiles/">Preisprofile</a> 
	
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?php
					echo base_url ();
					?>shoppingcart/"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>
					</a>
				</li>

				<li class="nav-item active ">
					<a class="active" href="<?php
					echo base_url ();
					?>user/logout"><button type="button" class="nav-link btn btn-primary btn-md">Abmelden</button>
					</a>
				</li>
			</div>
		</ul>
	</div>
</nav>

<script>
$('ul.nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
	});
</script>

