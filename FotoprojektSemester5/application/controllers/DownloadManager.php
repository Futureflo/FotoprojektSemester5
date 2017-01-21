<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname(__FILE__) . "/Product.php");

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
	public function manageDownload($orderID) {
// 		$pathArray = orderIDtoImagePathArray($orderID);
// 		$zipPath =  zipDir($pathArray);
// 		$downloadLink = createDownloadLink($orderID, $userID);
// 		return $downloadLink;
// 		$this->load->model('order_model');
// 		// Zip passwortschützen
// 		$mySalt = generate_salt();
// 		echo $mySalt;	
// 		$userID = $this->session->userdata('user_id');
// 		$products = $this->order_model->getProductsFromOrder($orderID);
// 		foreach ($products as $p)    {
// 			$path = Product::buildFilePath($p);
// 			$p->prod_filepath = $path;
// 		}
// 		$pfade = array(
// 				"path" => " "
// 		);
// 		foreach ($products as $p)    {
// 			$path = Product::buildFilePath($p);
// 			$p->prod_filepath = $path;
// 			array_push($pfade, $p->prod_filepath);
// 		}
		
// 		$zipPath = zipDir($userID, $orderID, $products);
		
		$this->load->model('order_model');
		$this->load->helper('hash_helper');
		$this->load->model('Download_Password_model');
		
		$downloadLink = $this->createDownloadLink($orderID);
		$userEmail = $this->session->userdata ( 'user_email' );
		$this->sendDownloadEmail($userEmail, $downloadLink);
	}
	
	/**
	 * 
	 * Mehtode um einen sicheren und einzigartigen downloadlink zu erstellen. Das Passwort wird in der Datenbank auf die OrderID referenziert.
	 * Die Methode wird aufgerufen um eine Order "downloadbar" zu machen. Dabei wird dem Nutzer ein Downloadlink, der das PW enthält per Email zugesendet. 
	 * Der Link ist nur ein einziges mal aufrufbar, da danach das Passwort in der Datenbank als benutzt gesetzt wird.
	 * 
	 * @param unknown $orderID
	 */
	public function createDownloadLink($orderID) {
		// load helper for generating new salt(simple random integer)
		$this->load->helper ( array (
				'hash_helper'
		) );
		
		$this->load->model('Download_Password_model');
		$downloadPasswordArray = $this->Download_Password_model->getDownloadPasswords();
		
		$download_password = generate_salt (30);
		
		// check if this new $download_password already exists or is a new one(shall be unique).
		// generates new $download_password until a new unique one is found.
		while($this->existsInArray($download_password, $downloadPasswordArray))
		{
			$download_password = generate_salt (30);
		}

		// create a new tupel
		$data = array (
				'dopa_password' => $download_password,
				'dopa_orde_id' => $orderID,
				'dopa_status' => 0,			// status == already downloaded with this password. 0=no, 1=yes.	
		);
		
		// Produkt einfügen
		$new_dopa_id = $this->Download_Password_model->insertDownloadPassword ( $data );
		
		$webPageURL = "http://snap-gallery.de/DownloadManager/startDownload/";
		$downloadLink = $webPageURL . $download_password;
		return $downloadLink;
	}
	
	
	function sendDownloadEmail($user_email, $downloadLink){
		$this->load->library('email');
	
		$this->email->from('noReply@snapUp.de', 'SnapUp');
		$this->email->to($user_email);
		$this->email->subject('Ihr Download-Link zu Ihrer Bestellung');
		$this->email->message(
				'SnapUp wünscht Ihnen viel Spaß mit Ihren Bildern.\n\n'
				.'Im Folgenden finden Sie Ihren persönlichen einzigartigen Download-Link, der einmalig nutzbar ist.\n'
				.'Für weitere Downloads rufen Sie einafach Ihre Bibliothek bei SnapUp auf und fordern einen neuen Download an.\n\n'
				. $downloadLink. '\n\n'
				.'Ihr Snapup-Team.'
				);
		$this->email->send();
	}
	
	/**
	 * Method to start the Download of a zipfile. This Method checks the integrity of the download call and initiaties if positive.
	 */
	public function startDownload(){
// 		echo "<br>DEBUG: step into startDownload() /DEBUG<br>"; // DEBUG
		$this->load->model('Download_Password_model');
		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$path_parts = pathinfo($url);
		$downloadPasswordArray = $this->Download_Password_model->getDownloadPasswords();
		
		// sent passwort is url-addition --> $path_parts['basename'];
		if($this->existsInArray($path_parts['basename'], $downloadPasswordArray) == true){
			// downloadprocess
			$this->load->model('order_model');
			$entry = $this->Download_Password_model->getDownloadPasswordEntryByPassword($path_parts['basename']);
			$orderID = $entry[0]->dopa_orde_id;
			$products = $this->order_model->getProductInformationByOrderId($orderID);

			// create the zip File with all pictures from the order
			$downloadableZipFile = $this->zipDir($orderID, $products);
			
			// download the created zip File
			downloadFile($downloadableZipFile);
			
			// path to new zipFile: echo $downloadableZipFile;
		}// else $this->session->set_flashdata ( 'msg', 'Datensatz existiert nicht.' );
// 		echo "<br>DEBUG: step out startDownload() /DEBUG<br>"; // DEBUG
	}
	
	private function checkDownloadPasswordIntegrity($filePath) {
		$result = false;
		return $result;
	}
	

	/**
	 * Method to actually force the local machine to downlaod the file given im parameter as basename.extension
	 * @param unknown $filePath (for example: PDF_Name.pdf).
	 */
	public function downloadFile($filePath) {
// http://localhost/FotoprojektSemester5/FotoprojektSemester5/downloadmanager/downloadfile/Download_Zip_Archive_1_1_20161223140213.zip

		while (ob_get_level()) {
			ob_end_clean();
		}
		ob_start();
		
		$sourcePathPrefix = "ImagesDownloadZips/";
		$conjunctedPath = join('/', array(trim($sourcePathPrefix, '/'), trim($filePath, '/')));
		
		// Header Informationen
		header( "Content-Type: application/force-download" );
// 		header('Content-type: application/zip');
		header( "Content-Disposition: attachment; filename=" .$filePath );
		header( "Content-Length: " . filesize($conjunctedPath) );
		
// 		$fp = fopen($conjunctedPath, "r");
// 		fpassthru($fp);
// 		fclose($fp);
		
		ob_flush();
		ob_clean();
		readfile($conjunctedPath);

		exit;
		redirect("/");
// 		return true;
	}
	
	/**
	 * cheks if the password already exists
	 * @param unknown $testArray
	 */
	public function existsInArray($checker, $testArray) {
		$result = false;
		for ($i = 0; $i < count($testArray); $i++) {
			if($checker == $testArray[$i]->dopa_password){
				$result = true;
			}
		}
		// echo $result;
		return $result;
	}
	
	/**
	 * Unravels the cryptic downloadlink into a simple path where the zip-archiv is stored.
	 * @param unknown $downloadLink
	 * @return zipPath
	 */
	public function getZipArchiveByDownloadLink($downloadLink) {
		// methode zum auflösen des downloadlinks zu einem auffindbaren zipPfad
		return $zipPath;
	}
	
	/**
	 * Zips a new archive file containing files from given arary. Autor: Severin Klug.
	 * @param  integer $orderID = OrderID ist referenziert auf bilder.
	 * @param array $productsArray = Zielordner des Zip Archives.
	 */
	public function zipDir($orderID, array $productsArray) {
// 		echo "<br>DEBUG: step into zipDir() /DEBUG<br>"; // DEBUG
		// TODO: checken ob ziel und quellordner existieren
		$this->load->model('order_model');
		$this->load->helper('hash_helper');
		
		// Zielordner
		$outZipFolder = "ImagesDownloadZips"; // TODO: erstellen, wenn nicht existiert
		
		// Instanziiert Zip Archiv
		$zipArchive = new ZipArchive();
		
		// name für das Zip Archiv
		// dateiname = userID, orderID, datum, uhrzeit
		$myDate = date('omdGis');
		$zipFileName = "Download_Zip_Archive_". $orderID  ."_". $myDate .".zip";
		
		// Zip Archiv Name wird an Pfad aus parameter2 angehängt
		$outZipPath = $outZipFolder ."/". $zipFileName;
		
		// Zip Archiv in Ordnerstruktur erstellen und öffnen
		if ($zipArchive->open($outZipPath, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$outZipPath>\n");
		}
		
// 		echo "größe: ". count($productsArray) ."<br>";
		// Alle Pfade aus dem Array (Parameter1) abarbeiten und datein dem Zip Archiv hinzufügen
		for ($i = 0; $i < count($productsArray); $i++) {
			// name der hinzugefügten Datei wird ursprungs
			// zurück steppen (aus Projektordner heraus) & in ordner Images steppen
			$pathComplete = Product::buildFilePath($productsArray[$i]);
// 			echo "pfad: ". $pathComplete ."<br>";
			$path_parts = pathinfo($pathComplete);
// 			echo "name: ". $path_parts['basename'] ."<br>";
			$conjunctedPath = join('/', array(trim("../", '/'), trim($pathComplete, '/')));
// 			$zipArchive->addFile("../". $pathComplete, $path_parts['basename']);
			$zipArchive->addFile($conjunctedPath, $path_parts['basename']);
		}
// 		if(count($productsArray)==0){
// 			echo "empty product array";
// 		}
		// Zip Archiv schließen
		$zipArchive->close();
// 		echo "<br>DEBUG: step out zipDir() /DEBUG<br>"; // DEBUG

// 		return $outZipPath;	
		return $zipFileName;
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
		echo "<br>testing 123 <br>";
		$this->load->model('order_model');
		$this->load->helper('hash_helper');
		$this->load->model('Download_Password_model');
// // 		$products = $this->order_model->getProductInformationByOrderId(39);
// // 		echo $products[0]->prod_name;
// // // 		$this->zipDir(1, $products);
// // // 		$this->createDownloadLink(1);
// // // 		$this->createDownloadLink(39);
// // 		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
// // 		echo $url;
// 		$sourcePathPrefix = "/hallo/abc/de/";
// 		$filePath = "/fg/x.php";
// 		$conjunctedPath = join('/', array(trim($sourcePathPrefix, '/'), trim($filePath, '/')));
// 		echo $conjunctedPath;
		
// 		$passwordLink = $this->createDownloadLink(39);
// 		echo "<br>link: ". $passwordLink;
		
		$products = $this->order_model->getProductInformationByOrderId(39);
		$zipPath = $this->zipDir(39, $products);
		echo "<br>zipPath: ". $zipPath;
		
// 		$this->downloadFile($zipPath);

	}
	
	public function liveTest(){
		echo "<br>testing 123 <br>";
		$this->load->model('order_model');
		$this->load->helper('hash_helper');
		$this->load->model('Download_Password_model');
		
// 		$downloadLink = $this->createDownloadLink(39);
// 		$this->sendDownloadEmail("Severin.Klug@gmx.de", $downloadLink);
		
		
		$this->downloadFile("Download_Zip_Archive_39_20170119103947.zip");
		redirect('/');	
	}
	
}

?>

