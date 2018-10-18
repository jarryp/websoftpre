<?php


class Index extends Controllers{

	//public $response;
	function __construct(){
		$response="";
		parent::__construct();
		
	}
	public function index(){
		$Usuario   = Session::getSession("usuario");
		if($Usuario==""){
			$this->view->renderLogin($this,'index');	
		}else{
			header("Location:".URL."Principal/principal");	
		}
		
	}

	public function signIn(){
		$this->view->renderLogin($this,'signIn');
	}

	

}


?> 