<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        require "../conexion.php";
    ?>

    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(isset($_POST["usuario"])) $temp_usuario = $_POST["usuario"];
            else $temp_usuario = "";

            if(isset($_POST["contrasena"])) $temp_password = $_POST["contrasena"];
            else $temp_password = "";


            if($temp_usuario == ""){
                $err_usuario = "Debes introducir un usuario";
            } else {
                htmlspecialchars($temp_usuario);
                trim($temp_usuario);
                $usuarios = [];

                $res = $_conexion -> query("SELECT * FROM usuarios");

                while ($fila = $res -> fetch_assoc()){
                    array_push($usuarios, $fila["user"]);
                }

                if(!in_array($temp_usuario, $usuarios)){
                    $usuario = $temp_usuario;
                } else {
                    $err_usuario = "Ese usuario ya existe, introduce otro";
                }
            }


            if($temp_password == ""){
                $err_password = "Debes introducir una contraseña";
            } else {
                htmlspecialchars($temp_password);

                $password = $temp_password;
            }





            if(isset($usuario) && isset($password)){
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                $consulta = "INSERT INTO usuarios VALUES ('$usuario', '$password_hashed')";


                $_conexion -> query($consulta);
            }

        }
    ?>
</head>
<body>
<div class="container">
        <h1>Formulario de registro :D</h1>
        <form action="" method="post" enctype="multipart/form-data" class="col-4">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control">
                <?php if (isset($err_usuario)) echo "<span class='text-danger'>$err_usuario</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control">
                <?php if (isset($err_password)) echo "<span class='text-danger'>$err_password</span>" ?>
            </div>
            <div class="mb-3">
                <input type="submit" value="Registrarse" class="btn btn-primary">
            </div>
        </form>
        <h3>Si ya tienes cuenta, inicia sesión</h3>
        <a href="login.php" class="btn btn-secondary">Iniciar sesión</a>
    </div>
</body>
</html>