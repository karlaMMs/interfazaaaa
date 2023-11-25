<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el id del producto desde la solicitud POST
    $producto_id = $_POST["producto_id"];

    // Actualizar el campo "eliminado" a 1 en la tabla productos_en_carrito
    $update_query = "UPDATE productos_en_carrito SET eliminado = 1 WHERE producto_id = '$producto_id'";
    $update_result = $conexion->query($update_query);

    if ($update_result) {
        // La actualización fue exitosa
        echo "Producto eliminado exitosamente";
    } else {
        // Manejar errores en la actualización
        echo "Error al eliminar el producto: " . $conexion->error;
    }
}

$conexion->close();
?>
