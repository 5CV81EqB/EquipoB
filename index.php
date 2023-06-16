<?php
	include_once("config.inc.php");
	include_once("clases/usuarios.php");
	$user=new usuarios();
     if(!isset($_SESSION)){
        header('Location: index.php');
        exit();
	}
    $opcion = isset($_GET['op']) ? $_GET['op'] : 'index';
	$php_file = $opcion . ".php";
	$template = $opcion . ".html";
    include($template);
    
?>