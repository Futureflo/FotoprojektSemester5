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
			$user ["user_name"] = $_SESSION ['user_name'];
		}
		if (isset ( $_SESSION ['user_name'] )) {
			$user ["user_id"] = $_SESSION ['user_id'];
		}
	} else {
		return NULL;
	}
}
?>