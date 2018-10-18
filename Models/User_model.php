
<?php 

class User_model extends Conexion {

	private $tabla = "users";
	private $iduser;
	private $name;
	private $lastname;
	private $usuario;
	private $email;
	private $password;
	private $estado;
	private $cambiapwd;
	
	function __construct(){
		parent::__construct();
	}


	function setIdUser($iduser){
		$this->iduser = $iduser;
	}

	function getIdUser(){
		return $this->iduser;
	}

	function setName($name){
		$this->name = $name;
	}

	function getName(){
		return $this->name;
	}

	function setLastName($lastname){
		$this->lastname = $lastname;
	}

	function getLastName(){
		return $this->lastname;
	}

	function setUsuario($usuario){
		$this->usuario=$usuario;
	}

	function getUsuario(){
		return $this->usuario;
	}

	function setEmail($email){
		$this->email = $email;
	}

	function getEmail(){
		return $this->email;
	}

	function setPassword($password){
		$this->password = $password;
	}

	function getPassword(){
		return $this->password;
	}

	function setEstado($estado){
		$this->estado = $estado;
	}

	function getEstado(){
		return $this->estado;
	}

	function setCambiaPwd($cambiapwd){
		$this->cambiapwd = $cambiapwd;
	}

	function getCambiaPwd(){
		return $this->cambiapwd;
	}


	function usuarioLogin($fields,$where){
		return $this->db->select1($fields,$this->tabla,$where);
	}

	function signInModel($array){
		return $this->db->insert($this->tabla,$array);
	}


	function listadoModel($fields,$orden){
		return json_encode($this->db->select2($fields,$this->tabla,$orden));
	}

	function existeModel($campo,$valor){
		return $this->db->existe($this->tabla,$campo,$valor);
	}

	function consultaModel(){
		return $this->db->consulta($this->tabla,"iduser,name,lastname,email,usuario,estado","idUser",$this->getIdUser());
	}

	function save(){
		$query="insert into ".$this->tabla."(name,lastname,usuario,email,password) values('".$this->name."','".$this->lastname."','".$this->usuario."','".$this->email."',pgp_sym_encrypt('".$this->password."','".KEY_DB."'))";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
	$query="update ".$this->tabla." set name='".$this->name."', lastname='".$this->lastname."', usuario='".$this->usuario."', email='".$this->email."', updated_at=now() ";
		if($this->cambiapwd=="1"){
			$query.=", password=pgp_sym_encrypt('123456','".KEY_DB."') ";
		}
		if($this->estado=="1"){
			$query.=", estado=true ";
		}else{
			$query.=", estado=false ";
		}
	$query.=" where iduser=".$this->iduser;

	return $this->db->ejecutaMdl($query);

	}

	function delete(){
		$query="update users set deleted=now(), estado=false where iduser=".$this->iduser;
		return $this->db->ejecutaMdl($query);
	}



}

?>