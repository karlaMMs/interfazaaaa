<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Agregar la referencia a Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <nav class="navbar navbar-light" style="background-color: #729740;">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="images/LogoNav.png" alt="" width="40%" height="30%">
          </a>
        </div>
      </nav>
    <div class="container mt-5 ">
        <div class="row justify-content-center ">
            <div class="col-md-6 col-sm-12 Contenedor">
                <form class="mx-5" method="post" id="form_login" name="form_login">
                    <h1 class="mb-4">Iniciar Sesión</h1>
                    <br>
                    <div id="id_login_validation" hidden>
                        <span style="color: red">
                            Credenciales inválidas.
                        </span>
                    </div>
                    <div class="form-group" style="padding-top:2rem;">
                        <label for="username"></label>
                        <input type="email" id="username" name="username" class="dato"  placeholder="Email" required>
                    </div>
                    <br>
                    <div class="form-group" style="padding-top:1rem; padding-bottom:2rem;">
                        <label for="password"></label>
                        <input type="password" id="password" name="password" class="dato" placeholder="Contraseña" required>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center" style="flex-direction:column; text-align:center;">
                        <button type="submit" class="btn btn_login">Ingresar</button>
                    </div>
                    <br><br><br>
                    <span style="color: #494949;">¿Aún no tienes una cuenta? &nbsp;</span>
                    <a class="link" href="register.php">Registrate Aquí.</a>
                </form>
            </div>
            
        </div>
    </div>
    <script src="javascript/jquery-3.7.1.min.js"></script>
    <script src="javascript/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    include "conexion.php";
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtén las credenciales del formulario
        $email = $_POST["username"];
        $password = $_POST["password"];

        // Consulta para verificar las credenciales
        $query = "SELECT id_user FROM users WHERE email = '$email' AND user_password = '$password'";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 1) {
                // Usuario autenticado correctamente
                $user_data = mysqli_fetch_assoc($result);
                $_SESSION['id_user'] = $user_data['id_user']; // Guarda el id_user en la sesión
                header("Location: index.php");
                exit();
            } else {
                // Usuario no autenticado, muestra alerta y redirige a la página de inicio de sesión
                echo "<script>document.getElementById('id_login_validation').hidden = false;</script>";
                exit();
            }
        } else {
            // Manejo de errores, puedes personalizar según tus necesidades
            echo "Error en la consulta: " . mysqli_error($conexion);
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
    }
?>