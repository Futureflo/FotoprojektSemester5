<?php

if(isset($_COOKIE["PHPSESSID"])){
	echo "<p>Session bereits vorhanden!</p>";
	session_start(); //sucht anhand der SESSION ID nach vorhandener Session, wenn keine vorhanden -> neue Session erstellen
	echo "<p>Willkommen zur&uuml;ck ". $_SESSION["name"] . "</p>";
	echo "<p>SessionID: ". $_COOKIE["PHPSESSID"] . "</p>";
}
else{
	session_start(); //sucht anhand der SESSION ID nach vorhandener Session, wenn keine vorhanden -> neue Session erstellen
	$_SESSION['name'] = "Testuser";
	echo "<p>Willkommen ". $_SESSION["name"] . "</p>";
	
}
?>