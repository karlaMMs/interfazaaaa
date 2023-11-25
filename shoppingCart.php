<?php
include "conexion.php";
session_start();

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Obtener el nombre del usuario desde la base de datos
    $query = "SELECT firstname FROM users WHERE id_user = '$id_user'";
    $user_result = $conexion->query($query);

    if ($user_result) {
        $user_data = $user_result->fetch_assoc();
        $nombre_usuario = $user_data['firstname'];

        // Obtener el id del carrito que está marcado como "comprado" = 1 y pertenece al usuario actual
        $query_carrito = "SELECT carrito_id FROM carritos WHERE usuario_id = '$id_user' AND comprado = 1";
        $carrito_result = $conexion->query($query_carrito);

       
    } else {
        // Manejo de errores, puedes personalizar según tus necesidades
        echo "Error en la consulta de usuario: " . $conexion->error;
    }
}

$conexion->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/shoppingCart.css">
</head>
<body>
    <!--Nav bar-->
    <div class="container my-2 justify-content-center">
        <div class="row">
            <div class="col-md-3 my-auto d-none d-md-block d-lg-block d-xl-block">
                <a class="navbar-brand" href="index.php">
                    <img src="images/LogoNav.png" alt="" width="40%" height="30%">
                </a>
            </div>
            <div class="col-md-6 ">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn" type="submit">BUSCAR</button>
                </form>
            </div>
            <div class="col-md-3">
                <?php
                if (isset($_SESSION['id_user'])) {
                    // Si el usuario ha iniciado sesión, muestra su nombre y un botón de cerrar sesión
                    echo "<div class='d-flex align-items-center'>";
                    echo "<a href='perfil.php' class='me-2'><button class='btn' type='button'>¡Hola, $nombre_usuario!</button></a>";
                    echo "<a href='logout.php' class='me-2'><button class='btn' type='button'> Cerrar Sesión</button>
                    </a>";
                    echo "</div>";
                } else {
                    // Si el usuario no ha iniciado sesión, muestra los botones para registrarse e iniciar sesión
                    echo "<a href='register.php'><button class='btn' type='button'>CREA TU CUENTA</button></a>";
                    echo "<a href='login.php'><button class='btn' type='button'>INGRESA</button></a>";
                }
                ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md navbar-light ">
        <div class="container-fluid justify-content-center mb-2" style="background-color: #ABC684;">
            <div class="row">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">HIGH PRO EXPERTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">PC'S LEGA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">PRODUCTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">COMPONENTES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">ACCESORIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">CONTACTO</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <h1>Carrito de compras</h1>

            

            <?php
include "conexion.php";
if ($carrito_result) {
    $carrito_data = $carrito_result->fetch_assoc();

    // Si se encontró un carrito, obtén su id
    if ($carrito_data) {
        $id_carrito = $carrito_data['carrito_id'];

        // Obtener los productos en el carrito que están marcados como activos
        $query_productos = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen, pc.cantidad
                            FROM productos_en_carrito pc
                            INNER JOIN producto p ON pc.producto_id = p.id
                            WHERE pc.carrito_id = '$id_carrito' AND pc.eliminado = 0";
        $productos_result = $conexion->query($query_productos);

        if ($productos_result) {
            $total_pedido = 0; // Inicializar el total del pedido

            // Procesar los resultados y mostrar los productos
            while ($producto_data = $productos_result->fetch_assoc()) {
                $producto_id = $producto_data['id'];
                $nombre_producto = $producto_data['nombre'];
                $descripcion_producto = $producto_data['descripcion'];
                $precio_producto = $producto_data['precio'];
                $foto_producto = $producto_data['imagen'];
                $cantidad_producto = $producto_data['cantidad'];
                $precio_total_producto = $precio_producto * $cantidad_producto;
                $total_pedido += $precio_total_producto;

                // Mostrar la información del producto en la tarjeta
                echo "<div class='card d-flex my-2 align-items-center' style='flex-direction:row;'>";
                echo "<div class='card_img'>";
                echo "<img src='$foto_producto' alt='...' style='height: auto; max-height: 200px; width: auto; max-width: 200px;'>";
                echo "</div>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'> $nombre_producto</h5>";
                echo "<p class='card-text'  >SKU: $producto_id</p>";
                echo "<p class='card-text'>Cantidad: $cantidad_producto</p>"; // Mostrar la cantidad
                echo "<h6 class='card-text'>Precio $$precio_total_producto MXN</h6>";
                echo "<button class='btn btn-danger' onclick='eliminarProducto($producto_id)'>Eliminar producto</button>";

                echo "</div>";
                echo "</div>";
            }
            // Mostrar el total del pedido
            echo "<div class='d-flex justify-content-center'>";
            echo "<h2>Total del pedido: $$total_pedido MXN</h2>";
            echo "</div>";
        } else {
            // Manejo de errores para la consulta de productos en carrito
            echo "Error en la consulta de productos en carrito: " . $conexion->error;
        }
    } else {
        // Manejo de errores si no se encontró un carrito comprado para el usuario
        echo "<p>No se encontró un carrito comprado para el usuario.</p>";
    }
} else {
    // Manejo de errores para la consulta de carrito
        echo "<p>No se encontró un carrito comprado para el usuario.</p>";
}

$conexion->close();
?>


           
        </div> 
        <div class="flex-row">
            <br>
            <div class="d-flex justify-content-center">
                <button class="btn btn_hp mb-4">Proceder a la compra</button>
            </div>
        </div>       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

<script>
    function eliminarProducto(productoId) {
        // Realizar una solicitud AJAX al servidor
        var xhr = new XMLHttpRequest();
        
        // Definir la función de retorno de llamada para manejar la respuesta del servidor
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // La solicitud fue exitosa, recargar la página para ver la actualización
                    console.log("Producto eliminado exitosamente");
                    location.reload();
                } else {
                    // Manejar errores en la respuesta del servidor
                    console.error("Error al eliminar el producto");
                }
            }
        };

        // Configurar la solicitud con el método POST y la URL del script PHP que manejará la eliminación
        xhr.open("POST", "eliminar_producto.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Enviar los datos del productoId al servidor
        xhr.send("producto_id=" + productoId);
    }
</script>

</html>