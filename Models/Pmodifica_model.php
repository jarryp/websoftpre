<?php

class Pmodifica_model extends Conexion {
	private $tabla = "pmodifica";
	private $id;
	private $id_soportel;
	private $id_especifica;
	private $id_tipo_modif;
	private $monto;
	private $id_usuario;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setIdSoportel($id_soportel){ $this->id_soportel = $id_soportel; }
	function getIdSoportel(){ return $this->id_soportel; }
	function setIdEspecifica($id_especifica){ $this->id_especifica = $id_especifica; }
	function getIdEspecifica(){ return $this->id_especifica; }
	function setIdTipoModif($id_tipo_modif){ $this->id_tipo_modif = $id_tipo_modif; }
	function getIdTipoModif(){ return $this->id_tipo_modif; }
	function setMonto($monto){ $this->monto = $monto; }
	function getMonto(){ return $this->monto; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }

	
	function listaModel(){
		$query="select e.cod_especifica, 
       				   e.nombre, 
       				   d.monto 
				from pmodifica d 
				left join especifica e on e.id_especifica = d.id_especifica 
				where d.id_soportel = $this->id ;" ;
		return json_encode($this->db->ejecutaSQL($query));
	}

	function listaTrasladosModel(){
		$query="select e.cod_especifica, 
       				   e.nombre, 
       				   d.monto 
				from pmodifica d 
				left join especifica e on e.id_especifica = d.id_especifica 
				where d.id_soportel = '$this->id' and id_tipo_modif='$this->id_tipo_modif';" ;
		return json_encode($this->db->ejecutaSQL($query));
	}


	function limpiaMod(){
		$query="delete from pmodifica where id_soportel='$this->id_soportel';";
		 return $this->db->ejecutaMdl($query);
	}

	function save(){
		$query="insert into $this->tabla (id_soportel,id_especifica,id_tipo_modif,monto,id_usuario) 
		       values ('$this->id_soportel','$this->id_especifica','$this->id_tipo_modif',$this->monto,'$this->id_usuario');";
		 return $this->db->ejecutaMdl($query);
	}




}

?>