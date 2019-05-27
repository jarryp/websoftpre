<?php

class Nivelacad_model extends Conexion {
	private $tabla="nivel_academico";
	private $id;
	private $id_entidad;
	private $descripcion;
	private $formula;
	private $id_user;

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

	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function setFormula($formula){
		$this->formula = $formula;
	}

	function getFormula(){
		return $this->formula;
	}

	function setIdUser($id_user){
		$this->id_user = $id_user;
	}

	function getIdUser(){
		return $this->id_user;
	}

	function consultaModel(){
		return $this->db->select1("id_nivel_academico, descripcion, formula",$this->tabla,"id_nivel_academico=$this->id");
	}

	function listadoModel($id_entidad){ 
	 $sql="select * from $this->tabla where id_entidad=$id_entidad order by descripcion ";
	 return json_encode($this->db->ejecutaSQL($sql));
	}

	function save(){
		$query="insert into $this->tabla (id_entidad,descripcion,formula,id_user) 
		      values ($this->id_entidad,'$this->descripcion',$this->formula,$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update $this->tabla set descripcion  = '$this->descripcion',
		                                formula      = $this->formula,
                                        updated_at   = now()
		        where id_nivel_academico=$this->id ";
		return $this->db->ejecutaMdl($query);
	}


}

?>