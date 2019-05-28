<?php

class Cargo_model extends Conexion {
	private $tabla = "cargo";
	private $id;
	private $id_entidad;
	private $descripcion;
	private $estatus;
	private $confianza;
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

	function getIdEntiad(){
		return $this->id_entidad;
	}

	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function setEstatus($estatus){
		$this->estatus = $estatus;
	}

	function getEstatus(){
		return $this->estatus;
	}

	function setConfianza($confianza){
		$this->confianza = $confianza;
	}

	function getConfianza(){
		return $this->confianza;
	}

	function setIdUser($id_user){
		$this->id_user = $id_user;
	}

	function getIdUser(){
		return $this->id_user;
	}

	function consultaModel(){
		return $this->db->select1("id_cargo, 
	              descripcion,
	              case 
	               when estatus=true then 1
	               when estatus=false then 0 
	               else 0
	              end as estatus,
	              case 
	               when confianza=true then 1
	               when confianza=false then 0
	               else 0
	              end as confianza ",$this->tabla,"id_cargo=$this->id");
	}

	function listadoModel($id_entidad){ 
	 $sql="select id_cargo, 
	              descripcion,
	              case 
	               when estatus=true then 'SI' 
	               when estatus=false then 'NO' 
	               else 'NO'
	              end as estatus,
	              case 
	               when confianza=true then 'SI' 
	               when confianza=false then 'NO'
	               else 'NO'
	              end as confianza 
	       from $this->tabla 
	       where id_entidad=$id_entidad 
	       order by descripcion ";
	return json_encode($this->db->ejecutaSQL($sql));
	}

	function save(){
		$query="insert into $this->tabla (id_entidad,descripcion,confianza,estatus,id_user) 
		      values ($this->id_entidad,'$this->descripcion',cast($this->confianza as boolean),cast($this->estatus as boolean),$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update $this->tabla set descripcion  = '$this->descripcion',
		                                estatus      = cast($this->estatus as boolean),
		                                confianza    = cast($this->confianza as boolean),
                                        updated_at   = now()
		        where id_cargo=$this->id ";
		return $this->db->ejecutaMdl($query);
	}

}

?>