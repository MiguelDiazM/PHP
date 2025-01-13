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
<body>
    <?php
        echo "<br><br>";

        if(!isset($_GET["orden"])){
            $consulta = "SELECT * FROM desarrolladoras";
        } else {
            $orden = $_GET["orden"];

            if($orden == "idAsc"){
                $consulta = "SELECT * FROM desarrolladoras ORDER BY id_desarrolladora";
            } else if($orden == "idDesc" ){
                $consulta = "SELECT * FROM desarrolladoras ORDER BY id_desarrolladora DESC";

            } else if($orden == "anAsc"){
                $consulta = "SELECT * FROM desarrolladoras ORDER BY anno_fundacion";
            } else {
                $consulta = "SELECT * FROM desarrolladoras ORDER BY anno_fundacion DESC";
            }
        }
    
        $_tablita = $_conexion -> query($consulta);


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $registro = $_POST["registro"];
        $_conexion -> query("DELETE FROM videojuegos WHERE id_videojuego=$registro");
    }

    ?>




<a href="listadoDesarrolladoras.php?orden=idAsc" class="btn btn-warning">Ordenar por id(Asc)</a>
<a href="listadoDesarrolladoras.php?orden=idDesc" class="btn btn-warning">Ordenar por id(Desc)</a>
<a href="listadoDesarrolladoras.php?orden=anAsc" class="btn btn-warning">Ordenar por año(Asc)</a>
<a href="listadoDesarrolladoras.php?orden=anDesc" class="btn btn-warning">Ordenar por año(Desc)</a>
<table class="table table-striped text-center">
  <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Ciudad</th>
        <th scope="col">Año de Fundacion</th>
      
      
    </tr>
  </thead>
  <tbody>
  <?php
    if ($_tablita -> num_rows > 0) {
        while($fila = $_tablita -> fetch_assoc()) {
            echo "<tr align='center'>";
                echo "<th scope='row'>" . $fila["id_desarrolladora"] . "</td>";
                echo "<td>" . $fila["nombre_desarrolladora"] . "</td>";
                echo "<td>" . $fila["ciudad"] . "</td>";
                echo "<td>" . $fila["anno_fundacion"] . "</td>";
                
                ?>
                
                
                <?php


            echo "</tr>";
        }
    } else {
        echo "No se han encontrado datos <br>";
    }
    ?>
  </tbody>
</table>
<a href="index.php" class="btn btn-secondary">Volver al menu principal</a>



</body>
</html>