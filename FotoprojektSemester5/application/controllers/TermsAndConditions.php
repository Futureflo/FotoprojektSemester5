<?php
class termsandconditions extends CI_Controller
{
    public function index()
    {
    	$this->load->template ( 'termsandconditions/termsandconditions_view' );
    }
}