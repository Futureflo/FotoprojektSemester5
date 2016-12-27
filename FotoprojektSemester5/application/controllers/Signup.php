<?php
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
		
		$salutation = $this->input->post('user_salutation');
		$name = $this->input->post('user_name');
		$firstname = $this->input->post('user_firstname');
		$country = $this->input->post('user_country');
		$plz = $this->input->post('user_plz');
		$city = $this->input->post('user_city');
		$street = $this->input->post('user_street');
		$houseNr = $this->input->post('user_houseNr');
		$streetAndNr = $street." ".$houseNr;
		$birthday = $this->input->post('user_birthday');
		$email = $this->input->post('user_email');
		$cemail = $this->input->post('user_cemail');
		$password = $this->input->post('user_password');
		$cpassword = $this->input->post('user_cpassword');
		
		$accountholder = $this->input->post('user_accountholder');
		$iban = $this->input->post('user_iban');
		$bic = $this->input->post('user_bic');
		
		
		$agb = $this->input->post('user_agb');
		$privacyPolicy = $this->input->post('user_privacyPolicy');
		$newsletter = $this->input->post('user_newsletter');
		
		echo $name;
		// set form validation rules
		$this->form_validation->set_rules('user_firstname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('user_name', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('user_email', 'Email ID', 'trim|required|valid_email|is_unique[user.user_email]');
		$this->form_validation->set_rules('user_cemail', 'Confirm Email', 'trim|required|matches[user_email]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[user_cpassword]');
		$this->form_validation->set_rules('user_cpassword', 'Confirm Password', 'trim|required');
		
		// submit
		if ($this->form_validation->run() == FALSE)
        {
			// fails
			$this->load->template('user/signup_view');
        }
		else
		{
			$salt = generate_salt(10);
			$algo = 'sha256';
			$hashpw = generate_hash($salt, $password,$algo);
			//createConfirmCode
			$confirmCode = generate_salt(10);
			
			//check if confirmcode allready exists
			do {
				$confirmCode = generate_salt(10);
				$CodeExists = $this->user_model->exists('user_confrimcode', $confirmCode);
			} while ($CodeExists == true);

			
			//insert user details into db
			$data = array(
				'user_firstname' => $firstname,
				'user_name' => $name,
				'user_email' => $email,
				'user_password' => $hashpw,
				'user_role_id' => $role,
				'user_status' => UserStatus::unconfirmed,	
				'user_salt' => $salt,
				'user_confirmcode' => $confirmCode	
			);
			
			if ($this->user_model->insert_user($data))
			{
				$this->session->set_flashdata('msgReg','You are Successfully Registered! Please login to access your Profile!');				
				$this->sendConfirmEmail($this->input->post('user_email'),$confirmCode);
 				redirect('start/');	
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','Oops! Error.  Please try again later!!!');
				redirect('signup/');
				echo "dasda";

			}
		}
	}
	
	function uploadTradeLicense()
	{
		// set path to store uploaded files
		$config['upload_path'] = './uploads/';
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
			print_r($this->upload->data());
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