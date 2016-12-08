<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Zip extends CI_Controller {


	public function index() {
		echo "index //Zip";
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
	public static function zipDir($sourcePath, $outZipPath) {
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
	}

}

?>