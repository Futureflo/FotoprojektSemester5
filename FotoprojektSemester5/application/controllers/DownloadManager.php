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
	 * Zip a folder (include itself).
	 * Usage:
	 *   HZip::zipDir('/path/to/sourceDir', '/path/to/out.zip');
	 *   Source: http://php.net/manual/de/class.ziparchive.php
	 *
	 * @param string $sourcePath Path of directory to be zip.
	 * @param string $outZipPath Path of output zip file.
	 */
	// 	public static function zipDir($sourcePath, $outZipPath) {
	// 		$pathInfo = pathInfo($sourcePath);
	// 		echo $pathInfo;
	// 		$parentPath = $pathInfo['dirname'];
	// 		$dirName = $pathInfo['basename'];
	
	// 		$z = new ZipArchive();
	// 		$z->open($outZipPath, ZIPARCHIVE::CREATE);
	// 		$z->addEmptyDir($dirName);
	// 		self::folderToZip($sourcePath, $z, strlen("$parentPath/"));
	// 		$z->close();
	// 	}
	
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
	 * Returns zip-archive-path.
	 */
	public static function zipDir(array $imagePath) {
		$images = $this->session->flashdata('arrayImages');
		echo "sourcePath: ". $sourcePath;
		echo "</br>";
		echo "outZipPath: ". $outZipPath;
		// 		$pathInfo = pathInfo($sourcePath);
		// 		echo "pathInfo: ". $pathInfo;
		// 		$parentPath = $pathInfo['dirname'];
		// 		$dirName = $pathInfo['basename'];
	
		// 		$z = new ZipArchive();
		// 		$z->open($outZipPath, ZIPARCHIVE::CREATE);
		// 		$z->addEmptyDir($dirName);
		// 		self::folderToZip($sourcePath, $z, strlen("$parentPath/"));
		// 		$z->close();
		return $zipPath;
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