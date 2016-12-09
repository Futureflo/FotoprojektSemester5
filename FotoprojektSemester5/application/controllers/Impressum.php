<?php
class impressum extends CI_Controller
{
    public function index()
    {
    	$this->load->template ( 'impressum/impressum_view' );
    }
}