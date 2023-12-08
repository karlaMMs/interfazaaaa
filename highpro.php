<?php
include "conexion.php";
session_start(); // Inicia la sesión si no está iniciada

// Realizar la consulta a la base de datos
$sql = "SELECT *
FROM producto
WHERE fechaalta >= DATE_SUB(NOW(), INTERVAL 200 DAY)
ORDER BY fechaalta DESC;";
$sqlrate = "SELECT *
FROM producto
WHERE rate >= 5
ORDER BY precio DESC
LIMIT 4;";
$result = $conexion->query($sql);
$resultrate = $conexion->query($sqlrate);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css">
</head>

<body>
    <div class="container my-2 justify-content-center">
        <div class="row">
            <div class="col-md-3 my-auto d-none d-md-block d-lg-block d-xl-block">
                <a class="navbar-brand" href="index.php">
                    <img src="images/LogoNav.png" alt="" width="40%" height="30%">
                </a>
            </div>
            <div class="col-md-6 ">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        style="border: 2px solid #8EB25A;">
                    <button class="btn" type="submit">BUSCAR</button>
                </form>
            </div>
            <div class="col-md-3">
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
    </div>

    <nav class="navbar navbar-expand-md navbar-light ">
        <div class="container-fluid justify-content-center mb-2" style="background-color: #ABC684;">
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
    <div class="container-fluid justify-content-center my-4">
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
    <div>
    <h2>Descubre HighPro Experts: Tu Solución en Ensamblaje y Personalización de Equipos</h2>
    
    <p>HighPro Experts ofrece una variedad de servicios diseñados para brindarte la mejor experiencia en ensamblaje y mantenimiento de equipos informáticos. Nuestros expertos se especializan en:</p>
    
    <ul>
        <li>Personalización y asesoramiento en ensambles</li>
        <li>Ensamblaje profesional</li>
        <li>Prueba de función y rendimiento de componentes</li>
        <li>Mantenimiento de equipos</li>
        <li>Respaldo y clonación</li>
    </ul>

    <p>Nuestro compromiso es garantizar que tu equipo alcance su máximo rendimiento al seleccionar cuidadosamente los mejores componentes. Confía en nosotros para:</p>
    
    <ul>
        <li>Ensamblar tu equipo con expertos conocedores de hardware, programas de trabajo y videojuegos.</li>
        <li>Utilizar las mejores marcas del mercado con estándares de calidad superiores.</li>
        <li>Ofrecer garantías de hasta 1 año, con asistencia directa en tramites con la marca posteriormente.</li>
        <li>Realizar envíos profesionales y seguros a medida para tu equipo.</li>
        <li>Efectuar rigurosas pruebas de rendimiento para garantizar el óptimo funcionamiento de todos los componentes.</li>
    </ul>

    <p>Confía en HighPro Experts para adquirir tu equipo y experimenta la diferencia que hacen nuestros expertos en cada detalle.</p>
</div>

    </body>
<footer>
    <div class="footer-content">
        <div class="footer-our-store">
            <div class="our-store-info">
                <h5>Atención a clientes</h5>
                <p>L-V 10-7pm Sábado 10- 2pm: (33) - 2736 4752</p>
                <p>ventas@highpro.com.mx</p>
            </div>
        </div>
        <div class="footer-address">
            <h5>Dirección</h5>
            <p>Highpro, Av. conchita 3124 C.P. 45086 Col. Loma bonita Residencial Zapopan, Jalisco. México.</p>
        </div>
    </div>
    <div class="footer-copyright">
        <label> © Copyright 2023 Angel Barbosa, Karla Martínez </label>
    </div>
</footer>


<style>

    footer {
        background-color: #ABC684;
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