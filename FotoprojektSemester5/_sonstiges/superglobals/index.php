<html>
<body>
<?php
	if(isset($_GET["vorname"])){
		echo "<h3>Hallo " . $_GET["vorname"] . " " . $_GET["nachname"] .  "</h3>";
	}

	if(isset($_POST["feld1"])){
		echo "<h3>POST &Uuml;bertragung hat funktioniert</h3>";
		echo "<p>Feld 1: ". $_POST["feld1"]."</p>";
		echo "<p>Feld 2: ". $_POST["feld2"]."</p>";
	}
?>
<form action="index.php" method="post">
Feld1: <input type="text" name="feld1" value="<?php echo (isset($_POST["feld1"]) ? $_POST["feld1"] : '');?>"><br>
<input type="hidden" name="feld2" value="3"><br> <!- z.B. für userid ->
<input type="submit" value="absenden">
</form>

<a href="?vorname=Peter&nachname=Maier">GET Test</a>

</body>
</html>