<?php
include "conexion.php";
session_start(); // Inicia la sesión si no está iniciada
$main_color = "#729740";
#           = "#8eb35a";
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
    <title>High Pro</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css">
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

        <div class="container" id="Rated">
            <h3 style="text-align: center;">Mejor votados</h3>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                
            <br>
            <?php
                    // Verificar si hay resultados
                    if ($resultrate->num_rows > 0) {
                        // Iniciar una fila
                        #echo "<div class='row row-cols-1 row-cols-md-4 row-cols- g-4'>";

                        // Iterar sobre los resultados y mostrar la información en tarjetas
                        while ($row = $resultrate->fetch_assoc()) {
                            echo "<div class='col d-inline-flex justify-content-center'>";
                            echo "<div class='card' style='width: 18rem;'>";
                            if (isset($_SESSION['id_user'])) {
                                echo "<a href='pagina_producto.php?id=" . $row['id'] . "&user_id=" . $_SESSION['id_user'] . "' style='color: black; text-decoration: none;'>";
                                #echo "<a href='pagina_producto.php?id=" . $row['id'] . "&user_id=" . $_SESSION['id_user'] . "'>";
                            }else{
                                echo "<a href='pagina_producto.php?id=" . $row['id'] . "' style='color: black; text-decoration: none;'>"; 
                            }
                            echo "<img src='" . $row['imagen'] . "' class='card-img-top' alt='" . $row['nombre'] . "' style='height: 18rem; object-fit: contain;'>";
                            #echo "<img src='" . $row['imagen'] . "' class='card-img-top img-hover' alt='" . $row['nombre'] . "' style='width: 200px; height: 200px; object-fit: cover;'>";
                            #echo "</a>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text'>" . $row['nombre'] . "</p>";
                            #echo "<p class='card-text'>" . $row['nombre'] . "</p>";
                            echo "<h5 class='card-title'>$" . number_format($row['precio'], 2) . "</h5>";
                            #echo "<p class='card-text'>" . number_format($row['precio'], 2) . "</p>";
                            echo "<div class='rate-container' style='color: #8eb35a'>";
                            for($i = 0; $i < 5; $i++)
                            {
                                if($i < $row['rate'])
                                {
                                    echo "<i class='fa-solid fa-star'></i>";
                                }
                                else
                                {
                                    echo "<i class='fa-regular fa-star'></i>";
                                }
                            }            
                            echo "</div><br></div></a></div></div>";
                            #echo "</div></div></div>";
                        }
                        // Cerrar la fila
                        #echo "</div>";
                    } else {
                        echo "No se encontraron productos.";
                    }
                ?>


            </div>
        </div>
        <br><br>
        <div class="container" id="newest">
            <h3 style="text-align: center;">Más recientes</h3>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                
            <br>
            <?php
                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Iniciar una fila
                        #echo "<div class='row row-cols-1 row-cols-md-4 row-cols- g-4'>";

                        // Iterar sobre los resultados y mostrar la información en tarjetas
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col d-inline-flex justify-content-center'>";
                            echo "<div class='card' style='width: 18rem;'>";
                            if (isset($_SESSION['id_user'])) {
                                echo "<a href='pagina_producto.php?id=" . $row['id'] . "&user_id=" . $_SESSION['id_user'] . "' style='color: black; text-decoration: none;'>";
                                #echo "<a href='pagina_producto.php?id=" . $row['id'] . "&user_id=" . $_SESSION['id_user'] . "'>";
                            }else{
                                echo "<a href='pagina_producto.php?id=" . $row['id'] . "' style='color: black; text-decoration: none;'>"; 
                            }
                            echo "<img src='" . $row['imagen'] . "' class='card-img-top' alt='" . $row['nombre'] . "' style='height: 18rem; object-fit: contain;'>";
                            #echo "<img src='" . $row['imagen'] . "' class='card-img-top img-hover' alt='" . $row['nombre'] . "' style='width: 200px; height: 200px; object-fit: cover;'>";
                            #echo "</a>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text'>" . $row['nombre'] . "</p>";
                            #echo "<p class='card-text'>" . $row['nombre'] . "</p>";
                            echo "<h5 class='card-title'>$" . number_format($row['precio'], 2) . "</h5>";
                            #echo "<p class='card-text'>" . number_format($row['precio'], 2) . "</p>";
                            echo "<div class='rate-container' style='color: #8eb35a'>";
                            for($i = 0; $i < 5; $i++)
                            {
                                if($i < $row['rate'])
                                {
                                    echo "<i class='fa-solid fa-star'></i>";
                                }
                                else
                                {
                                    echo "<i class='fa-regular fa-star'></i>";
                                }
                            }            
                            echo "</div><br></div></a></div></div>";
                            #echo "</div></div></div>";
                        }
                        // Cerrar la fila
                        #echo "</div>";
                    } else {
                        echo "No se encontraron productos.";
                    }
                ?>


            </div>
        </div>
        <br><br>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    </div>

    <?php
    //aqui esta el onboarding!
    if (isset($_SESSION['id_user'])) {
        echo <<<HTML
<script>
  introJs().setOptions({
    showProgress: true,
    steps: [
      {
        element: document.querySelector('.intro-target'),
        title: '¡Bienvenido!',
        intro: 'Aquí podrás acceder a tu perfil, carrito de compras, historial y cerrar sesión.'
      },
      {
        element: document.querySelector('#chatbotfacil'),
        intro: 'Nuestro chatbot te mostrará los productos que necesites para compararlos. '
      },
     {
        element: document.querySelector("#rated"),
        intro: "En esta sección, encontrarás los productos mejor valorados. ¡Descubre lo que aman nuestros clientes!",
        position: "bottom"
      },
      {
        element: document.querySelector("#newest"),
        intro: "¿Te gustan las novedades? Aquí puedes explorar los productos más recientes en nuestro catálogo. ¡Siempre algo nuevo por descubrir!",
        position: "bottom"
      },
      {
        element: 'body',
        title: '¡Listo para explorar!',
        intro: 'Gracias por completar nuestro tour. ¡Disfruta de tu experiencia de compra!',
        position: 'bottom'
      }
    ],
    dontShowAgain: true,
    prevLabel: 'Atrás',
    nextLabel: 'Siguiente',
    doneLabel: 'Terminar'
  }).start();
</script>
HTML;


    } else {
        echo <<<HTML
        <script>
          introJs().setOptions({
            showProgress: true,
            steps: [
              {
                title: "¡Bienvenido a High Pro!",
                intro: "¡Hola! Estamos emocionados de tenerte aquí. Vamos a guiarte por nuestra página."
              },
              {
                element: document.querySelector('#chatbotfacil'),
                intro: 'En nuestro chatbot podrás ver productos que se acomodan a tus necesidades.'
              },
              
              {
                element: document.querySelector("#rated"),
                intro: "En esta sección, encontrarás los productos mejor valorados. ¡Descubre lo que aman nuestros clientes!",
                position: "bottom"
              },
              {
                element: document.querySelector("#newest"),
                intro: "¿Te gustan las novedades? Aquí puedes explorar los productos más recientes en nuestro catálogo. ¡Siempre algo nuevo por descubrir!",
                position: "bottom"
              },
              {
                element: document.querySelector("#iniciosesion"),
                intro: "¡Ahora puedes iniciar sesión y explorar aún más!",
                position: "bottom"
              }
            ],
            dontShowAgain: true,
            prevLabel: "Atras",
            nextLabel: "Siguiente",
            doneLabel: "Terminar"
          }).start();
        </script>
        HTML;

    }
    ?>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Obtener todas las imágenes con la clase img-hover
        var imgHoverElements = document.querySelectorAll('.img-hover');

        // Agregar un listener para cada imagen
        imgHoverElements.forEach(function (img) {
            img.addEventListener('mouseout', function () {
                // Restablecer el tamaño original y quitar la sombra y el borde al quitar el mouse
                img.style.transform = 'scale(1)';
                img.style.width = '200px'; // O el tamaño deseado
                img.style.height = '200px'; // O el tamaño deseado
                img.style.boxShadow = 'none';
                img.style.borderColor = 'transparent'; // Restablecer el color del borde
            });
        });
    });
</script>
</html>