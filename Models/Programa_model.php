<?php

class Programa_model extends Conexion {
	private $tabla="programa";
	private $id;
	private $id_sector;
	private $cod_programa;
	private $nombre;
	private $descripcion;
	private $id_usuario;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setIdSector($id_sector){ $this->id_sector = $id_sector; }
	function getIdSector(){ return $this->id_sector; }
	function setCodPrograma($cod_programa){ $this->cod_programa = $cod_programa; }
	function getCodPrograma(){ return $this->cod_programa; }
	function setNombre($nombre){ $this->nombre = $nombre; }
	function getNombre(){ return $this->nombre; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	function getDescripcion(){ return $this->descripcion; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }
	
	function listadoModel($id_periodo){
		$query="select  pr.id_programa, 
		                pr.cod_programa, 
       					pr.nombre as programa,
       					s.cod_sector , 
       					s.nombre as sector 
				from programa pr 
					left join sector s on s.id_sector=pr.id_sector 
					left join periodo p on p.id_periodo = s.id_periodo 
				where s.id_periodo = $id_periodo order by s.cod_sector, pr.cod_programa " ;
		return json_encode($this->db->ejecutaSQL($query));
	}

	function consultaModel(){
		return $this->db->consulta($this->tabla,"*","id_programa",$this->getId());
	}

	function consulta2Model(){
		$query="select * from $this->tabla where id_sector=$this->id_sector and cod_programa='$this->cod_programa'";	
		return $this->db->ejecutaSQL($query);
	}

	function cargarCombo($fields,$condicion,$orden){
		return json_encode($this->db->select3($fields,$this->tabla,$condicion,$orden));
	}

	function save(){
		$query="insert into programa(id_sector,cod_programa,nombre,descripcion,id_usuario) 
		values ($this->id_sector,'$this->cod_programa','$this->nombre','$this->descripcion',$this->id_usuario);";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update programa set nombre='$this->nombre', descripcion='$this->descripcion', id_usuario=$this->id_usuario, updated_at=now() 
		    where id_programa=$this->id";
		return $this->db->ejecutaMdl($query);
	}

}

?>