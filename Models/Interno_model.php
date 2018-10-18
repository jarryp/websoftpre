<?php

class Interno_model extends Conexion {
	private $tabla="interno";
	private $id;
	private $descripcion;
	private $id_entidad;
	private $iduser;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion ; }
	function getDescripcion(){ return $this->descripcion; }
	function setIdEntidad($id_entidad){ $this->id_entidad = $id_entidad; }
	function getIdEntidad(){ return $this->id_entidad; }
	function setIdUser($iduser){ $this->iduser = $iduser; }
	function getIdUser(){ return $this->iduser; }
	
	function listadoModel($fields,$orden){ 
	  return json_encode($this->db->select3($fields,$this->tabla," id_entidad=".ID_ENTIDAD,$orden)); 
	}
	function consultaModel(){
	  return $this->db->consulta($this->tabla,"*","id_interno",$this->getId());
	}
	function save(){
		$response = $this->db->select1("*",$this->tabla,"id_entidad=$this->id_entidad and id_interno='$this->id'");
		if($response==NULL){
			$query="insert into interno (id_entidad,descripcion,iduser) 
			     values ($this->id_entidad,'$this->descripcion',$this->iduser) ";
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
		$query="update interno set descripcion='$this->descripcion', iduser=$this->iduser , updated_at=now() 
		        where id_interno=$this->id";
	    if($this->db->ejecutaMdl($query)){
	    	return "1";
	    }else{
	    	return "2";
	    }
	}
}

?>