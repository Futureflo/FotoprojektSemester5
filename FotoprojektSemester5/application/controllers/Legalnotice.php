<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legalnotice extends CI_Controller
{
    public function index()
    {
    	$this->load->template ( 'legalnotice/legalnotice_view' );
    }
}