<?php
class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE) {
		// TODO: LoggedIn Abfrage in statische Methode auslagern und Rollenbedingt laden	
		if ($return) :
			
			$content = $this->view ( 'general/header_view', $vars, $return );
			
			// TODO: LoggedIn Abfrage in statische Methode auslagern!
			if ($this->session->userdata ( 'login' )) {
				
				$content .= $this->view ( 'general/navbar_loggedin_view', $vars, $return );
			} else {
				$content .= $this->view ( 'general/navbar_visitor_view', $vars, $return );
			}
			$content .= $this->view ( $template_name, $vars, $return );
			$content .= $this->view ( 'general/footer_view', $vars, $return );
			
			return $content;
		 else :
			$this->view ( 'general/header_view', $vars );
			
			if ($this->session->userdata ( 'login' )) {
				
				$this->view ( 'general/navbar_loggedin_view', $vars );
			} else {
				$this->view ( 'general/navbar_visitor_view', $vars );
			}
			$this->view ( $template_name, $vars );
			$this->view ( 'general/footer_view', $vars );
		endif;
	}
}
?>
