
<section class="jumbotron text-xs-center">
	<div class="container">
		<h1 class="jumbotron-heading">Album example</h1>
		<p class="lead text-muted">Something short and leading about the
			collection below—its contents, the creator, etc. Make it short and
			sweet, but not too short so folks don't simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary">Main call to action</a> <a
				href="#" class="btn btn-secondary">Secondary action</a>
		</p>
	</div>
</section>

<!-- Modal -->
<div id="loginModal" class="modal-md fade modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">        
        
       
					<?php  $attributes = array("name" => "loginform");
							 echo form_open("login/", $attributes);?>
			
		                    <input type="text" class="form-control input-sm chat-input" placeholder="E-Mail-Adresse eingeben" name="user_email" value="<?php  echo set_value('user_email'); ?>"/>
		                    <span class="text-danger"><?php  echo form_error('user_email'); ?></span>
		                    </br>
		                    <input type="password" class="form-control input-sm chat-input" placeholder="Passwort eingeben" name="user_password" value="<?php  echo set_value('user_password'); ?>"/>
		                    <span class="text-danger"><?php  echo form_error('user_password'); ?></span>
		                    </br>
		                    <div class="container">
					            <div class="row">
					                <div class="col-md-6 offset-md-3">
		                    <div class="login-btn-wrapper">
		                    <span class="group-btn">    
		                    	<button name="submit" type="submit" class="btn btn-primary btn-md btn-block">Login</button>
		                    </span>
		                    </div>
		                    </div>
					            </div>
					       </div>
		                    <div class="container">
					            <div class="row">
					                <div class="col-md-8 offset-md-2">
					                    <a href="<?php echo base_url();?>PasswordReset/">Passwort vergessen?</a>
					                </div>
					            </div>
					       </div>
				<?php  echo form_close(); ?>
				<?php  echo $this->session->flashdata('msg'); ?>
				
				
		</div>
		
        
      <div class="modal-footer text-center">
       <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <button name="submit" type="submit" class="btn btn-success btn-md btn-block">Registrieren</button>
                </div>
            </div>
       </div>
      </div>
    </div>
    </div>
</div>

<div class="album text-muted">
	<div class="container">

		<div class="row">
			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c79%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c79%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>
			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c7b%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c7b%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>
			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c7d%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c7d%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>

			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c7e%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c7e%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>
			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c80%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c80%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>
			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c81%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c81%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>

			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c82%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c82%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>
			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c84%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c84%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer.</p>
			</div>
			<div class="card">
				<img data-src="holder.js/100px280/thumb" alt="100%x280"
					style="height: 280px; width: 100%; display: block;"
					src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c85%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c85%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
					data-holder-rendered="true">
				<p class="card-text">This is a wider card with supporting text below
					as a natural lead-in to additional content. This content is a
					little bit longer Kai Läuft.</p>
			</div>
		</div>

	</div>
</div>




<svg xmlns="http://www.w3.org/2000/svg" width="356" height="280"
	viewBox="0 0 356 280" preserveAspectRatio="none"
	style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;">
	<defs>
	<style type="text/css"></style></defs>
	<text x="0" y="18"
		style="font-weight:bold;font-size:18pt;font-family:Arial, Helvetica, Open Sans, sans-serif">356x280</text></svg>