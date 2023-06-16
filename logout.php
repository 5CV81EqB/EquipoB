<?php
include_once('clases/usuarios.php');
$user = new usuarios();
$user->logout();
header("Location: index.php");
?>