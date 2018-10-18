<?php 


class Index_model{
	private $data = array();
	function __construct(){
		$this->data = array("PHP","C","ANDROID","HTML");
	}

	function datosPersonales(){
		return $this->data;
	}
}


?>