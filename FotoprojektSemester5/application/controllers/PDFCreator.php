<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require('libraries/fpdf/fpdf.php');

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
		$this->load->library('tcpdf');
		
		// send data from controller to view
		$data['txt'] = <<<EOD
						TCPDF Example 003	
						Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
EOD;
		
		// show it
		$this->load->view('pdf/bill', $data);
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
	
	
	
}
?>