<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indice</title>
    
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        require "conexion.php";
        require ("funciones.php");

        comprobarSesion();
    ?>
    
</head>
<body >
<div class="container text-center mt-5">
        <h1>Bienvenido de nuevo, <?php echo $_SESSION["usuario"]?></h1>
        <p class="mt-3">Elige una opción:</p>
        <div class="d-grid gap-3 col-6 mx-auto mt-4">
            <a href="nuevoVideojuego.php" class="btn btn-primary btn-lg">Crear un nuevo videojuego</a>
            <a href="videojuegos.php" class="btn btn-secondary btn-lg">Listado de videojuegos</a>
            <a href="listadoDesarrolladoras.php" class="btn btn-info btn-lg">Listado de desarrolladoras</a>
            
            <a href="usuarios/logout.php" class="btn btn-danger btn-lg">Cerrar sesion</a>
        </div>
    </div>
    




</body>
</html>