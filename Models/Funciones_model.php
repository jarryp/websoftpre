<?php

class Funciones_model extends Conexion {

    function nombreBeneficiario($id_entidad,$id_tipo,$codigo){
        $sql=" select * from 
               (select 1 as id_tipo_beneficiario,'Juridico' as tipo , rif as codigo, nombre 
                from juridico 
                where id_entidad = $id_entidad 
                union 
                select 2 as id_tipo_beneficiario,'Natural' as tipo,cedula as id ,trim(nombres) || ' ' || trim(apellidos) as nombre 
                from pnatural   
                where id_entidad = $id_entidad 
                union 
                select 3 as id_tipo_beneficiario,'Interno' as tipo, id_interno::character(10) as id_interno, descripcion as nombre 
                from interno 
                where id_entidad = $id_entidad ) as a 
                where id_tipo_beneficiario=$id_tipo and codigo='$codigo'"; 
         return $this->db->ejecutaSQL($sql);       
    }

    function listaBeneficiarios($id_entidad){ 
        $sql="select 1 as id_tipo_beneficiario,'Juridico' as tipo , rif as codigo, nombre 
                from juridico 
                where id_entidad = $id_entidad 
                union 
                select 2 as id_tipo_beneficiario,'Natural' as tipo,cedula as id ,trim(nombres) || ' ' || trim(apellidos) as nombre 
                from pnatural   
                where id_entidad = $id_entidad 
                union 
                select 3 as id_tipo_beneficiario,'Interno' as tipo, id_interno::character(10) as id_interno, descripcion as nombre 
                from interno 
                where id_entidad = $id_entidad 
                order by tipo, nombre ";
        return json_encode($this->db->ejecutaSQL($sql));
        
    }

}
?>