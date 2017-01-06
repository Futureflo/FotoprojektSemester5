<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Printers extends CI_Controller {
}
abstract class PrinterStatus {
	const undefined = 0;
	const activated = 1;
	const deleted = 2;
}
?>