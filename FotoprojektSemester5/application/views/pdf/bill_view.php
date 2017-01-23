<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('../libraries/tcpdf/examples/tcpdf_include.php');
// $this->load->library('tcPDFstart');
// require_once('examples/tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
// 		$image_file = base_url().'Images/logo_example.jpg';
// 		$image_file = base_url().'Images/google_logo.png';
// 		$image_file = '../Images/google_logo.png';
// 		$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, '<< Snap-Gallery >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$this->tcPDFstart = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$this->tcPDFstart->SetCreator(PDF_CREATOR);
$this->tcPDFstart->SetAuthor('Nicola Asuni');
$this->tcPDFstart->SetTitle('TCPDF Example 003');
$this->tcPDFstart->SetSubject('TCPDF Tutorial');
$this->tcPDFstart->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$this->tcPDFstart->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$this->tcPDFstart->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$this->tcPDFstart->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$this->tcPDFstart->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$this->tcPDFstart->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$this->tcPDFstart->SetHeaderMargin(PDF_MARGIN_HEADER);
$this->tcPDFstart->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$this->tcPDFstart->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$this->tcPDFstart->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$this->tcPDFstart->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$this->tcPDFstart->SetFont('times', 'BI', 12);

// add a page
$this->tcPDFstart->AddPage();

// // set some text to print
// $txt = <<<EOD
// TCPDF Example 003

// Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
// EOD;

// print a block of text using Write()
$this->tcPDFstart->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$this->tcPDFstart->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
