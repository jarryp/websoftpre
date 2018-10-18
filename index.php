<?php

require "config.php";

$url=isset($_GET['url']) ?$_GET['url']:"Index/index";

$url=explode("/", $url);
$controller="";
$method="";
if(isset($url[0])){
	$controller=$url[0];
}
if(isset($url[1])){
		$method=$url[1];
}
if(isset($url[2])){
	if($url[1]!=''){
		$params=$url[2];
	}
}

spl_autoload_register( function($class){
	if(file_exists(LBS.$class.".php")){
		require LBS.$class.".php";
	}
});

//new Controllers();

$controllersPath ="Controllers/".$controller.".php";

if(file_exists($controllersPath)){
	require $controllersPath;
	$controller= new $controller();

		if(method_exists($controller, $method)){

			if(isset($params)){
				$controller->{$method}($params);
			}else{
				$controller->{$method}();
			}

		}else{
			echo "<br>Metodo no Existe";
		}

}else{
	echo "no existe Controlador";
}

//print($controllersPath);



?>