
<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
	<a class="navbar-brand" href="#">FPS5</a>
	<ul class="nav navbar-nav">
		<li class="nav-item active"><a class="nav-link"
			href="<?php echo base_url();?>">Home <span class="sr-only"></span></a>
		</li>

		<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
			href="http://example.com" id="supportedContentDropdown"
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
			<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
				<a class="dropdown-item" href="<?php echo base_url();?>admin/">Dashboard</a>
				<a class="dropdown-item" href="<?php echo base_url();?>admin/users/">Alle
					Benutzer</a> <a class="dropdown-item"
					href="<?php echo base_url();?>admin/events/">Alle Events</a> <a
					class="dropdown-item"
					href="<?php echo base_url();?>admin/printers/">Alle Druckereien
					(System)</a>
			</div></li>

		<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
			href="http://example.com" id="supportedContentDropdown"
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Event</a>
			<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
				<a class="dropdown-item" href="<?php echo base_url();?>event/">Neues
					Event</a> <a class="dropdown-item"
					href="<?php echo base_url();?>event/aFqS/">Einzelnes Event</a> <a
					class="dropdown-item" href="<?php echo base_url();?>event/kksd/">Falsches
					Event</a>
			</div></li>

		<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
			href="http://example.com" id="supportedContentDropdown"
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
			<div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
				<a class="dropdown-item" href="<?php echo base_url();?>user/">Benutzereinstellungen</a>
				<a class="dropdown-item" href="<?php echo base_url();?>user/1/">Einzelner
					Benutzer</a>
			</div></li>




		<li class="nav-item"><a class="nav-link"
			href="<?php echo base_url();?>picture/asd/">Einzelnes Bild</a></li>
		<li class="nav-item"><a class="nav-link"
			href="<?php echo base_url();?>checkout/">Warenkorb</a></li>
		<li class="nav-item"><a class="nav-link"
			href="<?php echo base_url();?>printers/">Eigene Druckereien</a></li>




		<li><p class="nav-item">Hello <?php echo $this->session->userdata('uname'); ?></p></li>
		<li class="nav-item"><a href="<?php echo base_url(); ?>user/logout">Log
				Out</a></li>



	</ul>
</nav>

