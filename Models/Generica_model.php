<?php 

class Generica_model extends Conexion {
	private $tabla ="generica";
	private $id;
	private $id_partida;
	private $cod_generica;
	private $nombre;
	private $descripcion;
	private $id_usuario;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setIdPartida($id_partida){ $this->id_partida = $id_partida; }
	function getIdPartida(){ return $this->id_partida; }
	function setCodGenerica($cod_generica){ $this->cod_generica = $cod_generica; }
	function getCodGenerica(){ return $this->cod_generica; }
	function setNombre($nombre){ $this->nombre = $nombre; }
	function getNombre(){ return $this->nombre; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	function getDescripcion(){ return $this->descripcion; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }

	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"id_partida=$this->id_partida and cod_generica='$this->cod_generica'");
	}

	function consulta2Model(){
		return $this->db->select1("*",$this->tabla,"id_generica=$this->id");
	}

	function cargarCombo($fields,$condicion,$orden){
		return json_encode($this->db->select3($fields,$this->tabla,$condicion,$orden));
	}

	function concatenaCodigo($id_act,$id_partida,$id_generica){
		$query="select 1 as orden, s.cod_sector || '.' || p.cod_programa || '.' || o.cod_obra || '.' || 			a.cod_actividad  || '.' as codigo
				from actividad a 
				left join obra o on o.id_obra = a.id_obra 
				left join programa p on p.id_programa = o.id_programa 
				left join sector s on s.id_sector = p.id_sector 
				where a.id_actividad = $id_act 
				union 
				select 2 as orden, cod_partida || '.'  as codigo 
				from partida 
				where id_partida = $id_partida 
				union 
				select 3 as orden, cod_generica || '.' as codigo 
				from generica 
				where id_generica = $id_generica  
				order by orden ";
				return json_encode($this->db->ejecutaSQL($query));
	}

	function listadoModel($id_periodo){
		$query="select p.id_partida,
       					p.cod_partida,
       					p.nombre as partida,
       					g.id_generica,
       					g.cod_generica,  
       					g.nombre  
				from generica g 
				left join partida p on p.id_partida=g.id_partida 
				where p.id_periodo = $id_periodo
				order by  g.cod_generica ";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function save(){
		$query="insert into $this->tabla (cod_generica,nombre,descripcion,id_usuario,id_partida) 
		      values ('$this->cod_generica','$this->nombre','$this->descripcion',$this->id_usuario,$this->id_partida)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update $this->tabla set cod_generica='$this->cod_generica', nombre='$this->nombre',
		                           descripcion='$this->descripcion', id_usuario=$this->id_usuario ,
		                           updated_at = now() 
		        where id_especifica = $this->id ";
		return $this->db->ejecutaMdl($query);
	}

}

?>