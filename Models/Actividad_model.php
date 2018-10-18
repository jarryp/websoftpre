<?php

class Actividad_model extends Conexion {
	private $tabla="actividad";
	private $id;
	private $id_obra;
	private $cod_act;
	private $nombre;
	private $descripcion;
	private $id_usuario;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setIdObra($id_obra){$this->id_obra = $id_obra;}
	function getIdObra(){ return $this->id_obra; }
	function setCodAct($cod_act){ $this->cod_act = $cod_act; }
	function getCodAct(){ return $this->cod_act; }
	function setNombre($nombre){ $this->nombre = $nombre; }
	function getNombre(){ return $this->nombre; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	function getDescripcion(){ return $this->descripcion; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }

	function consultaModel(){
		$query="select * from $this->tabla 
		        where id_obra=$this->id_obra and 
		              cod_actividad='$this->cod_act'";	
		return $this->db->ejecutaSQL($query);
	}

	function consulta2Model(){
		$query="select a.id_actividad,
       			a.cod_actividad,
       			a.nombre, 
       			a.descripcion, 
        		pr.id_periodo,
				pr.descripcion as periodo,
       			s.id_sector,
       			s.cod_sector,
       			s.nombre as sector,
       			p.id_programa,
       			p.cod_programa,
       			p.nombre as programa , 
       			o.id_obra ,
       			o.cod_obra, 
       			o.nombre as obra 
			from actividad a
			left join obra o on o.id_obra = a.id_obra  
			left join programa p on p.id_programa = o.id_programa 
			left join sector s on s.id_sector = p.id_sector 
			left join periodo pr on pr.id_periodo = s.id_periodo 
			where a.id_actividad = $this->id 
			order by cod_sector, cod_programa , cod_obra , cod_actividad " ;
		return $this->db->ejecutaSQL($query);
	}

	function listadoModel($id_periodo){
		$query="select a.id_actividad,
       			a.cod_actividad,
       			a.nombre, 
        		pr.id_periodo,
				pr.descripcion as periodo,
       			s.id_sector,
       			s.cod_sector,
       			s.nombre as sector,
       			p.id_programa,
       			p.cod_programa,
       			p.nombre as programa , 
       			o.id_obra ,
       			o.cod_obra, 
       			o.nombre as obra 
			from actividad a
			left join obra o on o.id_obra = a.id_obra  
			left join programa p on p.id_programa = o.id_programa 
			left join sector s on s.id_sector = p.id_sector 
			left join periodo pr on pr.id_periodo = s.id_periodo 
			where pr.id_periodo = $id_periodo 
			order by cod_sector, cod_programa , cod_obra , cod_actividad ";

		return json_encode($this->db->ejecutaSQL($query));

	}

	function save(){
		$query="insert into actividad(id_obra,cod_actividad,nombre,descripcion,id_usuario) 
		values ($this->id_obra,'$this->cod_act','$this->nombre','$this->descripcion',$this->id_usuario);";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update actividad set nombre='$this->nombre', descripcion='$this->descripcion', id_usuario=$this->id_usuario, updated_at=now() 
		    where id_actividad = $this->id";
		return $this->db->ejecutaMdl($query);
	}



}

?>