<?php
 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Watermarkdemo extends \CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
    }
    public function text($image,$text,$font,$fsize)
    {
        $config['source_image'] = $image;
        //The image path,which you would like to watermarking
        $config['wm_text'] = $text;
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './fonts/'.$font.'.ttf';
        $config['wm_font_size'] = $fsize;
        $config['wm_font_color'] = 'ffffff';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'right';
        $config['wm_padding'] = '20';
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        } else {
            echo 'Bild erfolgreich hochgeladen.';
        }
    }
	// image = ./uploads/bild.jpg                 $patch = ./uploads/logo.png
    public function overlay($image,$patch,$opacity)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image;
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = $patch;
        //the overlay image
        $config['wm_opacity'] = $opatcity;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'right';
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        } else {
            echo 'Bild erfolgreich gespeichert.';
        }
    }
}