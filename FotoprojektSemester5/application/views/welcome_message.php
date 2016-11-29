<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="_sonstiges/bootstrap-4.0.0-alpha.5/dist/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
	
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	
	    <div class="container">
      <div class="row">

        <div class="col-md-7">
            
             <?php
            echo "<h1>Liste Entwickler mit Zugriff auf das Projekt</h1><br>";
            echo "<ul><li>Kai Kleefisch</li></ul>";
            echo "<ul><li>Florian Fay</li></ul>";
            echo "<ul><li>Alex</li></ul>";
            echo "<ul><li>Kai Bücking</li></ul>";
            echo "<ul><li>Severin Klug</li></ul>";
            echo "<ul><li>Tim Deisser</li></ul>";
            echo "<ul><li>Melanie Müller</li></ul>";
			echo "<ul><li>David Fankhänel</li></ul>";
			echo "<ul><li>Simone Gregg</li></ul>";
			echo "<ul><li>Raphael Fehrenbach</li></ul>";
        ?>
            
        </div>
         <div class="col-md-5">            
             <?php
            echo "<h1>Und hier die weiteren Entwickler</h1><br>";
            echo "<ul><li>Kai Kleefisch</li></ul>";
            echo "<ul><li>Florian Fay</li></ul>";
            echo "<ul><li>Alex</li></ul>";
            echo "<ul><li>Kai Bücking</li></ul>";
            echo "<ul><li>Severin Klug</li></ul>";
            echo "<ul><li>Tim Deisser</li></ul>";
            echo "<ul><li>Melanie Müller</li></ul>";
			echo "<ul><li>David Fankhänel</li></ul>";
			echo "<ul><li>Simone Gregg</li></ul>";
			echo "<ul><li><a href=\"_sonstiges\">Raphael Fehrenbach</a></li></ul>";
        ?>
            
        </div>
        
        
      </div>
      
    </div>    
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="_sonstiges/bootstrap-4.0.0-alpha.5/dist/js/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="_sonstiges/bootstrap-4.0.0-alpha.5/dist/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
	
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>