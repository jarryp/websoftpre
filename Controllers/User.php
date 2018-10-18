<?php

class User extends Controllers {

	function __construct(){
		parent::__construct();
	}


	public function user(){
		//echo "Hola desde el Controlador de usarios";
		$UserName = Session::getSession("usuario");

		if($UserName!=""){
			$this->view->render_section($this,'user');
		}else{
			header("Location:".URL);
		}
	}


	public function listado(){
		$json = $this->model->listadoModel("idUser,Name,LastName,usuario,email,estado","LastName,Name");
		echo $json;
	}

	

	public function add(){

		if(isset($_REQUEST['nombre']) && 
		   isset($_REQUEST['lastname']) && 
		   isset($_REQUEST['usuario']) && 
		   isset($_REQUEST['email']) && 
		   isset($_REQUEST['pwd']) )
		{
			$this->model->setName($_REQUEST['nombre']);
			$this->model->setLastName($_REQUEST['lastname']);
			$this->model->setUsuario($_REQUEST['usuario']);
			$this->model->setEmail($_REQUEST['email']);
			$this->model->setPassword($_REQUEST['pwd']);

			if( $this->model->existeModel("email",$this->model->getEmail()) ) {		
			 echo "C";
			}else{

				if($this->model->save()){
					echo "A";
				}else{
					echo "D";
				}
			}
		}else
		{
			echo "B";
		}


	}

	public function update(){

		$this->model->setIdUser($_REQUEST['iduser']);
		$this->model->setName($_REQUEST['nombre']);
		$this->model->setLastName($_REQUEST['lastname']);
		$this->model->setUsuario($_REQUEST['usuario']);
		$this->model->setEmail($_REQUEST['email']);
		$this->model->setPassword($_REQUEST['pwd']);
		$this->model->setCambiaPwd($_REQUEST['cambiapwd']);
		$this->model->setEstado($_REQUEST['estado']);

		if($this->model->update()){
			echo "1";
		}else{
			echo "2";
		}
	}


	public function delete(){
		$this->model->setIdUser($_REQUEST['iduser']);
		if($this->model->delete()){
			echo "1";
		}else{
			echo "2";
		}
	}


	public function consulta(){
		$this->model->setIdUser($_REQUEST['iduser']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		$cadena="";

		if($res!=NULL){

			if($res['estado']=="t"){
				$estado="A";
			}else{
				$estado="B";
			}
			$nombre = $res["name"];
			$cadena="A#".$nombre."#".$res["lastname"]."#".$res["usuario"]."#".$res["email"]."#".$estado;
		

		}else{
			$cadena="B#";
		}

		echo $cadena;
	}


	public function usuarioLogin(){
	if( isset($_POST["email"]) && isset($_POST["passwd"]) ){

	$response = $this->model->usuarioLogin("idUser,Name,LastName,usuario,email,pgp_sym_decrypt(password,'p4l4c10ssyst3ms') as password ","Email= '".$_POST['email']."' ");
	$response = $response[0];

			if($response["password"]==$_POST["passwd"]){
				$this->createSession($response['iduser'],$response['Name'].' '.$response['LastName']);
				Session::setSession('id_entidad',$_REQUEST['entidad']);
				$_SESSION['n_usuario'] = $response['name']." ".$response['lastname'];
				define('ID_ENTIDAD', $_REQUEST['entidad']);
				define('ID_PERIODOP',$_REQUEST['periodo']);
				$_SESSION['id_periodo'] = $_REQUEST['periodo'];
				$_SESSION['id_entidad'] = $_REQUEST['entidad'];

				echo "1";

			}else{
				echo "2";
			}
			
		
		}
	}


	public function signIn(){
		if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['usuario']) && isset($_POST['email']) && isset($_POST['passwd'])){

			$response = $this->model->usuarioLogin("idUser,Name,LastName,usuario,email,pgp_sym_decrypt(password,'p4l4c10ssyst3ms') as password ","Email= '".$_POST['email']."' ");
			$response = $response[0];

			if($response==NULL){

				$array["name"]     = $_POST['name'];
				$array["lastname"] = $_POST['lastname'];
				$array["usuario"]  = $_POST['usuario'];
				$array["email"]    = $_POST['email'];
				$array["Password"] = $_POST['password'];

				$this->model->signInModel($array);
				echo "1";
			}else{
				echo "2";
			}

		}
	}

	 function createSession($id_usuario,$usuario){
		Session::setSession('idusuario',$id_usuario);
		Session::setSession('usuario',$usuario);
	}

	 function destroySession(){
		Session::destroy();
		header("Location:".URL);
	}

}

?>