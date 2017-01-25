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


/**
 * 	KLEINBETRAGSRECHNUNGEN (kleiner 150€):
 * 	vollständiger Name und vollständige Anschrift des leistenden Unternehmers,
 *	das Ausstellungsdatum der Rechnung,
 *	Menge und Art der gelieferten Gegenstände oder die Art und den Umfang der sonstigen Leistung
 *	Entgelt und Steuerbetrag für die Lieferung oder Leistung in einer Summe,
 *	Steuersatz oder
 *	im Fall einer Steuerbefreiung ein Hinweis darauf, dass für die Lieferung oder sonstige Leistung eine Steuerbefreiung gilt.
 *	
 *	NORMALE RECHNUNGEN 
 *	Vollständiger Name und Anschrift des leistenden Unternehmers und des Leistungsempfängers
 *	Steuernummer oder Umsatzsteueridentifikationsnummer
 *	Ausstellungsdatum der Rechnung
 *	Fortlaufende Rechnungsnummer
 *	Menge und handelsübliche Bezeichnung der gelieferten Gegenstände oder die Art und den Umfang der sonstigen Leistung
 *	Zeitpunkt der Lieferung bzw. Leistung
 *	Nach Steuersätzen und -befreiungen aufgeschlüsseltes Entgelt
 *	Im Voraus vereinbarte Minderungen des Entgelts
 *	Entgelt und hierauf entfallender Steuerbetrag sowie Hinweis auf Steuerbefreiung
 *	Ggf. Hinweis auf Steuerschuld des Leistungsempfängers
 */

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

// echo "<br>DEBUG: erstelle Dokument /DEBUG<br>"; // DEBUG
// create new PDF document
$this->tcPDFstart = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$this->tcPDFstart->SetCreator(PDF_CREATOR);
$this->tcPDFstart->SetAuthor('SnapUp');
$this->tcPDFstart->SetTitle('Bill');
$this->tcPDFstart->SetSubject('Bill');
$this->tcPDFstart->SetKeywords('TCPDF, PDF, Bill, Rechnung');

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
$heute = date("d.m.Y");	// 21.12.2016
$netSum = 0;

// print a block of text using Write()
// $this->tcPDFstart->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "SnapUp GmbH, Rothebühlplatz 41/1, 70178 Stuttgart", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Datum: ". $heute, '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Umsatzsteueridentifikationsnummer: F123581321", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Rechnungsnummer: ". rand(), '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Positions", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Name;\t Net;\t Tax;\t gross", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "", '', 0, 'L', true, 0, false, false, 0);

foreach ($positions as &$value) {
	$this->tcPDFstart->Write(0, $value[0] .";\t". $value[1]. ";\t". $value[1]*0.19 .";\t". $value[1]*1.19, '', 0, 'L', true, 0, false, false, 0);
	$netSum += $value[1];
}

$this->tcPDFstart->Write(0, "", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Sum net: ". $netSum ."\t Sum Gross:". $netSum*1.19 , '', 0, 'L', true, 0, false, false, 0);

$this->tcPDFstart->Write(0, "", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Bank Details", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "Bank Name: LBBW", '', 0, 'L', true, 0, false, false, 0);
$this->tcPDFstart->Write(0, "IBAN: DE12 3456 7890 1245 6789 01", '', 0, 'L', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$this->tcPDFstart->Output('bill.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
