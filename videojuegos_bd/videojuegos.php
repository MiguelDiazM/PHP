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
            $consulta = "SELECT * FROM videojuegos";
        } else {
            $orden = $_GET["orden"];

            if($orden == "reAsc"){
                $consulta = "SELECT * FROM videojuegos ORDER BY porcentaje_reseñas";
            } else if($orden == "reDesc" ){
                $consulta = "SELECT * FROM videojuegos ORDER BY porcentaje_reseñas DESC";

            } else if($orden == "idAsc"){
                $consulta = "SELECT * FROM videojuegos ORDER BY id_videojuego";
            } else {
                $consulta = "SELECT * FROM videojuegos ORDER BY id_videojuego DESC";
            }
        }
    
        $_tablita = $_conexion -> query($consulta);

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $registro = $_POST["registro"];
        $_conexion -> query("DELETE FROM videojuegos WHERE id_videojuego=$registro");

        header("location: videojuegos.php");
    }

    ?>




<a href="videojuegos.php?orden=reAsc" class="btn btn-warning">Ordenar por reseñas(Asc)</a>
<a href="videojuegos.php?orden=reDesc" class="btn btn-warning">Ordenar por reseñas(Desc)</a>
<a href="videojuegos.php?orden=idAsc" class="btn btn-warning">Ordenar por id(Asc)</a>
<a href="videojuegos.php?orden=idDesc" class="btn btn-warning">Ordenar por id(Desc)</a>
<table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">ID_videojuego</th>
      <th scope="col">Titulo</th>
      <th scope="col">Nombre desarrolladora</th>
      <th scope="col">Año lanzamiento</th>
      <th scope="col">Porcentaje reseñas</th>   
      <th scope="col">Horas duracion</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
  <?php
    if ($_tablita -> num_rows > 0) {
        while($fila = $_tablita -> fetch_assoc()) {
            echo "<tr align='center'>";
                echo "<th scope='row'>" . $fila["id_videojuego"] . "</td>";
                echo "<td>" . $fila["titulo"] . "</td>";
                echo "<td>" . $fila["nombre_desarrolladora"] . "</td>";
                echo "<td>" . $fila["anno_lanzamiento"] . "</td>";
                if ($fila["porcentaje_reseñas"] === NULL) {
                    echo "<td>" . "No hay suficientes reseñas" . "</td>";
                } elseif ($fila["porcentaje_reseñas"] < 50) {
                    echo "<td>" . "Negativa: " . $fila["porcentaje_reseñas"] . "</td>";
                } elseif ($fila["porcentaje_reseñas"] < 70) {
                    echo "<td>" . "Mediocre: " . $fila["porcentaje_reseñas"] . "</td>";
                } elseif ($fila["porcentaje_reseñas"] < 90) {
                    echo "<td>" . "Buena: " . $fila["porcentaje_reseñas"] . "</td>";
                } else {
                    echo "<td>" . "Excelente: " . $fila["porcentaje_reseñas"] . "</td>";
                }
                if ($fila["horas_duracion"] == -1) {
                    echo "<td>" . "Juego como servicio" . "</td>";
                } else {
                    echo "<td>" . $fila["horas_duracion"] . "</td>";
                }
                ?>
                <td>
                    <a class="btn btn-primary" href="editarVideojuego.php?id_videojuego=<?php echo $fila["id_videojuego"] ?>">EDITAR</a>
                </td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="borrar" value="borrar">
                        <input type="hidden" name="registro" value=<?php echo $fila["id_videojuego"]?>>
                        <input type="submit" value = "BORRAR" class="btn btn-danger">
                    </form>
                </td>
                
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