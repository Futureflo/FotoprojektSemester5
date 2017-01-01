
<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
	<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar" aria-controls="exCollapsingNavbar"
		aria-expanded="false" aria-label="Toggle navigation"></button>
	<div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar">
		<a class="navbar-brand" href="<?php
		echo base_url ();
		?>">FPS5</a>
		<ul class="nav navbar-nav">


			<li class="nav-item dropdown" aria-labelledby="exCollapsingNavbar"><a class="nav-link dropdown-toggle" href="http://example.com"
				id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
				<div class="dropdown-menu dropdown-menu-admin" aria-labelledby="supportedContentDropdown">
					<a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/">Dashboard</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/users/">Alle Benutzer</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/archivedUsers/">Benutzer Archiv</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/events/">Alle Events</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>admin/printers/">Alle Druckereien (System)</a> <a class="dropdown-item"
						href="<?php
						
						echo base_url ();
						?>admin/product_types/">Alle Formate</a> <a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>admin/price_profiles/">Alle Preisprofile</a>

				</div></li>



			<li class="nav-item dropdown aria-labelledby="exCollapsingNavbar""><a class="nav-link dropdown-toggle" href="http://example.com"
				id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
				<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
					<a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>user/">Benutzereinstellungen</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>user/1/">Einzelner Benutzer</a> <a class="dropdown-item" href="<?php
					
					echo base_url ();
					?>user/myOrders">Meine Bestellungen</a>
				</div></li>




			<!-- 		<li class="nav-item"><a class="nav-link" 
			href="<?php
			
			echo base_url ();
			?>picture/asd/"><i class="fa fa-camera" aria-hidden="true"></i> Einzelnes Bild <i class="fa fa-picture-o" aria-hidden="true"></i></a></li>
		
	 		<li class="nav-item"><a class="nav-link" 
			href="<?php
			
			echo base_url ();
			?>printers/">Eigene Druckereien</a></li> -->


			<div class="float-md-right">

				<li class="nav-item active "><a class="nav-link" href="<?php
				
				echo base_url ();
				?>">Home <span class="sr-only"></span></a></li>

				<li class="nav-item "><a class="nav-link" href="<?php
				
				echo base_url ();
				?>">Fotograf</a></li>

				<li class="nav-item dropdown "><a class="nav-link dropdown-toggle" href="http://example.com" id="supportedContentDropdown" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">Event</a>
					<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
						<a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>event/">Neues Event</a> <a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>event/aFqS/">Einzelnes Event</a> <a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>event/kksd/">Falsches Event</a>
					</div></li>

				<li class="nav-item"><a class="nav-link" href="<?php
				
				echo base_url ();
				?>checkout/"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>

				<!-- <li><p class="nav-item nav-link">Hallo <?php
				
				echo $this->session->userdata ( 'uname' );
				?></p></li>  -->

				<li class="nav-item active "><a class="active" href="<?php
				
				echo base_url ();
				?>user/logout"><button type="button" class="nav-link btn btn-primary btn-md">Abmelden</button></a></li>
			</div>

		</ul>
	</div>
</nav>

<script>
$('ul.nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu-admin').stop(true, true).delay(200).fadeIn(200);
	}, function() {
	  $(this).find('.dropdown-menu-admin').stop(true, true).delay(200).fadeOut(200);
	});
</script>

