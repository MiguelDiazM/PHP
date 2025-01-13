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

        session_start();

        if(!$_SESSION["usuario"]){ 
            header("location: usuarios/login.php");
            exit;
        }
    ?>
</head>
<body>
<?php
    $consulta = "SELECT * FROM desarrolladoras ORDER BY nombre_desarrolladora";
    $resultado = $_conexion -> query($consulta);
    $desarrolladoras = [];

    //var_dump($resultado);

    while($fila = $resultado -> fetch_assoc()){
        array_push($desarrolladoras, $fila["nombre_desarrolladora"]);
    }


    if($_SERVER["REQUEST_METHOD"]=="POST"){
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
            $consulta = "INSERT INTO videojuegos (
                titulo,
                nombre_desarrolladora,
                anno_lanzamiento,
                porcentaje_reseñas,
                horas_duracion)
                VALUES
                ('$titulo',
                '$nombre_desarrolladora',
                $anno_lanzamiento,
                $porcentaje_resenas,
                $horas_duracion)";
    
            $_conexion -> query($consulta);
        }
    }
    
?>

    <div class="container">
        <h1 class="display-6">Crear nuevo videojuego</h1>
        <form action="" method="POST">
            <label for="titulo" class="form-label">Titulo: </label>
            <input type="text" name="titulo" class="form-control"><?php if(isset($err_titulo)) echo $err_titulo?><br>

            <label for="nombre_desarrolladora" class="form-label">Desarrolladoras: </label>
            <select name="nombre_desarrolladora" class="form-control">
                <option value="" selected disabled hidden>-----Elija la desarolladora-----</option>
                <?php foreach($desarrolladoras as $desarrolladora){?>
                <option value="<?php echo $desarrolladora?>"><?php echo $desarrolladora?></option>
                <?php }?>
            </select><?php if(isset($err_nombre_desarrolladora)) echo $err_nombre_desarrolladora ?><br>
            
            <label for="anno_lanzamiento" class="form-label">Lanzamiento:</label>
            <input type="text" name="anno_lanzamiento" class="form-control"><?php if(isset($err_anno_lanzamiento)) echo $err_anno_lanzamiento?><br>

            <label for="porcentaje_resenas" class="form-label">Porcentaje reseñas:</label>
            <input type="text" name="porcentaje_resenas" class="form-control"> <?php if(isset($err_porcentaje_resenas)) echo $err_porcentaje_resenas ?> <br>

            <label for="horas_duracion" class="form-label">Horas duracion:</label>
            <input type="text" name="horas_duracion" class="form-control"> <?php if(isset($err_horas_duracion)) echo $err_horas_duracion ?> <br>

            <input type="submit" class="btn btn-primary" value="Enviar">
            <a href="index.php" class="btn btn-secondary">Volver al menu principal</a>
        </form> 
    </div>
    
</body>
</html>