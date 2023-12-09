<?php
include "conexion.php";
include "config/db.php";
session_start(); 
$main_color = "#729740";
#           = "#8eb35a";
// Verificar si se proporciona el parámetro 'id' en la URL


if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Obtener el nombre del usuario desde la base de datos (asumiendo que tienes una tabla de usuarios relacionada con productos)
    $query = "SELECT firstname FROM users WHERE id_user = '$id_user'";
    $user_result = $conexion->query($query);

    if ($user_result) {
        $user_data = $user_result->fetch_assoc();
        $nombre_usuario = $user_data['firstname'];


        // Resto del código de index.php
    } else {
        // Manejo de errores, puedes personalizar según tus necesidades
        echo "Error en la consulta de usuario: " . $conexion->error;
    }
}

if (isset($_GET['id'])) {
    // Obtener el valor del parámetro 'id'
    $productoID = $_GET['id'];
  
    // Realizar una consulta a la base de datos para obtener la información del producto
    $consulta = "SELECT * FROM producto WHERE id = $productoID";
    $resultado = $conexion->query($consulta);

    // Verificar si la consulta fue exitosa
    if ($resultado) {
        // Obtener los datos del producto
        $producto = $resultado->fetch_assoc();

        // Ahora puedes utilizar $producto en tu código para mostrar la información del producto

        // Ejemplo de cómo mostrar el nombre del producto
        $nombreProducto = $producto['nombre'];

        // ... Continuar mostrando otros detalles del producto según sea necesario

        // Cerrar el resultado de la consulta
        $resultado->close();
    } else {
        // Si hay un error en la consulta, muestra un mensaje de error
        echo "Error en la consulta: " . $conexion->error;
    }
} else {
    // Si no se proporciona el parámetro 'id', muestra un mensaje de error o redirige a otra página
    echo "Error: ID del producto no proporcionado.";
}
// Cerrar la conexión
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
    <link rel="stylesheet" type="text/css" href="css/generic.css">
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
    <div style="flex: 1;">
        <div class="container-fluid justify-content-center pt-2" style="background-color: <?php echo $main_color ?>;">
            <div class="row align-items-center ">
                <div class="col-0 col-md-2  d-none d-md-block d-lg-block d-xl-block ">
                    <a class="navbar-brand d-flex justify-content-center" href="index.php">
                        <img src="images/LogoNav.png" alt="" height="30 rem">
                    </a>
                </div>
                <div class="col-md-8 col-12">
                    <form class="d-flex" method="get" action="resultado.php">
                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" id="id_search" name="search">
                        <button class="btn" type="submit">BUSCAR</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <?php
                    if (isset($_SESSION['id_user'])) {
                        // Si el usuario ha iniciado sesión, muestra su nombre y un botón de cerrar sesión
                        echo "<div class='dropdown'>";
                        echo "<a class='btn dropdown-toggle intro-target' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>¡Hola, $nombre_usuario!</a>";
                        echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
                        echo "<a class='dropdown-item' href='perfil.php'>Perfil</a>";
                        echo "<a class='dropdown-item' href='shoppingCart.php'>Carrito</a>";
                        echo "<a class='dropdown-item' href='historial.php'>Historial</a>";
                        echo "<div class='dropdown-divider'></div>";
                        echo "<a class='dropdown-item' href='logout.php'>Cerrar Sesión</a>";
                        echo "</div>";
                        echo "</div>";

                    } else {
                        // Si el usuario no ha iniciado sesión, muestra los botones para registrarse e iniciar sesión
                        echo '<div id="iniciosesion">';
                        echo "<a href='register.php'><button class='btn' type='button'>CREA TU CUENTA</button></a>";
                        echo "<a href='login.php'><button class='btn' type='button'>INGRESA</button></a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <div class="container-fluid justify-content-center" style="">
                        <div class="row">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="highpro.php">HIGH PRO EXPERTS</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">PRODUCTOS</a>
                                    </li>

                                    <li class="nav-item" id="chatbotfacil">
                                        <a class="nav-link" aria-current="page" href="chatgpt.php">CHATBOT FÁCIL</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!--Producto-->
    <div class="container">
        <div class="my-2">
            <div class="d-flex flex-row justify-content-center">
                <div class="col-sm-2">
                    <?php
                        // Mostrar imágenes del producto (puedes adaptar esto según cómo almacenas las imágenes en tu base de datos)
                        echo "<img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "' class='rounded img-thumbnail' style='width: 100px; height: 100px; object-fit:cover;'>";
                        // Puedes mostrar más imágenes según sea necesario
                    ?>
                </div>
                <div class="col-sm-4 d-flex align-items-center">
                    <?php
                        // Mostrar imagen principal del producto
                        echo "<div class='image'>";
                        echo "<img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "' class='rounded img-thumbnail' style='object-fit:fill;'>";
                        echo "</div>";
                    ?>
                </div>
                <div class="col-sm-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <?php
                                // Mostrar otros detalles del producto
                                
                                echo "<h4 class='card-title'>" . $producto['nombre'] . "</h4>";
                                echo "<p class='card-text'><small class='text-muted'> SKU: " . $producto['id'] . "</small></p>";
                                echo "<p class='card-text'><small class='text-muted'> Categoría: " . $producto['categoria'] . "</small></p>";
                                echo "<p class='card-text'>" . $producto['descripcion'] . "</p>";
                                echo "<p class='card-text'>Valoración: " . $producto['rate'] . "</p>";
                                echo "<h5 class='card-title'>Precio: $" . $producto['precio'] . "</h5>";
                                echo "<p class='card-title'>Disponibles: <strong>" . $producto['disponibles'] . "</strong> unidades. </p>";

                                if ($producto['disponibles'] > 0) {
                                    echo "<div class='form-group'>";
                                    echo "<label for='cantidad'>Cantidad:</label>";
                                    echo "<input type='number' class='form-control' id='cantidad' name='cantidad' min='1' max='" . $producto['disponibles'] . "' value='1' style='border: 1px solid #333;'>";
                                    echo "</div>";
                                    if (isset($_SESSION['id_user'])) {
                                        // Si el usuario ha iniciado sesión, muestra los botones
                                        echo '<div class="row justify-content-center">';
                                        echo '<button class="btn btn_hp my-1" onclick="agregarAlCarrito(' . $id_user . ', ' . $productoID . ', ' . $producto['disponibles'] . ')">Agregar al carrito</button>';
                                        echo '</div>';
                                    } else {
                                        // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
                                        echo '<p><strong>Inicia sesión para comprar o agregar al carrito</strong></p>';
                                        echo '<a href="login.php"><button class="btn btn_hp my-1">Iniciar Sesión</button></a>';
                                    }
                                
                                } else {
                                    // Si la cantidad disponible es 0, mostrar un mensaje y deshabilitar el botón
                                    echo "<p><strong><em>¡Este producto volverá pronto!</em></strong></p>";
                                    echo '<button class="btn btn_hp my-1" disabled>Agregar al carrito</button>';
                                }


                              
                            ?>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <br>
    <br>
    <div class="container">
        <div class="d-flex flex-row justify-content-center">
            
            <div class="col-sm-4">
                <div>
                    <h1>Comentarios</h1>
                </div>
                <?php
                    if (isset($_GET['id']) && isset($_GET['user_id']))
                    {
                        $conexion = db::connect();
                        $producto = $_GET['id'];
                        $user = $_GET['user_id'];
                        $consulta = "SELECT (SELECT firstname FROM `users` WHERE id_user = $user) user, mensaje, fecha, producto FROM `comentarios` WHERE producto = $producto;";
                        #$consulta = "SELECT texto_mensaje, (SELECT U.Username FROM usuario AS U where U.idUsuario = M.autor) AS usuario, fecha_mensaje FROM Mensaje AS M WHERE id_chat = $chat_abierto";
                        $ejecutar = $conexion->query($consulta);
                        
                    } 
                    while($fila = $ejecutar->fetch_array()):
                    ?>
                    <div class="card rounded py-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fila["user"];?></h5>
                            <p class="card-text"><?php echo $fila["mensaje"];?></p>
                            <p class="card-text"><small class="text-muted"><?php echo $fila["fecha"];?></small></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <!--div class="card rounded">
                    <div class="card-body">
                        <h5 class="card-title">Autor</h5>
                        <p class="card-text">Comentario</p>
                        <p class="card-text"><small class="text-muted">Fecha</small></p>
                    </div>
                </div-->
                <div>
                    <form class="" role="search" onsubmit="return publicar_comentario()" id="typing-area"
                    data-id-usuario="<?php 
                    
                    if(isset($_SESSION['id_user']))
                    {
                        echo $_SESSION['id_user'];
                    }
                    else
                    {
                        echo -1;
                    }
                    ?>"
                     data-id-producto="
                    <?php
                    if(isset($_GET['id']))
                    {
                        echo $_GET['id'];
                    }
                    else
                    {
                        echo -1;
                    }
                    ?>
                    " 
                    method="post" enctype="multipart/form-data">
                        <input id="id_message_body" class="form-control my-2" type="text" placeholder="Escribe un comentario..." aria-label="Search">
                        <button class="btn btn_hp" type="submit">Publicar</button>
                    </form>
                    <br>
                </div>
                
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
<footer style="background-color: <?php echo $main_color ?>;">
    <div class="container py-5">
        <div class="row" style="display: flex;">
            <div class="footer-content col-6 text-center">
                <div class="footer-our-store">
                    <div class="our-store-info">
                        <h5>Atención a clientes</h5>
                        <p>
                            L-V 10-7pm Sábado 10- 2pm: (33) - 2736 4752
                            <br>ventas@highpro.com.mx
                        </p>
                    </div>
                </div>
                <div class="footer-address col-6 text-center">
                    <h5>Dirección</h5>
                    <p>Highpro, Av. conchita 3124 C.P. 45086 Col. Loma bonita Residencial Zapopan, Jalisco. México.</p>
                </div>
            </div>
            
            <div class="footer-copyright col-12">
                <br>
                <p> © Copyright 2023 Angel Barbosa, Karla Martínez </p>
            </div>
        </div>
    </div>
</footer>
<script src="javascript/comentarios.js"></script>
<script src="javascript/jquery-3.7.1.min.js"></script>
<script>
function agregarAlCarrito(idUsuario, productoID, disponibles) {
    var cantidadSeleccionada = document.getElementById('cantidad').value;

    if (parseInt(cantidadSeleccionada) <= 0) {
        alert("¡Error! La cantidad seleccionada debe ser mayor que cero.");
    } else if (parseInt(cantidadSeleccionada) > disponibles) {
        alert("¡Error! La cantidad seleccionada es mayor que la cantidad de disponibles.");
    } else {
        // Realizar una llamada AJAX para insertar el producto en el carrito
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "agregarAlCarrito.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // La operación se completó con éxito, puedes redirigir o realizar otras acciones si es necesario
                window.location.href = 'shoppingCart.php?id_user=' + idUsuario;
            }
        };

        // Enviar los datos al servidor
        xhr.send("id_user=" + idUsuario + "&producto_id=" + productoID + "&cantidad=" + cantidadSeleccionada);
    }
}
</script>



</html>