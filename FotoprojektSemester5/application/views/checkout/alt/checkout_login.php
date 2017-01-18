<section class="jumbotron text-xs-center" style="padding-bottom: 1rem">
	<div class="container">
		<h1 class="jumbotron-heading">Ihre Bestellung</h1>
		<p class="lead text-muted">Anmelden</p>

		<p>
			<a onclick="login()" href="#" class="btn btn-primary">Anmelden</a> <a href="<?php
			echo base_url ()?>checkout/guest" class="btn btn-secondary">Als Gast bestellen</a>
		</p>
	</div>
</section>

<script>
	function login(){
		document.getElementById("login-btn").click();
	}
</script>