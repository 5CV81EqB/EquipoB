<?php

include_once("database.php");

$db = new database();
if (isset($_GET['funcion'])) {
    $funcion = $_GET['funcion'];
    switch ($funcion) {
        case 'select': {
                $datos = $_GET['id'];


                $consulta = "select am.matricula,am.modelo,am.anio,am.color,am.fecha_entrada from automovil am inner join cliente cl on am.id_cliente = cl.id_cliente AND am.id_cliente = $datos";
                $resultado = $db->query($consulta);
                // Prepara el array para almacenar los datos
                $data = array();

                // Itera sobre los resultados y almacena los datos en el array
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $data[] = $row;
                }

                // Devuelve los datos en formato JSON
                echo json_encode($data);
            }
            break;
        case 'cliente': {

                $consulta = "Select concat(Nombre_cliente ,' ',apellidoP_cliente ,' ',apellidoM_cliente) as nombre FROM cliente order by id_cliente";
                $resultado = $db->query($consulta);

                // Verificar si hay resultados
                if ($resultado->num_rows > 0) {
                    // Crear el contenido HTML para las opciones del select
                    $opciones = '';

                    // Iterar sobre los resultados y agregar las opciones al contenido HTML
                    $i = 0;
                    $opciones .= "<option value='' selected='true' disabled='disabled'>Selecciona un cliente</option>";
                    while ($row = $resultado->fetch_assoc()) {

                        $nombre = $row['nombre'];
                        $opciones .= "<option value='$i'>$nombre</option>";
                        $i = $i + 1;
                    }

                    // Devolver el contenido HTML de las opciones
                    echo $opciones;
                } else {
                    echo "<option value=''>No se encontraron resultados</option>";
                }
            }
            break;
    }
}


if (isset($_POST['funcion'])) {
    $funcionp = $_POST['funcion'];
    switch ($funcionp) {
        case 'insert': {
                $datos = $_POST['datos'];
                $id = $_POST['id'];


                // Deserializar los datos en un array
                $datos_array = array();

                parse_str($datos, $datos_array);
                $matricula = $datos_array['matricula'];
                $modelo = $datos_array['modelo'];
                $anio = $datos_array['anio'];
                $color = $datos_array['color'];
                $fecha_entrada = $datos_array['fecha_entrada'];
                $qry = "insert into automovil(Matricula,id_cliente,modelo,anio,color,fecha_entrada)
        VALUES('$matricula','$id','$modelo','$anio','$color','$fecha_entrada');";
                $resultado = $db->query($qry);
            }
            break;

        case 'update': {
                $datos = $_POST['datos'];
                $id = $_POST['id'];

                // Deserializar los datos en un array
                $datos_array = array();

                parse_str($datos, $datos_array);
                $matricula = $datos_array['matricula'];
                $modelo = $datos_array['modelo'];
                $anio = $datos_array['anio'];
                $color = $datos_array['color'];
                $fecha_entrada = $datos_array['fecha_entrada'];
                $qry = "UPDATE automovil
                    SET modelo = '$modelo',
                    anio = '$anio',
                    color = '$color',
                    fecha_entrada = '$fecha_entrada'
                    WHERE matricula = '$matricula' AND id_cliente = '$id' ";
                $resultado = $db->query($qry);

            }
            break;

        case 'delete': {


                $codigo = "NO";
                $datos = $_POST['datos'];
                $id = $_POST['id'];
                // Deserializar los datos en un array
                $datos_array = array();

                parse_str($datos, $datos_array);
                $matricula = $datos_array['matricula'];
                $qry = "DELETE From automovil
                    WHERE id_cliente = '$id' AND matricula = '$matricula'";
                ;
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