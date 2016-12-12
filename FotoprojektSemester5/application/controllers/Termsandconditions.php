<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Termsandconditions extends CI_Controller
{
    public function index()
    {
    	$this->load->template ( 'termsandconditions/termsandconditions_view' );
    }
}