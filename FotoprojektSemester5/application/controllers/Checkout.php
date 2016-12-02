<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Checkout extends CI_Controller {
	// 	https://www.tutorialspoint.com/codeigniter/codeigniter_tempdata.htm
	// 'item' will be erased after 300 seconds(5 minutes)
	// 	$this->session->mark_as_temp('item',300);
	
	public function index() {
		$this->load->template ( 'checkout/checkout_view' );
	}
	
	
	/**
	 * Zip a folder (include itself).
	 * Usage:
	 *   HZip::zipDir('/path/to/sourceDir', '/path/to/out.zip');
	 *   Source: http://php.net/manual/de/class.ziparchive.php
	 *
	 * @param string $sourcePath Path of directory to be zip.
	 * @param string $outZipPath Path of output zip file.
	 */
	public static function zipDir($sourcePath, $outZipPath) {
		$pathInfo = pathInfo($sourcePath);
		$parentPath = $pathInfo['dirname'];
		$dirName = $pathInfo['basename'];
	
		$z = new ZipArchive();
		$z->open($outZipPath, ZIPARCHIVE::CREATE);
		$z->addEmptyDir($dirName);
		self::folderToZip($sourcePath, $z, strlen("$parentPath/"));
		$z->close();
	}
	
	/**
	 * Method to unpack Zip.
	 * #Author: Severin
	 */
	public function unpackZip() {
		// Mehtod
	}
}
?>