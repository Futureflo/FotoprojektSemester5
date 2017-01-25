<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// require('../libraries/tcpdf/tcpdf.php');

// http://www.php-guru.in/2013/html-to-pdf-conversion-in-codeigniter/

class PDFCreator extends CI_Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	// Aufruf der Views
	public function index() {
// 		$this->load->template ( 'admin/dashboard_view' );
		echo "indexseite des PDFCreators";
	}
	
	// Controller: application/controllers/createpdf.php
	function pdf()
	{
		$this->load->helper('pdf_helper');
		/*
		 ---- ---- ---- ----
		 your code here
		 ---- ---- ---- ----
		 */
		$this->load->view('pdfreport', $data);
	}
	
	public function test() {
// 		echo "<br>DEBUG: step into test() /DEBUG<br>"; // DEBUG
// 		echo "<br>DEBUG: lade bibliothek /DEBUG<br>"; // DEBUG
		// load library
// 		$this->load->library('tcPDFstart');
		$this->load->library('tcPDF');
		
		// send data from controller to view
		$data['txt'] = <<<EOD
						Snap-Gallery Testseite
				
						Wir können ja doch etwas!
				
				
				
						TCPDF Example 003	
						Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
EOD;
		
// 		echo "<br>DEBUG: lade view /DEBUG<br>"; // DEBUG
		// show it
		$this->load->view('pdf/bill_view', $data);
// 		echo "<br>DEBUG: step out test() /DEBUG<br>"; // DEBUG
	}
	
	public function example() {
		// View: application/views/pdfreport.php
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "PDF Report";
		$obj_pdf->SetTitle($title);
		$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
		// we can have any view part here like HTML, PHP etc
		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, true, false, true, false, '');
		$obj_pdf->Output('output.pdf', 'I');
	}
	public function exampleCallBillFunction() {
		$bild1 = array("Name Bild 1", 10.00);
		$bild2 = array("Name Bild 2", 84.03);
		$bild3 = array("Name Bild 3", 100.99);
		$bild4 = array("Name Bild 4", 123.01);
		
		$positions = array($bild1, $bild2, $bild3, $bild4);
		$this->bill($positions);
	}
	
	public function bill($positions) {
		$this->load->library('tcPDF');
		
		// send data from controller to view

// 		$data['txt'] = <<<EOD
// 						Snap-Gallery Rechnung

// EOD;

		$data['positions'] = $positions;
		// 		echo "<br>DEBUG: lade view /DEBUG<br>"; // DEBUG
		// show it
		$this->load->view('pdf/bill_view', $data);
	}
	
}
?>