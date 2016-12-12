<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impressum extends CI_Controller
{
    public function index()
    {
    	$this->load->template ( 'impressum/impressum_view' );
    }
}