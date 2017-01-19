<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/UserRole.php");
class Signup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'hash_helper','html'));
		$this->load->library(array('form_validation'));
		$this->load->database();
		$this->load->model('user_model');
		$this->load->model ( 'adress_model' );
	}
	
	function index()
	{

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
		
		$role = $this->input->post('type_hidden_field');
		
			
		// set form validation rules
		$this->form_validation->set_rules('firstname', 'Vorname', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('lastname', 'Nachname', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('email', 'E-Mail Addresse', 'trim|required|valid_email|is_unique[user.user_email]');
 		$this->form_validation->set_rules('cemail', 'Bestätigung der E-Mail Addresse', 'trim|required|matches[email]');
		$this->form_validation->set_rules('password', 'Passwort', 'trim|required|matches[cpassword]|min_length[6]');
		$this->form_validation->set_rules('cpassword', 'Bestätigung Password', 'trim|required|min_length[6]');
 		$this->form_validation->set_rules('zip', 'PLZ', 'trim|required');
 		$this->form_validation->set_rules('city', 'Stadt', 'trim|required');
 		$this->form_validation->set_rules('street', 'Straße', 'trim|required');
 		$this->form_validation->set_rules('housenumber', 'Hausnummer', 'trim|required');
 		$this->form_validation->set_rules('birthday', 'Geburtsdatum', 'required');

		if ($role == UserRole::Photograph){
			$this->form_validation->set_rules ( 'accountholder', 'Kontoinhaber', 'trim|required' );
			$this->form_validation->set_rules ( 'iban', 'IBAN', 'trim|required' );
			$this->form_validation->set_rules ( 'bic', 'BIC', 'trim|required' );
			
			if (empty($_FILES['tradelicense']['name']))
			{
				$this->form_validation->set_rules('tradelicense', 'Gewerbeschein', 'required');
			}
		}
		
		$this->form_validation->set_rules('checktermsandconditions', 'AGB', 'required');
		$this->form_validation->set_rules('checklegalnotice', 'Datenschutzrichtlinien', 'required');
		
		
		
		// submit
		if ($this->form_validation->run() == FALSE)
        {
			// set user default role
        	if($role == null){
				$role = UserRole::User;
			}
        	$data['type_hidden_field'] = $role;
        	
         	$this->load->template('user/signup_view',$data); 

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
				'user_firstname' => $title,
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
			$user_id = $this->user_model->insert_user($data);

			//insert address
			$address = array(
				'adre_user_id' => $user_id,
				'adre_zip' => $zip,
				'adre_city' => $city,
				'adre_street' => $streetAndNr,
				'adre_name' => $fullname,
					'adre_coun_id' => '80',
					'adre_status' => 1 
			);
			$addressIsSet = $this->adress_model->addAdressObj ( $address );
			
			if (UserRole::Photograph) {
				
				$bankaccountData = array(
						'user_id' => $user_id,
						'pain_account_holder' => $accountholder,
						'pain_account_iban' => $iban,
						'pain_account_bic' => $bic,
						'paty_id' => 2
				);
				$this->user_model->insert_bankaccount($bankaccountData);
				
				// upload traderlicense
				$this->uploadTradeLicense($user_id);
			}
			if($newsletter == true){

				$this->user_model->update_addUserToNewsletter($user_id);
			}
			
			if ($addressIsSet && $user_id =! NULL)
			{
				$this->sendConfirmEmail($email, $confirmCode);
  				$this->load->template ( 'user/success_signup_view' );
					}
			else
			{
				// error
				$this->session->set_flashdata('msgReg','Es ist ein technischer Fehler aufgetreten. Bitte Versuchen Sie es später noch einmal.');

			}
		}
	}
	
	function uploadTradeLicense($user_id)
	{
		// set path to store uploaded files
		$basefolder = './Tradelicinse/';
		$config['upload_path'] = $basefolder;
		// set allowed file types
		$config['allowed_types'] = 'pdf';
		// set upload limit, set 0 for no limit
		$config['max_size']    = 0;
		// get filename and add userid
		$file_name = $_FILES['tradelicense']['name'];
		$newfile_name = $user_id."_".$file_name;
		$config['file_name'] = $newfile_name;

		// load upload library with custom config settings
		$this->load->library('upload', $config);
		$this->upload->initialize ( $config );
		
		// if upload failed , display errors
		if (!$this->upload->do_upload('tradelicense'))
		{
			$this->session->set_flashdata('msgReg','Upload des Gerwerbeschein ist fehlgeschlagen. Bitte versuchen Sie es erneut!');
		}
		else
		{
			//safe url in DB
			$user_tradelicenseurl= $basefolder.$newfile_name;
			$this->user_model->update_userTradelicenseByID($user_id,$user_tradelicenseurl);
			$this->session->set_flashdata('msgReg','Gewerbeschein wurde erfolgreich hochgeladen');

		}
	}
	
	function sendConfirmEmail($user_email,$confirmCode){

		$this->load->library('email');
		
		$this->email->from('noReply@snapUp.de', 'SnapUp');
		$this->email->to($user_email);
		$this->email->subject('Bestätigung zu Ihrem SnapUp Account');
		$this->email->message('Vielen Dank, Sie haben sich erfolgreich bei Snap-Up angemeldet. Um Ihren Account zu bestätigen bitte auf folgenden Link klicken.'. base_url()."login/confirmAccount/".$confirmCode);
		$this->email->send();		
	}
}