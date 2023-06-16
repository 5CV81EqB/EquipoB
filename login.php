<?php
session_start();
include_once("config.inc.php");
include_once('clases/usuarios.php');
$user = new usuarios();

if (isset($_POST['user_name']) && isset($_POST['user_password'])) {
    $usuario = $_POST['user_name'];
    $password = $_POST['user_password'];
    $res_login = $user->login($usuario, $password);
    if (!$res_login) {
        $mensaje = "Usuario o contrase&ntilde;a incorrectos...";
        echo'<script type="text/javascript">
    alert("'.$mensaje.'");
    </script>';
        
    }
}
if (isset($_SESSION["usuario_sesion"])) {
    if (!is_null($_SESSION["usuario_sesion"])) {
        $page = isset($_POST['r']) ? $_POST['r'] : "index";
        header("Location: $page.php");
        exit;
    } //if
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">

    <title>Acceso Administrador</title>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">

    </style>

    <script type="text/javascript">

    </script>

</head>

<body>

    <div id="contenedor">

        <div id="contenedorcentrado">
            <div id="login">
                <form method="post">
                    <label for="user_name">Usuario</label>
                    <input  name="user_name" id="user_name" type="text"  placeholder="Usuario" required>

                    <label for="user_password">Contraseña</label>
                    <input name="user_password" id="user_password" type="password" placeholder="Contraseña" required>

                    <button type="submit" title="Ingresar" name="Ingresar">Login</button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>