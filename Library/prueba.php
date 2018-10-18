<?php

  $HOST="localhost";
  $USER="root";
  $PASS="123456";
  $NAME="users";
  if($link = new mysqli($HOST,$USER,$PASS,$NAME)){
  	echo "Conecta a la Base de Datos...";

  	if(mysqli_connect_errno()){
			printf("Fallo de Conexión: %s\n",mysqli_connect_errno());
			exit();
		}



  }else{
  	echo "ERROR DE CONEXION A LA BASE DE DATOS";
  }

?>