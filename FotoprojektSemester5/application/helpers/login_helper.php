<?php
function lh_isUserLoggedin() {
	if (isset ( $_SESSION ['login'] ))
		return $_SESSION ['login'];
	else
		return false;
	// return $this->session->userdata ( 'login' );
}
function lh_getUser() {
	if (lh_isUserLoggedin ()) {
		$user = array ();
		if (isset ( $_SESSION ['user_name'] )) {
			// log_message("debug", "debug#1");
			$user ["user_name"] = $_SESSION ['user_name'];
		}
		if (isset ( $_SESSION ['user_id'] )) {
			// log_message("debug", "debug#2");
			$user ["user_id"] = $_SESSION ['user_id'];
		}
		return $user;
	} else {
		return NULL;
	}
}

/**
 * Check if User/Visitor is allowed to see this page, otherwise show User Access Denied page
 * Call at begin of Controller
 * 
 * @param number $accessRole
 *        	= 0 (DEFAULT) only if User is Loggedin
 *        	= 1 only if User is Photograph
 *        	= 2 only if User is Administrator
 */
function lh_checkAccess($accessRole = 0) {
	$showAccessDeniedPage = FALSE;
	$ci =& get_instance();
	$ci->load->model ( 'user_model' );

	//check logged in users
	if($accessRole >= 0){
		if(lh_isUserLoggedin() == FALSE){
			$showAccessDeniedPage = TRUE;
		}
	}

	//User Roles
	//1 = Admin
	//2 = Besteller
	//3 = Fotograf
	//4 = Veranstalter ! KEINE ROLLE! -.-

	//check if user is Photograph
	if($accessRole == 1){
		if($ci->session->userdata('user_role') != 1 && $ci->session->userdata('user_role') != 3){
			$showAccessDeniedPage = TRUE;
		}

	}

	if($accessRole == 2){
		if($ci->session->userdata('user_role') != 1 ){
			$showAccessDeniedPage = TRUE;
		}
	}

	if($showAccessDeniedPage){
		echo $ci->load->template ( 'errors/html/error_access', array(), true );

		exit();
	}
}
?>