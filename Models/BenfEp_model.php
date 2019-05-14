<?php
class BenfEp_model extends Conexion {
    private $tabla="benfep";
    private $id;
    private $id_entidad;
    private $id_user;
    private $nombre;
    
    function setId($id){
        $this->id = $id;
    }
    
    function getId(){
        return $this->id;
    }
    
    function setNombre($nombre){
        $this->nombre=$nombre;
    }
    
    function getNombre(){
        return $this->nombre;
    }
    
    function setIdEntidad($id_entidad){
        $this->id_entidad = $id_entidad;
    }
    
    function getIdEntidad(){
        return $this->id_entidad;
    }
    
    function setIdUser($id_user){
        $this->id_user = $id_user;
    }
    
    function getIdUser(){
        return $this->id_userM
    }
    
    function listadoModel($fields,$orden){ 
	  return json_encode($this->db->select3($fields,$this->tabla," id_entidad=".ID_ENTIDAD,$orden)); 
	}
    
    function save(){
		$query="insert into $this->tabla (id_entidad,nombre,id_user) 
		      values ($this->id_entidad,'$this->nombre',$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}
    
    function update(){
		$query="update $this->tabla set nombre='$this->nombre', id_user=$this->id_user updated_at = now()
		        where id_benfep=$this->id ";
		return $this->db->ejecutaMdl($query);
	}
    
    
}
?>