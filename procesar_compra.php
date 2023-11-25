<?php
include "conexion.php";

// Verificar si se recibió el carrito_id y el user_id en la solicitud POST
if (isset($_POST['carrito_id']) && isset($_POST['user_id'])) {
    $carritoId = $_POST['carrito_id'];
    $userId = $_POST['user_id'];

    // Actualizar el carrito existente (marcarlo como no comprado)
    $query_actualizar_carrito = "UPDATE carritos SET comprado = 0 WHERE carrito_id = '$carritoId'";
    $resultado_actualizar_carrito = $conexion->query($query_actualizar_carrito);

    if ($resultado_actualizar_carrito) {
        // Consultar los productos en el carrito actual
        $query_productos_en_carrito = "SELECT producto_id, cantidad FROM productos_en_carrito WHERE carrito_id = '$carritoId'";
        $resultado_productos_en_carrito = $conexion->query($query_productos_en_carrito);

        if ($resultado_productos_en_carrito) {
            // Iterar sobre los productos en el carrito
            while ($row = $resultado_productos_en_carrito->fetch_assoc()) {
                $productoId = $row['producto_id'];
                $cantidadComprada = $row['cantidad'];

                // Actualizar la cantidad disponible en la tabla de productos
                $query_actualizar_disponibles = "UPDATE producto SET disponibles = disponibles - $cantidadComprada WHERE id = '$productoId'";
                $resultado_actualizar_disponibles = $conexion->query($query_actualizar_disponibles);

                if (!$resultado_actualizar_disponibles) {
                    // Error al actualizar la disponibilidad
                    $respuesta = array('success' => false, 'error' => 'Error al actualizar la disponibilidad de productos');
                    // Puedes agregar más detalles al array de respuesta si es necesario
                    echo json_encode($respuesta);
                    exit;
                }
            }

            // Crear un nuevo carrito para el usuario
            $carritoFechaCreacion = date("Y-m-d H:i:s");
            $query_nuevo_carrito = "INSERT INTO carritos (usuario_id, comprado, fecha_creacion) VALUES ('$userId', 'false', '$carritoFechaCreacion')";
            $resultado_nuevo_carrito = $conexion->query($query_nuevo_carrito);

            if ($resultado_nuevo_carrito) {
                // La compra fue procesada con éxito
                $respuesta = array('success' => true);
            } else {
                // Error al crear un nuevo carrito
                $respuesta = array('success' => false, 'error' => 'Error al crear un nuevo carrito');
            }
        } else {
            // Error al consultar productos en el carrito
            $respuesta = array('success' => false, 'error' => 'Error al consultar productos en el carrito');
        }
    } else {
        // Error al actualizar el carrito existente
        $respuesta = array('success' => false, 'error' => 'Error al actualizar el carrito existente');
    }
} else {
    // No se recibió el carrito_id o el user_id en la solicitud POST
    $respuesta = array('success' => false, 'error' => 'No se recibieron el ID del carrito o del usuario');
}

// Enviar la respuesta en formato JSON al cliente
header('Content-Type: application/json');
echo json_encode($respuesta);

// Cerrar la conexión a la base de datos
$conexion->close();
?>
