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

        // Obtener los detalles del usuario
        $query_usuario = "SELECT * FROM users WHERE id_user = '$id_user'";
        $usuario_result = $conexion->query($query_usuario);

        if ($usuario_result) {
            $usuario_data = $usuario_result->fetch_assoc();

            // Asignar los valores a las variables para usar en los campos del formulario
            $nombre = $usuario_data['firstname'];
            $apellido = $usuario_data['lastname'];
            $correo = $usuario_data['email'];
            $contrasena = $usuario_data['user_password']; // Incluir la contraseña en el formulario
            $fecha_nacimiento = $usuario_data['birthdate'];
            $genero = $usuario_data['genre'];
        } else {
            // Manejo de errores, puedes personalizar según tus necesidades
            echo "Error en la consulta de usuario: " . $conexion->error;
        }

        // ...

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
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/shoppingCart.css">

 
    <style>
        .container-estilo {
            background-color: #f8f9fa;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .registro {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .registro_form input,
        .registro_form select {
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .registro_form input:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        .btn_hp {
            margin-left: 200px;
        }
    </style>
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
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="border: 2px solid #8EB25A;">
                    <button class="btn" type="submit">BUSCAR</button>
                </form>
            </div>
            <div class="col-md-3">
    <?php
    if (isset($_SESSION['id_user'])) {
        // Si el usuario ha iniciado sesión, muestra su nombre y un botón de cerrar sesión
        echo "<div class='dropdown'>";
        echo "<a class='btn dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>¡Hola, $nombre_usuario!</a>";
        echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
        echo "<a class='dropdown-item' href='perfil.php'>Perfil</a>";
        echo "<a class='dropdown-item' href='shoppingCart.php'>Carrito</a>";  // Agrega enlaces y ajusta según tus necesidades
        echo "<a class='dropdown-item' href='historial.php'>Historial</a>"; // Agrega enlaces y ajusta según tus necesidades
        echo "<div class='dropdown-divider'></div>";
        echo "<a class='dropdown-item' href='logout.php'>Cerrar Sesión</a>";
        echo "</div>";
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
    <div class="container container-estilo">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 registro">
    <div class="container">
        <div class="row">
            <h1>Perfil</h1>

            <div class="col-md-8 col-sm-12 registro">
            <form method="POST" enctype="multipart/form-data" class="registro_form">
    <div class="form-group">
        <label for="id_name"></label>
                <label for="id_email" style="font-weight: bold;">Nombre</label>

        <input type="text" class="dato" id="id_name" name="name_name" placeholder="Nombre(s)" required value="<?php echo $nombre; ?>">
    </div>
    <div>
        <label for="id_lastname"></label>
        <label for="id_email" style="font-weight: bold;">Apellido</label>

        <input type="text" class="dato" id="id_lastname" name="name_lastname" placeholder="Apellido(s)" required value="<?php echo $apellido; ?>">
    </div>
    <div class="form-group">
        <label for="id_email" style="font-weight: bold;">Correo Electrónico</label>
        <input type="text" class="dato" id="id_email" name="name_email" placeholder="Correo" disabled required value="<?php echo $correo; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="id_password" style="font-weight: bold;">Contraseña</label>
        <input type="password" class="dato" id="id_password" placeholder="Contraseña" name="name_password" value="<?php echo $contrasena; ?>">
        <input type="checkbox" id="showPassword"> Mostrar contraseña
    </div>
   
    <div class="form-group">
        <label for="id_birthdate"></label>
        <input type="date" class="dato" id="id_birthdate" name="name_birthdate" placeholder="Fecha de Nacimiento " required value="<?php echo $fecha_nacimiento; ?>">
    </div>
    <div class="form-group">
        <label for="id_genre"></label>
        <select class="dato" id="id_genre" name="name_genre" required>
            <option disabled selected>Género</option>
            <option value="0" class="opcion" <?php echo ($genero == 0) ? 'selected' : ''; ?>>Femenino</option>
            <option value="1" class="opcion" <?php echo ($genero == 1) ? 'selected' : ''; ?>>Masculino</option>
        </select>
    </div>

</form>

                <!-- Formulario adicional -->
               
            </div>
        </div>
    </div>
    <form id="procederCompraForm">
                    <div class="flex-row">
                        <br>
                        <div class="d-flex ">
                            <style>
                                .btn_hp {
                                    margin-left: 200px;
                                }
                            </style>

<button id="guardarDatosBtn" class="btn btn_hp mb-2" type="button">Guardar datos</button>
                            <button class="btn btn_hp mb-2" type="button">Borrar perfil</button>

                        </div>
                    </div>
                </form>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
<script>
        var passwordField = document.getElementById("id_password");
        var showPassword = document.getElementById("showPassword");

        showPassword.addEventListener("input", function() {
            passwordField.type = showPassword.checked ? "text" : "password";
        });
    </script>
<script>
    document.getElementById("guardarDatosBtn").addEventListener("click", function() {
        // Aquí va el código que manejará el clic en el botón
        // Por ejemplo, puedes colocar aquí el código que se mostró en la respuesta anterior
        var nombre = document.getElementById("id_name").value;
        var apellido = document.getElementById("id_lastname").value;
        var contrasena = document.getElementById("id_password").value;
        var fechaNacimiento = document.getElementById("id_birthdate").value;
        var genero = document.getElementById("id_genre").value;

        // Crear un objeto FormData para enviar los datos al servidor
        var formData = new FormData();
        formData.append("nombre", nombre);
        formData.append("apellido", apellido);
        formData.append("contrasena", contrasena);
        formData.append("fechaNacimiento", fechaNacimiento);
        formData.append("genero", genero);

        // Realizar la solicitud AJAX al servidor
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "guardar_datos.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Manejar la respuesta del servidor si es necesario
                    console.log(xhr.responseText);

                    // Mostrar un mensaje de alerta indicando que el cambio fue exitoso
                    alert("Cambio exitoso");

                    // Recargar la página si la respuesta fue exitosa
                    location.reload();
                } else {
                    // Manejar el caso en que la respuesta no fue exitosa
                    console.error("Error en la solicitud al servidor: " + xhr.status);
                }
            }
        };
        xhr.send(formData);
    });
</script>



</html>
