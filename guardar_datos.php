<?php
include "conexion.php";
session_start();

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contrasena = $_POST['contrasena'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $genero = $_POST['genero'];

    // Actualizar la base de datos con los nuevos datos
    $updateQuery = "UPDATE users SET firstname = '$nombre', lastname = '$apellido', user_password = '$contrasena', birthdate = '$fechaNacimiento', genre = '$genero' WHERE id_user = '$id_user'";
    $updateResult = $conexion->query($updateQuery);

    if ($updateResult) {
        echo "Datos actualizados correctamente";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }
}

$conexion->close();
?>
