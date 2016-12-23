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
    		$this->email->to("service@snap-gallery.de");
    		$this->email->subject($subject);
    		$this->email->message($message."\nTelefon Nummer:".$telNum);
    		$this->email->send();
    		
    		$this->email->from("service@snap-gallery.de", "Snap-Gallery");
    		$this->email->to($email);
    		$this->email->subject("Snap-Gallery Kontaktanfrage: ".$subject);
    		$this->email->message("Vielen Dank für Ihre Kontaktaufnahme. Wir werden uns so schnellst möglich bei Ihnen melden");
    		$this->email->send();
    		$this->load->template ( 'contact/success_kontact_request_view.php' );
   		
    }
    }
    
    
    
}