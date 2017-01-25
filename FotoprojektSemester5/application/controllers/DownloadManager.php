<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Product.php");
class DownloadManager extends CI_Controller {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		echo "indexseite des DownloadManager";
	}
	
	/**
	 * Metod to convert a paid order from customers cart into a downloadlink.
	 *
	 * @param unknown $orderID        	
	 * @return downloadLink
	 */
	public function manageDownload($orderID) {
		// echo "<br>DEBUG: step into manageDownload() /DEBUG<br>"; // DEBUG
		$this->load->model ( 'order_model' );
		$this->load->helper ( 'hash_helper' );
		$this->load->model ( 'Download_Password_model' );
		
		// echo "<br>DEBUG: erstelle Link zum Download /DEBUG<br>"; // DEBUG
		$downloadLink = $this->createDownloadLink ( $orderID );
		$userEmail = $this->session->userdata ( 'user_email' );
		// echo "<br>DEBUG: sende mail /DEBUG<br>"; // DEBUG
		$this->sendDownloadEmail ( $userEmail, $downloadLink );
		// echo "<br>DEBUG: step out manageDownload() /DEBUG<br>"; // DEBUG
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
		// echo "<br>DEBUG: step into createDownloadLink() /DEBUG<br>"; // DEBUG
		// load helper for generating new salt(simple random integer)
		$this->load->helper ( array (
				'hash_helper' 
		) );
		
		$this->load->model ( 'Download_Password_model' );
		$downloadPasswordArray = $this->Download_Password_model->getDownloadPasswords ();
		
		$download_password = generate_salt ( 30 );
		
		// check if this new $download_password already exists or is a new one(shall be unique).
		// generates new $download_password until a new unique one is found.
		while ( $this->existsInArray ( $download_password, $downloadPasswordArray ) ) {
			$download_password = generate_salt ( 30 );
		}
		
		// create a new tupel
		$data = array (
				'dopa_password' => $download_password,
				'dopa_orde_id' => $orderID,
				'dopa_status' => 0 
		); // status == already downloaded with this password. 0=no, 1=yes.
		   
		// Produkt einfügen
		$new_dopa_id = $this->Download_Password_model->insertDownloadPassword ( $data );
		
		$webPageURL = "http://snap-gallery.de/DownloadManager/startDownload/";
		$downloadLink = $webPageURL . $download_password;
		// echo "<br>DEBUG: step out createDownloadLink() /DEBUG<br>"; // DEBUG
		return $downloadLink;
	}
	function sendDownloadEmail($user_email, $downloadLink) {
		$this->load->library ( 'email' );
		
		$this->email->from ( 'noReply@snapUp.de', 'SnapUp' );
		$this->email->to ( $user_email );
		$this->email->subject ( 'Ihr Download-Link zu Ihrer Bestellung' );
		$this->email->message ( "SnapUp wünscht Ihnen viel Spaß mit Ihren Bildern.\n\n" . "Im Folgenden finden Sie Ihren persönlichen einzigartigen Download-Link, der einmalig nutzbar ist.\n" . "Für weitere Downloads rufen Sie einafach Ihre Bibliothek bei SnapUp auf und fordern einen neuen Download an.\n\n" . 
		// . "<a href='". $downloadLink ."'>"
		$downloadLink . 
		// . "</a>"
		"\n\n" . "Ihr Snapup-Team." );
		$this->email->send ();
	}
	
	/**
	 * Method to start the Download of a zipfile.
	 * This Method checks the integrity of the download call and initiaties if positive.
	 */
	public function startDownload() {
		// echo "<br>DEBUG: step into startDownload() /DEBUG<br>"; // DEBUG
		$this->load->model ( 'Download_Password_model' );
		$url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$path_parts = pathinfo ( $url );
		$downloadPasswordArray = $this->Download_Password_model->getDownloadPasswords ();
		
		// sent passwort is url-addition --> $path_parts['basename'];
		// echo "<br>DEBUG: If-Abfrage: 'existiert Passwort?' /DEBUG<br>"; // DEBUG
		if ($this->existsInArray ( $path_parts ['basename'], $downloadPasswordArray ) == true) {
			// echo "<br>DEBUG: step into if /DEBUG<br>"; // DEBUG
			// downloadprocess
			$this->load->model ( 'order_model' );
			$entry = $this->Download_Password_model->getDownloadPasswordEntryByPassword ( $path_parts ['basename'] );
			$orderID = $entry [0]->dopa_orde_id;
			$products = $this->order_model->getProductInformationByOrderId ( $orderID );
			
			// echo "<br>DEBUG: erstelle .zip mit den bildern /DEBUG<br>"; // DEBUG
			// create the zip File with all pictures from the order
			$downloadableZipFile = $this->zipDir ( $orderID, $products );
			
			// echo "<br>DEBUG: aufruf Download Funktion /DEBUG<br>"; // DEBUG
			// download the created zip File
			// $this->downloadFile ( $downloadableZipFile );
		} // else $this->session->set_flashdata ( 'msg', 'Datensatz existiert nicht.' );
			  // echo "<br>DEBUG: step out startDownload() /DEBUG<br>"; // DEBUG
	}
	private function checkDownloadPasswordIntegrity($filePath) {
		$result = false;
		return $result;
	}
	
	/**
	 * Method to actually force the local machine to downlaod the file given im parameter as basename.extension
	 *
	 * @param unknown $filePath
	 *        	(for example: PDF_Name.pdf).
	 */
	public function downloadFile($filePath) {
		// echo "<br>DEBUG: step into downloadFile() /DEBUG<br>"; // DEBUG
		while ( ob_get_level () ) {
			ob_end_clean ();
		}
		ob_start ();
		
		$sourcePathPrefix = "ImagesDownloadZips/";
		$conjunctedPath = join ( '/', array (
				trim ( $sourcePathPrefix, '/' ),
				trim ( $filePath, '/' ) 
		) );
		
		// Header Informationen
		header ( "Content-Type: application/force-download" );
		// header('Content-type: application/zip');
		header ( "Content-Disposition: attachment; filename=" . $filePath );
		header ( "Content-Length: " . filesize ( $conjunctedPath ) );
		
		// echo "<br>DEBUG: flush + clean + readfile /DEBUG<br>"; // DEBUG
		ob_flush ();
		ob_clean ();
		readfile ( $conjunctedPath );
		
		// echo "<br>DEBUG: step out downloadFile() /DEBUG<br>"; // DEBUG
		exit ();
		redirect ( "/" );
		// return true;
	}
	
	/**
	 * cheks if the password already exists
	 *
	 * @param unknown $testArray        	
	 */
	public function existsInArray($checker, $testArray) {
		$result = false;
		for($i = 0; $i < count ( $testArray ); $i ++) {
			if ($checker == $testArray [$i]->dopa_password) {
				$result = true;
			}
		}
		// echo $result;
		return $result;
	}
	
	/**
	 * Unravels the cryptic downloadlink into a simple path where the zip-archiv is stored.
	 *
	 * @param unknown $downloadLink        	
	 * @return zipPath
	 */
	public function getZipArchiveByDownloadLink($downloadLink) {
		// methode zum auflösen des downloadlinks zu einem auffindbaren zipPfad
		return $zipPath;
	}
	
	/**
	 * Zips a new archive file containing files from given arary.
	 * Autor: Severin Klug.
	 *
	 * @param integer $orderID
	 *        	= OrderID ist referenziert auf bilder.
	 * @param array $productsArray
	 *        	= Zielordner des Zip Archives.
	 */
	public function zipDir($orderID, array $productsArray) {
		// echo "<br>DEBUG: step into zipDir() /DEBUG<br>"; // DEBUG
		// TODO: checken ob ziel und quellordner existieren
		$this->load->model ( 'order_model' );
		$this->load->helper ( 'hash_helper' );
		
		// Zielordner
		$outZipFolder = "ImagesDownloadZips"; // TODO: erstellen, wenn nicht existiert
		                                      
		// Verzeichnis anlegen wenn nicht vorhanden
		if (! file_exists ( $outZipFolder )) {
			mkdir ( $outZipFolder, 0777, true );
		}
		
		// Instanziiert Zip Archiv
		$zipArchive = new ZipArchive ();
		
		// name für das Zip Archiv
		// dateiname = userID, orderID, datum, uhrzeit
		$myDate = date ( 'omdGis' );
		$zipFileName = "Download_Zip_Archive_" . $orderID . "_" . $myDate . ".zip";
		
		// Zip Archiv Name wird an Pfad aus parameter2 angehängt
		$outZipPath = $outZipFolder . "/" . $zipFileName;
		
		// Zip Archiv in Ordnerstruktur erstellen und öffnen
		if ($zipArchive->open ( $outZipPath, ZipArchive::CREATE ) !== TRUE) {
			// if ($zipArchive->open ( $zipFileName, ZipArchive::CREATE ) !== TRUE) {
			exit ( "cannot open <$outZipPath>\n" );
		}
		
		// Alle Pfade aus dem Array (Parameter1) abarbeiten und datein dem Zip Archiv hinzufügen
		for($i = 0; $i < count ( $productsArray ); $i ++) {
			// name der hinzugefügten Datei wird ursprungs
			// zurück steppen (aus Projektordner heraus) & in ordner Images steppen
			$pathComplete = Product::buildFilePath ( $productsArray [$i] );
			$path_parts = pathinfo ( $pathComplete );
			$conjunctedPath = join ( '/', array (
					trim ( "../", '/' ),
					trim ( $pathComplete, '/' ) 
			) );
			
			$zipArchive->addFile ( $conjunctedPath, $path_parts ['basename'] );
		}
		
		// Zip Archiv schließen
		$zipArchive->close ();
		// echo "<br>DEBUG: step out zipDir() /DEBUG<br>"; // DEBUG
		
		return $zipFileName;
	}
	
	/**
	 * Returns an Array containing all image-paths from the orderID.
	 *
	 * @param unknown $orderID        	
	 */
	public static function orderIDtoImagePathArray($orderID) {
		$this->load->database ();
		$this->load->model ( 'order_model' );
		// Methode getOrderID result --> alle bildpfade geladen
		$uresult = $this->order_model->get_order ( $orderID );
		// neues array mit bildpfaden erstellen
		$imagePathArray = array ();
		// return bildpfad array
		return $imagePathArray;
	}
	public function test() {
		echo "<br>testing 123 <br>";
		$this->load->model ( 'order_model' );
		$this->load->helper ( 'hash_helper' );
		$this->load->model ( 'Download_Password_model' );
		
		// $this->sendDownloadEmail("Severin.Klug@gmx.de", "http://www.google.de");
		// $this->downloadFile("Download_Zip_Archive_39_20170119114553.zip");
		
		// $this->downloadFile($zipPath);^
		
		$entry = $this->Download_Password_model->getDownloadPasswordEntryByPassword ( "hdwvvswQjSfA4MLTQuFS4Sz5FYHAHZ" );
		$orderID = $entry [0]->dopa_orde_id;
		$products = $this->order_model->getProductInformationByOrderId ( $orderID );
		$downloadableZipFile = $this->zipDir ( $orderID, $products );
		$this->downloadFile ( $downloadableZipFile );
	}
	public function liveTest() {
		echo "<br>testing 123 <br>";
		$this->load->model ( 'order_model' );
		$this->load->helper ( 'hash_helper' );
		$this->load->model ( 'Download_Password_model' );
		
		$downloadLink = $this->createDownloadLink ( 57 );
		echo "Link: " . $downloadLink;
		$this->sendDownloadEmail ( "Severin.Klug@gmx.de", $downloadLink );
		
		// $this->downloadFile("Download_Zip_Archive_39_20170119103947.zip");
		redirect ( '/' );
	}
}

?>

