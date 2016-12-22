<?php
class Contact extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','email'));
		$this->load->database();
		$this->load->model('user_model');
	}
	
    public function index()
    {
    	$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[30]');
     	$this->form_validation->set_rules('email', '"Email"', 'trim|required');
     	$this->form_validation->set_rules('telNum', 'Telefon Number', 'trim|required|min_length[3]|max_length[30]');
     	$this->form_validation->set_rules('subject', 'Subject', 'required');
     	$this->form_validation->set_rules('message', 'Message', 'required');
    	 
    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		// fails
    		$this->load->template ( 'contact/contact_view' );
    		$this->session->set_flashdata ( 'contactMsg', 'Bitte füllen sie alle Pflichtfelder aus' );
    		 }
    	else
    	{
    		
    		$name = $this->input->post('name');
    		$email = $this->input->post('email');
    		$telNum = $this->input->post('telNum');
    		$subject = $this->input->post('subject');
    		$message = $this->input->post('message');
    		$this->email->from($email, $name);
    		$this->email->to($email);
    		$this->email->subject($subject);
    		$this->email->message($message."Telefon Nummer:".$telNum);
    		$this->email->send();
    		$this->session->set_flashdata ( 'contactMsg', 'Ihr Account wurde gesperrt, da Sie Ihr Passwort zu oft falsch eingegeben haben. Kontaktieren Sie den Admin oder setzten Sie ihr Password über "Password vergessen" zurück' );
    		
    		
    }
    }
    
    
    
}