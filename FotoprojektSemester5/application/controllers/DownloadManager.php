<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class DownloadManager extends CI_Controller {


	public function __construct() {
		parent::__construct ();
	}
	
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
	 * Metod to convert a paid order from customers cart into a downloadlink.
	 * @param unknown $orderID
	 * @return downloadLink
	 */
	public function manageDownload($userID, $orderID) {
// 		$pathArray = orderIDtoImagePathArray($orderID);
// 		$zipPath =  zipDir($pathArray);
// 		$downloadLink = createDownloadLink($orderID, $userID);
// 		return $downloadLink;
		$this->load->model('order_model');
		
		$userID = $this->session->userdata('user_id');
		$products = $this->order_model->getProductsFromOrder($orderID);
		
		foreach ($products as $p)    {
			$path = Product::buildFilePath($p);
			$p->prod_filepath = $path;
		}
		
		$pfade = array(
				"path" => " "
		);
		
		foreach ($products as $p)    {
			$path = Product::buildFilePath($p);
			$p->prod_filepath = $path;
			array_push($pfade, $p->prod_filepath);
		}
		
		zipDir($userID, $orderID, $products);
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
	 * Zips a new archive file containing files from given arary. Autor: Severin Klug.
	 * @param array $imagePathArray = viele Quellpfade der zu zippenden Dateien.
	 * @param unknown $outZipFolder = Zielordner des Zip Archives.
	 */
	public function zipDir($userID, $orderID, array $imagePathArray) {
		// TODO: checken ob ziel und quellordner existieren
		$this->load->model('order_model');
		$this->load->helper('hash_helper');
		
		// Zielordner
		$outZipFolder = "ImagesDownloadZips";
		
		// Instanziiert Zip Archiv
		$zipArchive = new ZipArchive();
		
		// name für das Zip Archiv
		// dateiname = userID, orderID, datum, uhrzeit
		$myDate = date('omdGis');
		$zipFileName = "Your_Zip_File_". $userID . $orderID . $myDate .".zip";
		
		// Zip Archiv Name wird an Pfad aus parameter2 angehängt
		$outZipPath = $outZipFolder ."/". $zipFileName;
		
		// Zip Archiv in Ordnerstruktur erstellen und öffnen
		if ($zipArchive->open($outZipPath, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$outZipPath>\n");
		}

		// Alle Pfade aus dem Array (Parameter1) abarbeiten und datein dem Zip Archiv hinzufügen
		for ($i = 0; $i < count($imagePathArray); $i++) {
			// name der hinzugefügten Datei wird ursprungs
			// zurück steppen (aus Projektordner heraus) & in ordner Images steppen
			$pathinfo = pathinfo($imagePathArray[$i]->path);
			$fileName = $pathinfo['filename'] .".". $pathinfo['extension'];
			$zipArchive->addFile('../'. $imagePathArray[$i]->path, $fileName);
		}
		
		// Zip passwortschützen
		$mySalt = generate_salt();
		echo $mySalt;
		$zipArchive->setPassword($mySalt);
// 		system('zip -P password file.zip file.txt');
// 		$zip->Password = $mySalt;
		
		// Zip Archiv schließen
		$zipArchive->close();
		
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
	
	public function test(){
		$this->load->model('order_model');
		$this->load->helper('hash_helper');
		$pfade = $this->order_model->getProductsFromOrder(1);
		$this->zipDir(1, 1, $pfade);
	}
	
}

?>

