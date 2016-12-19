<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class DownloadManager extends CI_Controller {


	public function index() {
		echo "indexseite des DownloadManager";
	}
	
	/*
	 * - Nutzer wählt Bilder zum Kauf aus.
	 * - Bilder liegen im Warenkorb.
	 * - Sobald "gekauft" wird, wird aus den Bildern im Warenkorb eine Order erstellt
	 * - Die Order enthält alle Bilder-IDs und wird in der Datenbank abgelegt.
	 * - Es wird ein individueller Downloadlink zur Verfügung gestellt.
	 * - Der Aufruf des Downloadlinks erstellt eine Zip und läd diese herunter.
	 * - Der Link muss entsprechend auf die Order in der Datenbank verweisen.
	 * - Die Zip-Funktion erhält also die Info für die zu zippende Order aus dem Link.
	 *
	 */
	
	/**
	 * Method to unpack Zip.
	 * #Author: Severin
	 */
	public function unpackZip($sourcePath) {
		echo "allright";
	}
	
	public function setImageArray(){
		$this->session->set_flashdata('arrayImages', '/*get Images and pack them into an array*/');
	}
	
	////////////////////////////////////////////////////////////////////
	// TEST SECTION //
	////////////////////////////////////////////////////////////////////
	
	/**
	 * Metod to convert a paid order from customers cart into a downloadlink.
	 * @param unknown $orderID
	 * @return downloadLink
	 */
	public static function manageDownload($orderID) {
		$pathArray = orderIDtoImagePathArray($orderID);
		$zipPath =  zipDir($pathArray);
		$downloadLink = createDownloadLink($orderID, $userID);
		return $downloadLink;
	}
	
	
	public static function createDownloadLink($orderID, $userID) {
		// Mehtod um einen sicheren und einzigartigen downloadlink zu erstellen
		// soll orderID und nutzerID enthalten sowie "verschlüsselung"
	}
	
	/**
	 * Unravels the cryptic downloadlink into a simple path where the zip-archiv is stored.
	 * @param unknown $downloadLink
	 * @return zipPath
	 */
	public static function getZipArchiveByDownloadLink($downloadLink) {
		// methode zum auflösen des downloadlinks zu einem auffindbaren zipPfad
		return $zipPath;
	}
	
	/**
	 * Zips a new archive file containing files from given arary.
	 * @param array $imagePathArray = viele Quellpfade der zu zippenden Dateien.
	 * @param unknown $outZipFolder = Zielordner des Zip Archives.
	 */
	public function zipDir(array $imagePathArray, $outZipFolder) {
		// TODO: checken ob ziel und quellordner existieren
		// Instanziiert Zip Archiv
		$zipArchive = new ZipArchive();
		// name für das Zip Archiv
		$zipFileName = "myZip.zip";
		// Zip Archiv Name wird an Pfad aus parameter2 angehängt
		$outZipPath = "../". $outZipFolder ."/". $zipFileName;
		
		// Zip Archiv in Ordnerstruktur erstellen und öffnen
		if ($zipArchive->open($outZipPath, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$outZipPath>\n");
		}
		$readme = fopen("../Images/2016\December/liesmich.txt", "w") or die("Unable to open file!");
		$txt = "Liesmich";
		fwrite($readme, $txt);
		fclose($readme);
		// Alle Pfade aus dem Array (Parameter1) abarbeiten und datein dem Zip Archiv hinzufügen
// 		for ($i = 1; $i <= count($imagePathArray); $i++) {
// 			// zurück steppen (aus Projektordner heraus) & in ordner Images steppen
// 			// name der hinzugefügten Datei wird $i
// 			$zipArchive->addFile('../Images'. $imagePathArray[$i], $i);
// 		}
		$zipArchive->addFile("../Images/liesmich.txt", "liesmich");
		// Zip Archiv schließen
		$zipArchive->close();
		
	}
	
	public function test(){
		$pfade = array(
				1 => "\2016\December\001.png",
				2 => "\2016\December\002.jpg",
				3 => "/2016\December/liesmich.txt",
		);
		$this->zipDir($pfade, "ImagesDownloadZips");
	}
	
	/**
	 * Returns an Array containing all image-paths from the orderID.
	 * @param unknown $orderID
	 */
	public static function orderIDtoImagePathArray($orderID) {
		$this->load->database();
		$this->load->model('order_model');
		// Methode getOrderID result --> alle bildpfade geladen
		$uresult = $this->order_model->get_order($orderID);
		// neues array mit bildpfaden erstellen
		$imagePathArray = array();
		// return bildpfad array
		return $imagePathArray;
	}

}

?>