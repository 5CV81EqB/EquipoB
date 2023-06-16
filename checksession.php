<?php
include("clases/usuarios.php");
if(!isset($_SESSION["usuario_sesion"])){
    echo "false";
}else{
    echo "true";
}
?>