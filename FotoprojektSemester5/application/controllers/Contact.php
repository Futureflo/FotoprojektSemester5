<?php
class Contact extends CI_Controller
{
    public function index()
    {
    	$this->load->template ( 'contact/contact_view' );
    }
}