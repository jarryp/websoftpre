<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php header('Access-Control-Allow-Origin: *'); ?>

	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	
	<!-- ICLUYE HOJAS DE ESTILO-->
	<link rel="stylesheet" href="<?php echo URL.VIEWS.DFT?>css/bootstrap.css">
	 <!-- FontAwesome Styles-->
    <link rel="stylesheet" href="<?php echo URL.VIEWS.DFT?>css/font-awesome.css" />
    <!-- Morris Chart Styles-->
    <link rel="stylesheet" href="<?php echo URL.VIEWS.DFT?>js/morris/morris-0.4.3.min.css" />
    <!-- Custom Styles-->
    <link rel="stylesheet" href="<?php echo URL.VIEWS.DFT?>css/custom-styles.css" />
     <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- Estilos para dataTables-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL.VIEWS.DFT?>js/dataTables/dataTables.bootstrap.css">
    <!-- Estilos propios-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL.VIEWS.DFT?>css/style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo URL.VIEWS.DFT?>css/jquery.dataTables.min.css">
    
    <!-- jQuery Js -->
    <script src="<?php echo URL.VIEWS.DFT; ?>js/jquery-3.1.1.min.js"></script>

	
    <!-- JS Scripts-->
 <!-- Bootstrap Js -->
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/bootstrap.min.js"></script>
  <!-- Metis Menu Js -->
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/jquery.metisMenu.js"></script>

 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/bootstrap.bundle.js"></script>
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/dataTables/jquery.dataTables.js"></script>
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/dataTables/dataTables.bootstrap.js"></script>
 <!-- Morris Chart Js -->
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/morris/raphael-2.1.0.min.js"></script>
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/morris/morris.js"></script>
 <!-- Custom Js -->
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/custom-scripts.js"></script>
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/jquery.validate.js"></script>
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/funciones.js"></script>
 <script type="text/javascript" src="<?php echo URL.VIEWS.DFT; ?>js/jquery.dataTables.min.js"></script>

    
	<title><?php echo SITE_NAME;?></title>
</head>
<body>
<div id="wrapper">



<?php
 error_reporting(E_ALL ^ E_NOTICE);
 Session::start();
 $idUser = Session::getSession("idUser");
 $Usuario   = Session::getSession("Usuario");
 if($Usuario != ""){
?>



<?php } ?>
