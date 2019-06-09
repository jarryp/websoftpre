<?php 

class Funciones extends Controllers {

    function __construct(){
		parent::__construct();
	}

    function getNombreBeneficiario(){
    $res = $this->model->nombreBeneficiario($_REQUEST['id_entidad'],$_REQUEST['id_tipo_benf'],$_REQUEST['id_beneficiario']);
    $res = $res[0];
        if($res!=NULL){
            echo "A#".$res['nombre'];
        }else{
            echo "B#";
        }
    } 

    function saluda(){
        echo "Hola desde la clase funciones";
    }


    function listaBeneficiarios(){
		echo $this->model->listaBeneficiarios($_REQUEST['id_entidad']);

    }

}

?>