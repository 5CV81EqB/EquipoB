<?php

include_once("database.php");

$db = new database();
if (isset($_GET['funcion'])) {
    $funcion = $_GET['funcion'];

    $query = "select id_cliente as id, nombre_cliente as Nombre,apellidoP_cliente as 'Apellido_p',
        apellidoM_cliente as 'Apellido_M',Fec_nacimiento as 'Fecha_de_nacimiento',correo,calle,cp,municipio,estado from cliente;";
    $resultado = $db->query($query);

    // Prepara el array para almacenar los datos
    $data = array();

    // Itera sobre los resultados y almacena los datos en el array
    while ($row = mysqli_fetch_assoc($resultado)) {
        $data[] = $row;
    }

    // Devuelve los datos en formato JSON
    echo json_encode($data);
}

if (isset($_POST['funcion'])) {
    $funcionp = $_POST['funcion'];
    switch ($funcionp) {
        case 'insert': {
                $datos = $_POST['datos'];

                // Deserializar los datos en un array
                $datos_array = array();

                parse_str($datos, $datos_array);
                $nombre = $datos_array['nombre'];
                $app = $datos_array['app'];
                $apm = $datos_array['app'];
                $fecnac = $datos_array['fecnac'];
                $correo = $datos_array['correo'];
                $calle = $datos_array['calle'];
                $cp = $datos_array['cp'];
                $int = (int) $cp;
                $munic = $datos_array['munic'];
                $estado = $datos_array['estado'];
                $maxindex = "SELECT MAX(id_cliente) as id_cliente FROM cliente;";
                $max = $db->query($maxindex);

                $maxn = $max->fetch_assoc();
                $id = $maxn['id_cliente'] + 1;

                $qry = "insert into cliente(id_cliente,nombre_cliente,apellidoP_cliente,apellidoM_cliente,Fec_nacimiento,correo,calle,cp,municipio,estado)
        values('$id','$nombre','$app','$apm','$fecnac','$correo','$calle','$int','$munic','$estado');";
                $resultado = $db->query($qry);

            }
            break;

        case 'update': {
                $datos = $_POST['datos'];

                // Deserializar los datos en un array
                $datos_array = array();

                parse_str($datos, $datos_array);
                $id = $datos_array['id_cliente'];
                $nombre = $datos_array['nombre'];
                $app = $datos_array['app'];
                $apm = $datos_array['app'];
                $fecnac = $datos_array['fecnac'];
                $correo = $datos_array['correo'];
                $calle = $datos_array['calle'];
                $cp = $datos_array['cp'];
                $int = (int) $cp;
                $munic = $datos_array['munic'];
                $estado = $datos_array['estado'];
                $qry = "UPDATE cliente
                    SET nombre_cliente = '$nombre',
                    apellidoP_cliente = '$app',
                    apellidoM_cliente = '$apm',
                    Fec_nacimiento = '$fecnac',
                    correo = '$correo',
                    calle = '$calle',
                    cp = '$int',
                    municipio = '$munic',
                    estado = '$estado'
                    WHERE id_cliente = '$id' ";
            }
            break;

        case 'delete': {
                $codigo = "NO";
                $datos = $_POST['datos'];

                // Deserializar los datos en un array
                $datos_array = array();

                parse_str($datos, $datos_array);
                $id = $datos_array['id_cliente'];

                $qry = "DELETE From Cliente
                    WHERE id_cliente = '$id' ";
                try {
                    $resultado = $db->query($qry);
                    $response = 'El registro se elimino correctamente';
                } catch (Exception $e) {
                    $response = 'Existe un error al eliminar al cliente';
                }
                echo json_encode($response);
            }
            break;
    }
}
?>