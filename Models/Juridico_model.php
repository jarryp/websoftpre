<?php

class Juridico_model extends Conexion {
	private $tabla="juridico";
	private $id;
	private $id_entidad;
	private $rif;
	private $nombre;
	private $telefono;
	private $email;
	private $direccion;
	private $id_usuario;


	function setId($id){
		$this->id=$id;
	}

	function getId(){
		return $this->id;
	}

	function setIdEntidad($id_entidad){
		$this->id_entidad = $id_entidad;
	}

	function getIdEntidad(){
		return $id_entidad;
	}

	function setRif($rif){
		$this->rif=$rif;
	}

	function getRif(){
		return $this->rif;
	}

	function setNombre($nombre){
		$this->nombre=$nombre;
	}

	function getNombre(){
		return $this->nombre;
	}

	function setTelefono($telefono){
		$this->telefono=$telefono;
	}

	function getTelefono(){
		return $this->telefono;
	}

	function setEmail($email){
		$this->email = $email;
	}

	function getEmail(){
		return $this->email;
	}

	function setDireccion($direccion){
		$this->direccion=$direccion;
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

	function listadoModel($fields,$orden){
		return json_encode($this->db->select3($fields,$this->tabla," id_entidad=".ID_ENTIDAD,$orden));
	}


	function consultaModel(){
		return $this->db->consulta($this->tabla,"id,id_entidad,rif,nombre,telefono,email,direccion,id_usuario","id",$this->getId());
	}

	function save(){
		$response = $this->db->select1("*",$this->tabla,"id_entidad=$this->id_entidad and rif='$this->rif'");
		if($response==NULL){
			$query="insert into juridico (id_entidad,rif,nombre,telefono,email,direccion,id_usuario) 
			     values ($this->id_entidad,'$this->rif','$this->nombre','$this->telefono','$this->email','$this->direccion',$this->id_usuario) ";
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
		$query="update juridico set nombre='$this->nombre', telefono='$this->telefono', 
		                            email='$this->email', direccion='$this->direccion',
		                            id_usuario=$this->id_usuario , updated_at=now() 
		        where id=$this->id";
	    if($this->db->ejecutaMdl($query)){
	    	return "1";
	    }else{
	    	return "2";
	    }
	}


}

?>