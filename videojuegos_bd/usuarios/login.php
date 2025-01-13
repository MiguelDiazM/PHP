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
        require "../funciones.php";

        comprobarLogin();
        
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

                if(in_array($temp_usuario, $usuarios)){
                    $usuario = $temp_usuario;
                    if($temp_password == ""){
                        $err_password = "Debes introducir una contraseña";
                    } else {
                        $user = $_conexion -> query("SELECT password FROM usuarios WHERE user = '$usuario'");
                        $user = $user -> fetch_assoc();
                        
                        htmlspecialchars($temp_password);

                        if(password_verify($temp_password, $user["password"])){
                            $password = $temp_password;
                        } else {
                            $err_password = "Has introducido una contraseña incorrecta";
                        }
                    }
                } else {
                    $err_usuario = "Ese usuario no existe, introduce otro";
                }
            }
        }
    ?>

</head>
<body>
<div class="container">
        <h1>Iniciar sesión</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario">
                <?php if(isset($err_usuario)) echo "<span class='text-danger'>$err_usuario</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasena">
                <?php if(isset($err_password)) echo "<span class='text-danger'>$err_password</span>" ?>
            </div>
            <div class="mb-3">
                <input type="submit" value="Iniciar sesión" class="btn btn-primary">
                <?php
                    if(isset($usuario) && isset($password)){
                        echo "<span class='text-success'>Inicio de sesión correcto, seras redigirido en 3 segundos</span>";

                        if(session_start()){
                            $_SESSION["usuario"] = $usuario;
                            header("location:../index.php");
                        }
                        
                    }
                ?>
            </div>
        </form>
        <h3>Si aún no estas registrado, pincha debajo</h3>
        <a href="register.php" class="btn btn-secondary">Registrarse</a>
    </div>
</body>
</html>

