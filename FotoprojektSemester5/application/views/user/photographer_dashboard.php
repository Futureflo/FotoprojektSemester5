<head>
<!-- styles for this little demo page -->
        <style type="text/css">

            body{
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            }

            .page {
                margin: 40px;
            }

            h1{
                margin: 40px 0 60px 0;
            }

            .dark-area {
                background-color: #666;
                padding: 40px;
                margin: 0 -40px 20px -40px;
                clear: both;
            }

            .clearfix:before,.clearfix:after {content: " "; display: table;}
            .clearfix:after {clear: both;}
            .clearfix {*zoom: 1;}

        </style>
<link rel="stylesheet" href="../../css/circle.css">
</head>
<body>

<section style="padding-top: 70px">
	<div class="container">
		<?php
		if (isset ( $message )) {
			echo "<div class='alert alert-danger'>";
			echo $message . "</div>";
		}
		?>
</div>
</section>

<div class="container">
		<div class="col-md-7">
			<p class="h1" id="test" onclick="setPager()">
			<?php
			echo 'Mein Abo: ' . $abo->abof_name;
			?>
			</p>
			<p class="h3">
			<?php
			
			echo 'Verwendeter Speicherplatz: ' . $size->prod_filesize . ' / ' . $abo->abof_space . ' MB';
			
			?>
			</p>
		</div>
		<div class="col-md-7">
						<div class="clearfix">
						<?php
						$perc = round ( $size->prod_filesize / $abo->abof_space * 100, 0 );
						
						echo '<div class="c100 p' . $perc . ' big">';
						
						echo '<span>' . $perc . '%</span>'?>
			                    <div class="slice">
			                        <div class="bar"></div>
			                        <div class="fill"></div>
			                    </div>
                			</div>
            			</div>
		</div>
				

				</div>