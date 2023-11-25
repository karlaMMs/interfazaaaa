<?php
include "conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];
        $productoID = $_POST['producto_id'];
        $cantidad = $_POST['cantidad'];

        // Realizar las operaciones de inserción y actualización en la base de datos
        $queryCarrito = "SELECT carrito_id FROM carritos WHERE usuario_id = '$id_user' AND comprado = 1";
        $carritoResult = $conexion->query($queryCarrito);

        if ($carritoResult) {
            $carritoData = $carritoResult->fetch_assoc();
            $carritoID = $carritoData['carrito_id'];

            $queryInsert = "INSERT INTO productos_en_carrito (carrito_id, producto_id, cantidad, eliminado) VALUES ('$carritoID', '$productoID', '$cantidad', 0)";
            $insertResult = $conexion->query($queryInsert);

            if (!$insertResult) {
                // Manejo de errores, puedes personalizar según tus necesidades
                echo "Error al insertar el producto en el carrito: " . $conexion->error;
            }
        } else {
            // Manejo de errores, puedes personalizar según tus necesidades
            echo "Error al obtener el carrito del usuario: " . $conexion->error;
        }
    }
    $conexion->close();
}
?>
