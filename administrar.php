<?php
	include_once("config.inc.php");
	include_once("clases/usuarios.php");
	$user=new usuarios();
     if(!isset($_SESSION)){
        header('Location: index.php');
        exit();
	}
	include("complementos/header.html");
    include("complementos/administrar.html");
    
?>