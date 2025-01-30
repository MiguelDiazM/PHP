<?php
    require("../funciones/conexion_pdo.php");


    //INSERTAR DATOS 
    echo "<h2 style=text-align: 'center';>INSERCIÓN</h2>";

    try{

        $consulta = $_conexion -> prepare("INSERT INTO desarrolladoras (nombre_desarrolladora, ciudad, anno_fundacion) VALUES (:n, :c, :a)");

        $consulta -> execute([
            "n" => "nombreEjemplo",
            "c" => "ciudadEjemplo",
            "a" => "annoEjemplo"
        ]);
        echo "Desarrolladora insertada correctamente ";

    } catch(PDOException $e){

        echo "ERROR -> ". $e -> getMessage();

    }

?>