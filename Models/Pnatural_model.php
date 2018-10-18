<?php

class Pnatural_model extends Conexion {

	private $tabla ="pnatural";
	private $id;
	private $id_entidad;
	private $cedula;
	private $nombres;
	private $apellidos;
	private $telefono;
	private $email;
	private $direccion;
	private $id_usuario;

	function setId($id){
		$this->id = $id;
	}

	function getId(){
		return $this->id;
	}

	function setIdEntidad($id_entidad){
		$this->id_entidad = $id_entidad;
	}

	function getIdEntidad(){
		return $this->id_entidad;
	}

	function setCedula($cedula){
		$this->cedula = $cedula;
	}

	function getCedula(){
		return $this->cedula;
	}

	function setNombres($nombres){
		$this->nombres = $nombres;
	}

	function getNombres(){
		return $this->nombres;
	}

	function setApellidos($apellidos){
		$this->apellidos = $apellidos;
	}

	function getApellidos(){
		return $this->apellidos;
	}

	function setTelefono($telefono){
		$this->telefono = $telefono;
	}

	function getTelefono(){
		return $this->telefono;
	}

	function setEmail($email){
		$this->email =  $email;
	}

	function getEmail(){
		return $this->email;
	}

	function setDireccion($direccion){
		$this->direccion = $direccion;
	}

	function getDireccion(){
		return $this->direccion;
	}

	function setIdUsuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	function getIdUsuario(){
		return $this->id_usuario;
	}

	function consultaModel(){
		return $this->db->consulta($this->tabla,"id,id_entidad,cedula,nombres,apellidos,telefono,email,direccion,id_usuario","id",$this->getId());
	}

	function listadoModel($fields,$orden){
		return json_encode($this->db->select3($fields,$this->tabla," id_entidad=".ID_ENTIDAD,$orden));
	}


	function save(){
		$response = $this->db->select1("*",$this->tabla,"id_entidad=$this->id_entidad and cedula='$this->cedula'");
		if($response==NULL){
			$query="insert into pnatural (id_entidad,cedula,nombres,apellidos,telefono,email,direccion,id_usuario) 
			     values ($this->id_entidad,'$this->cedula','$this->nombres','$this->apellidos','$this->telefono','$this->email','$this->direccion',$this->id_usuario) ";
			 if($this->db->ejecutaMdl($query)){
			 	return "1";
			 }else{
			 	return "2";
			 }
		}else{
			return "2"; //registro de juridico existente para esta entidad
		}
	}

	function update(){
		$query="update pnatural set nombres='$this->nombres', apellidos='$this->apellidos',telefono='$this->telefono', email='$this->email', direccion='$this->direccion', id_usuario=$this->id_usuario , updated_at=now() 
		        where id=$this->id";
	    if($this->db->ejecutaMdl($query)){
	    	return "1";
	    }else{
	    	return "2";
	    }
	}


}

?>