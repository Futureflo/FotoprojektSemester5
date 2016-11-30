
<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
	<a class="navbar-brand" href="#">FPS5</a>
	<ul class="nav navbar-nav">
		<li class="nav-item active"><a class="nav-link"
			href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item"><a class="nav-link"
			href="<?php echo base_url();?>user/">Benutzer&uuml;bersicht</a></li>
		<li class="nav-item"><a class="nav-link" href="#">Dummy</a></li>
		<li class="nav-item"><a class="nav-link" href="#">Dummy</a></li>
		<li class="nav-item"><a class="nav-link" href="#">Dummy</a></li>
		<?php if ($this->session->userdata('login')){ ?>
		
		<li><p class="nav-item">Hello <?php echo $this->session->userdata('uname'); ?></p></li>
				<li class="nav-item"><a href="<?php echo base_url(); ?>user/logout">Log Out</a></li>
				<?php } else { ?>
				<li class="nav-item"><a href="<?php echo base_url(); ?>login">Login</a></li>
				<li class="nav-item"><a href="<?php echo base_url(); ?>signup">Signup</a></li>
				<?php } ?>
	</ul>
</nav>

