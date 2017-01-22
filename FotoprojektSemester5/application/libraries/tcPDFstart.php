<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require('tcPDF/tcpdf.php');

// http://www.php-guru.in/2013/html-to-pdf-conversion-in-codeigniter/

class tcPDFstart extends Tcpdf {
	public function __construct() {
		parent::__construct ();
		$CI =& get_instance();
	}
}
?>