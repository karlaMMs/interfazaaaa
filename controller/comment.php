<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/db.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    
    $mysqli = db::connect();
    $autor= $json['autor'];
    $mensaje = $json['mensaje'];
    $producto = $json['producto'];
    $fecha = date("Y-m-d H:i:s"); 
    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
    $sql = $mysqli->prepare("INSERT INTO `comentarios`(`autor`, `mensaje`, `fecha`, `producto`) VALUES (?,?,?, ?);");
    $sql->bind_param("issi", $autor, $mensaje, $fecha, $producto);
    $resultado = $sql->execute();
    if ($resultado) {
        #echo "Mensaje y archivo guardados exitosamente en la base de datos";
        $json_response = ["success" => true];
        echo json_encode($json_response);
    } else {
        #echo "Error al insertar el mensaje y el archivo en la base de datos";
        $json_response = ["success" => false];
        echo json_encode($json_response);
    }
    exit;
}
?>