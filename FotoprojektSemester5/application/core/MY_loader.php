<?php
class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE) {
		if ($return) :
			
			$content = $this->view ( 'general/header_view', $vars, $return );
			$content .= $this->view ( 'general/navbar_visitor_view', $vars, $return );
			$content .= $this->view ( $template_name, $vars, $return );
			$content .= $this->view ( 'general/footer_view', $vars, $return );
			
			return $content;
		 else :
			$this->view ( 'general/header_view', $vars );
			$this->view ( 'general/navbar_visitor_view', $vars );
			$this->view ( $template_name, $vars );
			$this->view ( 'general/footer_view', $vars );
		endif;
	}
}
?>