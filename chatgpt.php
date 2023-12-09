<?php
include "conexion.php";
session_start(); // Inicia la sesión si no está iniciada
$main_color = "#729740";
#           = "#8eb35a";
// Realizar la consulta a la base de datos
$sql = "SELECT * FROM producto";
$result = $conexion->query($sql);

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Obtener el nombre del usuario desde la base de datos (asumiendo que tienes una tabla de usuarios relacionada con productos)
    $query = "SELECT firstname FROM users WHERE id_user = '$id_user'";
    $user_result = $conexion->query($query);

    if ($user_result) {
        $user_data = $user_result->fetch_assoc();
        $nombre_usuario = $user_data['firstname'];

        // Muestra el alert en JavaScript
       // echo "<script>alert('¡Hola $nombre_usuario!');</script>";

        // Resto del código de index.php
    } else {
        // Manejo de errores, puedes personalizar según tus necesidades
        echo "Error en la consulta de usuario: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .formulario-container {
            text-align: center;
        }

        .btn_hp
{
    background-color: #8EB25A;
    color: white;
}

.btn_hp:hover
{
    background-color: #ABC684;
    color: white;
}
    </style>
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
        <div class="container-fluid justify-content-center mt-4">
            <div class="row">
                <div class="col-3 d-flex justify-content-center">
                    <div class="">
                        <div class="d-flex justify-content-center">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="text-center">
                            <h3>
                                Envío Express
                            </h3>
                            <p>A toda la República Mexicana</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center">
                    <div class="">
                        <div class="d-flex justify-content-center">
                            <i class="fa fa-check-square"></i>
                        </div>
                        <div class="text-center">
                            <h3>
                                Ensamblaje profesional
                            </h3>
                            <p>Hecho por expertos</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center">
                    <div class="">
                        <div class="d-flex justify-content-center">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="text-center">
                            <h3>
                                Pagos
                            </h3>
                            <p>Pagos 100% seguros</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center">
                    <div class="">
                        <div class="d-flex justify-content-center">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="text-center">
                            <h3>
                                Soporte online
                            </h3>
                            <a
                                href="https://api.whatsapp.com/send?phone=5213329275903&amp;text=Hola!%20Quiero%20m%C3%A1s%20informaci%C3%B3n!">Atención
                                en línea</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="col justify-content-center text-center">
                    <h1 >Chatbot Fácil</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="chat">

                    </div>
                    <br>
                    <br>
                </div>
            </div> 
            <div class="row">
                <div class="col formulario-container">
                        <form id="chat-form">
                            <input type="text" id="pregunta" placeholder="Escribe tu pregunta..." style="border: 2px solid #8EB25A;">
                            <button type="button" class="btn btn_hp my-1"  onclick="enviarPregunta()">Enviar</button>
                        </form>
                </div> 
            </div>            
        </div>
        <script>
            function enviarPregunta() {
                var pregunta = document.getElementById("pregunta").value;
                
                // Realizar la solicitud al script de cotización PHP
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Mostrar la respuesta en el chat
                        document.getElementById("chat").innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST", "script_cotizador.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("pregunta=" + pregunta);
            }
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </div>
</body>
<footer class="">
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




<style>
    .img-hover {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border: 2px solid transparent;
        /* Borde transparente por defecto */
    }

    .img-hover:hover {
        transform: scale(1.1);
        width: auto;
        height: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-color: #92D92D;
        /* Cambia el color del borde al pasar el mouse */
    }

    footer {
        background-color: <?php echo $main_color ?>;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        width: 80%;
        /* ajusta el ancho según sea necesario */
        margin: 0 auto;
        /* centra el contenido horizontalmente */
    }

    .footer-our-store,
    .footer-address {
        width: 48%;
        /* ajusta el ancho según sea necesario */
    }

    .footer-copyright {
        width: 100%;
        text-align: center;

    }
</style>
</html>
