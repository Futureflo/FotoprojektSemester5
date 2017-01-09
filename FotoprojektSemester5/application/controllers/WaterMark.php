<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Watermarkdemo extends \CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'image_lib' );
	}
	public function text($image, $text, $font, $fsize) {
		$config ['source_image'] = $image;
		// The image path,which you would like to watermarking
		$config ['wm_text'] = $text;
		$config ['wm_type'] = 'text';
		$config ['wm_font_path'] = './fonts/' . $font . '.ttf';
		$config ['wm_font_size'] = $fsize;
		$config ['wm_font_color'] = 'ffffff';
		$config ['wm_vrt_alignment'] = 'middle';
		$config ['wm_hor_alignment'] = 'right';
		$config ['wm_padding'] = '20';
		$this->image_lib->initialize ( $config );
		if (! $this->image_lib->watermark ()) {
			echo $this->image_lib->display_errors ();
		} else {
			echo 'Bild erfolgreich hochgeladen.';
		}
	}
	// image = ./uploads/bild.jpg $patch = ./uploads/logo.png
	public function overlay($image, $patch, $opacity) {
		$config ['image_library'] = 'gd2';
		$config ['source_image'] = $image;
		$config ['wm_type'] = 'overlay';
		$config ['wm_overlay_path'] = $patch;
		// the overlay image
		$config ['wm_opacity'] = $opatcity;
		$config ['wm_vrt_alignment'] = 'middle';
		$config ['wm_hor_alignment'] = 'right';
		$this->image_lib->initialize ( $config );
		if (! $this->image_lib->watermark ()) {
			echo $this->image_lib->display_errors ();
		} else {
			echo 'Bild erfolgreich gespeichert.';
		}
	}
	public static function watermark($filepath) {
		$CI = & get_instance ();
		$CI->load->library ( 'image_lib' );
		
		$config ['source_image'] = $filepath;
                $config['wm_overlay_path'] = './Images/logo.png';
                $config['wm_type'] = 'overlay';
                $config['width'] = '50';
                $config['height'] = '50';
                $config['padding'] = '50';
                $config['wm_opacity'] = '100';
                $config['wm_vrt_alignment'] = 'bottom';
                $config['wm_hor_alignment'] = 'right';
                $config['wm_vrt_offset'] = '100';
		//$config ['wm_text'] = 'Copyright 2016 - FPS5';
		//$config ['wm_type'] = 'text';
		
		$CI->image_lib->initialize ( $config );
		$CI->image_lib->watermark ();
		$CI->image_lib->clear ();
	}
	public static function thumb($filepath) {
		$CI = & get_instance ();
		$CI->load->library ( 'image_lib' );
		
		echo "<br>" . $filepath;
		$config ['source_image'] = $filepath;
		$config ['maintain_ratio'] = TRUE;
		$config ['width'] = 304;
		// $config ['heigt'] = 300;
		
		$CI->image_lib->resize ();
		$CI->image_lib->clear ();
		
		$config ['create_thumb'] = true;
		$CI->image_lib->resize ();
		
		$CI->image_lib->initialize ( $config );
		$CI->image_lib->resize ();
		$CI->image_lib->clear ();
	}
}