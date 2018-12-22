<?php

class Especifica_model extends Conexion {
	private $tabla="especifica";
	private $id;
	private $cod_especifica;
	private $id_actividad;
	private $id_generica;
	private $nombre;
	private $descripcion;
	private $id_fuentefinan;
	private $montoi;
	private $id_periodo;
	private $id_usuario;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setCodEspecifica($cod_especifica){ $this->cod_especifica = $cod_especifica; }
	function getCodEspecifica(){ return $this->cod_especifica; }
	function setIdActividad($id_actividad){ $this->id_actividad = $id_actividad; }
	function getIdActividad(){ return $this->id_actividad; }
	function setIdGenerica($id_generica){ $this->id_generica = $id_generica; }
	function getIdGenerica(){ return $this->id_generica; }
	function setNombre($nombre){ $this->nombre = $nombre; }
	function getNombre(){ return $this->nombre; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	function getDescrripcion(){ return $this->descripcion; }
	function setMontoi($montoi){ $this->montoi = $montoi; }
	function getMontoi(){return $this->montoi; }
	function setIdFuenteFinan($id_fuentefinan){ $this->id_fuentefinan = $id_fuentefinan; }
	function getIdFuenteFinan(){ return $this->id_fuentefinan; }
	function setIdPeriodo($id_periodo){ $this->id_periodo = $id_periodo; }
	function getIdPeriodo(){ return $this->id_periodo; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }

	
	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"cod_especifica='$this->cod_especifica' and id_periodo='$this->id_periodo'");
	}

	function consulta2Model(){
		return $this->db->select1("*",$this->tabla,"id_especifica=$this->id");
	}

	function obtenerId(){
		$columnas="id_especifica ";
		$condicion = " cod_especifica='$this->cod_especifica' and id_periodo='$this->id_periodo' ";
		$orden = "id_especifica";
		return $this->db->select3($columnas,$this->tabla,$condicion,$orden);
	}

	function listadoModel($id_periodo){
		$query="select id_especifica,
		               cod_especifica,
		               nombre,
		               montoi 
		        from $this->tabla 
		        where id_periodo=$id_periodo 
		        order by cod_especifica";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function listadoPorPartida($cod_partida){
		$query="select id_especifica, cod_especifica, nombre
				from especifica 
				where substring(cod_especifica,13,4)='$cod_partida'
				order by cod_especifica";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function lfiltroModel(){
		$query="select cod_especifica , nombre 
				from especifica 
				where cod_especifica like '%$this->cod_especifica%' or 
      			upper(trim(nombre)) like '%".strtoupper($this->cod_especifica)."%'";
		return json_encode($this->db->ejecutaSQL($query));	
	}

	function muestraNombres($codigo,$id_periodo){
        $cod_sector    = substr($codigo, 0,2);
        $cod_programa  = substr($codigo, 3,2);
        $cod_obra      = substr($codigo, 6,2);
        $cod_actividad = substr($codigo, 9,2);
        $cod_partida   = substr($codigo, 12,4);
        $cod_generica  = substr($codigo, 17,2);
		$query="select 1 as orden, 'Sector: ' as atributo, nombre 
				from sector where cod_sector='$cod_sector' and id_periodo='$id_periodo'
				union 
				select 2 as orden, 'Programa: ' as atributo, p.nombre 
				from programa p
				left join sector s on s.id_sector=p.id_sector 
				where p.cod_programa='$cod_programa' and s.id_periodo='$id_periodo' and s.cod_sector='$cod_sector' 
				union 
				select 3 as orden, 'Obra: ' as atributo, o.nombre 
				from obra o 
				left join programa p on o.id_programa = p.id_programa 
				left join sector s on s.id_sector = p.id_sector 
				where o.cod_obra='$cod_obra' and p.cod_programa='$cod_programa' and s.cod_sector='$cod_sector' and s.id_periodo='$id_periodo'
				union 
				select 4 as orden, 'Actividad: ' as atributo, a.nombre 
				from actividad a
				left join obra o on o.id_obra = a.id_obra  
				left join programa p on o.id_programa = p.id_programa 
				left join sector s on s.id_sector = p.id_sector 
				where a.cod_actividad='$cod_actividad' and o.cod_obra='$cod_obra' and p.cod_programa='$cod_programa' and s.cod_sector='$cod_sector' and s.id_periodo='$id_periodo' 
				union 
				select 5 as orden, 'Partida: ' as atributo, p.nombre 
				from partida p
				where p.cod_partida='$cod_partida' and p.id_periodo='$id_periodo'
				union 
				select 6 as orden, 'Generica: ' as atributo, g.nombre 
				from generica g 
				left join partida p on p.id_partida = g.id_partida 
				where cod_generica ='$cod_generica' and p.cod_partida='$cod_partida' and p.id_periodo='$id_periodo'
				order by orden ";
				return json_encode($this->db->ejecutaSQL($query));
	}

	function save(){
		$query="insert into $this->tabla (cod_especifica,nombre,descripcion,montoi,id_usuario,id_periodo,id_actividad, id_generica,id_fuentefinan) 
		      values ('$this->cod_especifica','$this->nombre','$this->descripcion',$this->montoi,$this->id_usuario,$this->id_periodo,$this->id_actividad,$this->id_generica,$this->id_fuentefinan)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update $this->tabla set cod_especifica='$this->cod_especifica', nombre='$this->nombre',
		                           descripcion='$this->descripcion', id_usuario=$this->id_usuario ,
		                           montoi=$this->montoi, id_fuentefinan=$this->id_fuentefinan , updated_at = now()
		        where id_especifica=$this->id ";
		return $this->db->ejecutaMdl($query);
	}


}

?>