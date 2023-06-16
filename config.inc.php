<?php
/*
Definicion de valores para la base de datos
*/
if(!defined("DB_USER")) define("DB_USER", "root");
//Contraseña de acceso
if(!defined("PASSWORD")) define("PASSWORD", "");
//Schema o Base de datos por omisión
if(!defined("DATABASE")) define("DATABASE", "TallerMecanico");

ini_set('error_log',"C:/xampp/htdocs/upiicsa/proyecto/errores/php_errors.log"); 

ini_set("date.timezone", "America/Mexico_City");
?>