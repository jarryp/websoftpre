<?php

class Departamento_model extends Conexion {
	private $tabla="departamento";
	private $id;
	private $id_entidad;
	private $nombre;
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

	function setNombre($nombre){
		$this->nombre = $nombre;
	}

	function getNombre(){
		return $this->nombre;
	}

	function setIdUser($id_user){
		$this->id_user = $id_user;
	}

	function getIdUser(){
		return $this->id_user;
	}

	function consultaModel(){
		return $this->db->select1("id_departamento, nombre",$this->tabla,"id_departamento=$this->id");
	}

	function listadoModel($id_entidad){ 
	 $sql="select * from $this->tabla where id_entidad=$id_entidad order by nombre ";
	return json_encode($this->db->ejecutaSQL($sql));
	}


	function save(){
		$query="insert into $this->tabla (id_entidad,nombre,id_user) 
		      values ($this->id_entidad,'$this->nombre',$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update $this->tabla set nombre  = '$this->nombre',
                                        updated_at  = now()
		        where id_departamento=$this->id ";
		return $this->db->ejecutaMdl($query);
	}

}

?>