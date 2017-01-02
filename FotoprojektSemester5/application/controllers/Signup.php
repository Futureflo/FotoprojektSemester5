<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/UserRole.php");
class Signup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'hash_helper'));
		$this->load->library(array('form_validation'));
		$this->load->database();
		$this->load->model('user_model');
	}
	
	function index()
	{
 		$this->load->template('user/signup_view');
		
		$title = $this->input->post('gender');
		$name = $this->input->post('lastname');
		$firstname = $this->input->post('firstname');
		$fullname = $firstname." ".$name;
		$country = $this->input->post('country');
		$zip = $this->input->post('zip');
		$city = $this->input->post('city');
		$street = $this->input->post('street');
		$houseNr = $this->input->post('housenumber');
		$streetAndNr = $street." ".$houseNr;
		$birthday = $this->input->post('birthday');
		$email = $this->input->post('email');
		$cemail = $this->input->post('cemail');
		$password = $this->input->post('password');
		$cpassword = $this->input->post('cpassword');
		
		$accountholder = $this->input->post('accountholder');
		$iban = $this->input->post('iban');
		$bic = $this->input->post('bic');
		
		
		$agb = $this->input->post('checktermsandconditions');
		$privacyPolicy = $this->input->post('checklegalnotice');
		$newsletter = $this->input->post('checknewsletter');
		
		if($agb != true && $privacyPolicy != true){
		
			$this->session->set_flashdata('msgReg','Bitte stimmen Sie den AGB zu und akzeptieren Sie die Datenschutzrichtlinien');
				 
		}
		$role = $this->input->post('type_hidden_field');
			
		// set form validation rules
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[user.user_email]');
 		$this->form_validation->set_rules('cemail', 'Confirm Email', 'trim|required|matches[email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');
 		$this->form_validation->set_rules('zip', 'ZIP', 'trim|required');
 		$this->form_validation->set_rules('city', 'City', 'trim|required');
 		$this->form_validation->set_rules('street', 'Street', 'trim|required');
 		$this->form_validation->set_rules('housenumber', 'Housenumber', 'trim|required');
 		$this->form_validation->set_rules('birthday', 'Birthday', 'required');

		if ($role == UserRole::Photograph){
			$this->form_validation->set_rules ( 'accountholder', 'Accountholder', 'trim|required' );
			$this->form_validation->set_rules ( 'iban', 'IBAN', 'trim|required' );
			$this->form_validation->set_rules ( 'bic', 'BIC', 'trim|required' );
// 			$this->form_validation->set_rules ( 'traderlicense', 'Traderlicense', 'required' );			
		}
		
		
		// submit
		if ($this->form_validation->run() == FALSE)
        {
			// fails
        	$this->session->set_flashdata('msgReg','Füllen Sie bitte alle Pflichtfelder aus!');

        }
		else
		{
			$salt = generate_salt(10);
			$algo = 'sha256';
			$hashpw = generate_hash($salt, $password,$algo);

			
			//check if confirmcode allready exists
			do {
				$confirmCode = generate_salt(10);
				$CodeExists = $this->user_model->exists('user_confirmcode', $confirmCode);
			} while ($CodeExists == true);
			
			//insert user details into db
			$data = array(
				'user_firstname' => $firstname,
				'user_name' => $name,
				'user_email' => $email,
				'user_birthday' => $birthday,
				'user_password' => $hashpw,
				'user_role_id' => $role,
				'user_status' => UserStatus::unconfirmed,	
				'user_salt' => $salt,
				'user_confirmcode' => $confirmCode	
			);
			//insert User in db
			$UserIsSet= $this->user_model->insert_user($data);
			$result = $this->user_model->get_user($email);
			$user_id = $result[0]->user_id;
			//insert address
			$address = array(
				'adre_user_id' => $user_id,
				'adre_zip' => $zip,
				'adre_city' => $city,
				'adre_street' => $streetAndNr,
				'adre_name' => $fullname,
				'adre_coun_id' => '80'
			);
			$addressIsSet = $this->user_model->insert_address($address);
				
			if (UserRole::Photograph) {
				$bankaccountData = array(
						'user_id' => $user_id,
						'pain_account_holder' => $accountholder,
						'pain_account_iban' => $iban,
						'pain_account_bic' => $bic,
						'paty_id' => 2
				);
				$this->user_model->insert_bankaccount($bankaccountData);
			}
			if($newsletter == true){
				$newsletterData = array(
						'nele_user_id' => $user_id,
						'nele_email' => $email
				);
				$this->user_model->insert_UserToNewsletter($newsletterData);
			}
			
			if ($addressIsSet && $UserIsSet)
			{
				
				$this->session->set_flashdata('msgReg','You are Successfully Registered! Please login to access your Profile!');				
				$this->sendConfirmEmail($this->input->post('user_email'),$confirmCode);
 				redirect('start/');	
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','Oops! Error.  Please try again later!!!');
// 				redirect('signup/');
				

			}
		}
	}
	
	function uploadTradeLicense()
	{
		// set path to store uploaded files
		$config['upload_path'] = './Tradelicinse/';
		// set allowed file types
		$config['allowed_types'] = 'pdf';
		// set upload limit, set 0 for no limit
		$config['max_size']    = 0;
	
		// load upload library with custom config settings
		$this->load->library('upload', $config);
	
		// if upload failed , display errors
		if (!$this->upload->do_upload())
		{
			$this->session->set_flashdata('upload','Upload des Gerwerbeschein ist fehlgeschlagen. Bitte versuchen Sie es erneut!');
				
		}
		else
		{
			$this->session->set_flashdata('upload','Gewerbeschein wurde erfolgreich hochgeladen');
				
			//print_r($this->upload->data());
			// print uploaded file data
		}
	}
	
	function sendConfirmEmail($user_email,$confirmCode){

		$this->load->library('email');
		
		$this->email->from('noReply@snap-gallery.de', 'Snap-Gallery');
		$this->email->to($user_email);
		$this->email->subject('Bestätigung zu Ihrem Snap Gallery Account');
		$this->email->message('Sie haben erfolgreich ihren Account bestätigt '. base_url()."login/confirmAccount/".$confirmCode);
		$this->email->send();		
	}
}