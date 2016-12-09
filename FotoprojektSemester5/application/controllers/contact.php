<?php
class contact extends CI_Controller
{
    public function index()
    {
    	$this->load->template ( 'contact/contact_view' );
    }
}