
<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
	<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar" aria-controls="exCollapsingNavbar"
		aria-expanded="false" aria-label="Toggle navigation"></button>
	<div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar">
		<a class="navbar-brand" href="<?php
		echo base_url ();
		?>">SNAP-UP</a>
		<ul class="nav navbar-nav">


			<div class="float-sm-right">

				<li class="nav-item active "><a class="nav-link" href="<?php
				
				echo base_url ();
				?>">Home <span class="sr-only"></span></a></li>

				<li class="nav-item dropdown "><a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">Fotograf</a>
					<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
						<a class="dropdown-item" href="<?php
						
						?>event/uebersicht/">&Uuml;bersicht Events</a><a class="dropdown-item" href="<?php
						?>event/">Neues Event</a> <a class="dropdown-item" href="<?php
						
						echo base_url ();
						
						?>event/">&Uuml;bersicht Druckerei</a>
					</div></li>

				<li class="nav-item dropdown "><a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown"
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


				<li class="nav-item dropdown aria-labelledby="exCollapsingNavbar""><a class="nav-link dropdown" href="http://example.com"
					id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o fa-lg"
						aria-hidden="true"></i></a>
					<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
						<a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>user/1/">Benutzereinstellungen</a> <a class="dropdown-item" href="<?php
						
						echo base_url ();
						?>user/myOrders">Meine Bestellungen</a>
					</div></li>

				<li class="nav-item"><a class="nav-link" href="<?php
				
				echo base_url ();
				?>shoppingcart/"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>


				<li class="nav-item active "><a class="active" href="<?php
				
				echo base_url ();
				?>user/logout"><button type="button" class="nav-link btn btn-primary btn-md">Abmelden</button></a></li>
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

