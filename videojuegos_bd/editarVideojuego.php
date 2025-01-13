<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php


        error_reporting(E_ALL);
        ini_set("display_errors",1);
        require("conexion.php");
        require ("funciones.php");
        comprobarSesion();
        
    ?>
</head>
<body>
    <?php
        
        $desarrolladoras = [];

        $res = $_conexion -> query("SELECT * FROM desarrolladoras");

        while ($fila = $res -> fetch_assoc()){
            array_push($desarrolladoras, $fila["nombre_desarrolladora"]);
        }

        if(!isset($_GET["id_videojuego"])){
            die("ERROR: No se ha encontrado un id que editar");
        } else {
            $id_videojuego = $_GET["id_videojuego"];
        }

        $consulta = "SELECT * FROM videojuegos WHERE id_videojuego = $id_videojuego";
        $res = $_conexion -> query($consulta);

        if($res -> num_rows == 0) die("ERROR: No existe una fila con el id $id_videojuego");
        else $juego = $res -> fetch_assoc();
        
        $titulo = $juego["titulo"] ?? "";
        $nombre_desarrolladora = $juego["nombre_desarrolladora"] ?? "";
        $anno_lanzamiento = $juego["anno_lanzamiento"] ?? "";
        $porcentaje_reseñas = $juego["porcentaje_reseñas"] ?? "";
        $horas_duracion = $juego["horas_duracion"] ?? "";

        $idUrl = $_GET["id_videojuego"];
        $tituloVideojuego = $_conexion -> query("SELECT titulo FROM videojuegos WHERE id_videojuego = '$idUrl'");

        $tituloVideojuego = $tituloVideojuego -> fetch_assoc();
        
        
        
    ?>
    
    <div class="container">
        <h3 class="display-6">Vas a modificar <?php echo $tituloVideojuego["titulo"]?></h3>
        
        <form action="" method="post">

            <input type="hidden" name="id_videojuego"  value=<?php echo $_GET["id_videojuego"]?>>

            <label for="titulo" class="form-label">Titulo: </label>
            <input type="text" name="titulo" class="form-control" value="<?php echo $titulo;?>"> <br>

            <label for="nombre_desarrolladora" class="form-label">Nombre desarrolladora: </label>
            <select name="nombre_desarroladora" class="form-control">
                <option value="<?php echo $nombre_desarrolladora; ?>" selected>
                    <?php echo $nombre_desarrolladora; ?>
                </option>
                <?php foreach($desarrolladoras as $desarrolladora){
                    if($desarrolladora != $nombre_desarrolladora){
                        echo "<option value=$desarrolladora>$desarrolladora</option>";
                    }
                } ?>
            </select><br>

            <label for="anno_lanzamiento" class="form-label">Año lanzamiento: </label>
            <input type="text" name="anno_lanzamiento" class="form-control" value=<?php echo $anno_lanzamiento; ?>><br>

            <label for="porcentaje_resenas" class="form-label">Porcentaje reseñas: </label>
            <input type="text" name="porcentaje_resenas" class="form-control" value=<?php echo $porcentaje_reseñas; ?>><br>

            <label for="horas_duracion" class="form-label">Horas duracion: </label>
            <input type="text" name="horas_duracion" class="form-control" value=<?php echo $horas_duracion;  ?>><br>

            <input type="submit" value="Enviar" class="btn btn-primary">
            <a href="index.php" class="btn btn-secondary">Volver al menu principal</a>
        </form>
    </div>

    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["id_videojuego"])) $id_videojuego = $_POST["id_videojuego"];
            else $id_videojuego = "";

            if(isset($_POST["titulo"])) $temp_titulo = $_POST["titulo"];
            else $temp_titulo = "";

            if(isset($_POST["nombre_desarrolladora"])) $temp_nombre_desarrolladora = $_POST["nombre_desarrolladora"];
            else $temp_nombre_desarrolladora = "";

            if(isset($_POST["anno_lanzamiento"])) $temp_anno_lanzamiento = $_POST["anno_lanzamiento"];
            else $temp_anno_lanzamiento = "";

            if(isset($_POST["porcentaje_resenas"])) $temp_porcentaje_resenas = $_POST["porcentaje_resenas"];
            else $temp_porcentaje_resenas = "";
        
            if(isset($_POST["horas_duracion"])) $temp_horas_duracion = $_POST["horas_duracion"];
            else $temp_horas_duracion = "";


            
            if($temp_titulo == ""){
                $err_titulo = "El titulo no puede estar vacio";
            } else {
                $titulo = $temp_titulo;
            }

            if($temp_nombre_desarrolladora == ""){
                $err_nombre_desarrolladora = "El nombre no puede estar vacio";
            } else {
                $nombre_desarrolladora= $temp_nombre_desarrolladora;
            }


            if($temp_anno_lanzamiento == ""){
                $err_anno_lanzamiento = "Debes introducir un valor valido";
            } else {
                if(!filter_var($temp_anno_lanzamiento, FILTER_VALIDATE_INT)){
                    $err_anno_lanzamiento = "Debes introducir un valor positivo";
                } else {
                    if($temp_anno_lanzamiento <1){
                        $err_anno_lanzamiento = "Debes introducir un valor valido";
                    } else {
                        $anno_lanzamiento= $temp_anno_lanzamiento;
                    }
                }
            }

            if($temp_porcentaje_resenas == ""){
                $temp_porcentaje_resenas = NULL;
            } else {
                if(!filter_var($temp_porcentaje_resenas, FILTER_VALIDATE_FLOAT)){
                    $err_porcentaje_resenas = "Debes introducir un valor positivo";
                } else {
                    if($temp_porcentaje_resenas <1){
                        $err_porcentaje_resenas = "Debes introducir un valor valido";
                    } else {
                        $porcentaje_resenas = $temp_porcentaje_resenas;
                    }
                }
            }

            if($temp_horas_duracion == ""){
                $err_horas_duracion = "Debes introducir un valor valido";
            } else {
                if(!filter_var($temp_horas_duracion, FILTER_VALIDATE_FLOAT)){
                    $err_horas_duracion = "Debes introducir un valor positivo";
                } else {
                    if($temp_horas_duracion <1){
                        $err_horas_duracion = "Debes introducir un valor valido";
                    } else {
                        $horas_duracion = $temp_horas_duracion ;
                    }
                }
            }
            
        if(isset($titulo) && isset($nombre_desarrolladora) && isset($anno_lanzamiento) && isset($porcentaje_resenas) && isset($horas_duracion)){
            
            $consulta = "UPDATE videojuegos SET 
                                titulo = '$titulo',
                                nombre_desarrolladora = '$nombre_desarrolladora',
                                anno_lanzamiento = '$anno_lanzamiento',
                                porcentaje_reseñas = '$porcentaje_resenas',
                                horas_duracion = '$horas_duracion'
                                WHERE id_videojuego = '$id_videojuego'";

            $_conexion -> query($consulta);

            header("location: index.php");
        }
        }
    ?>
    
</body>
</html>