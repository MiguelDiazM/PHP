<?php
    require("../funciones/conexion_pdo.php");


    try{
        $consulta = $_conexion -> prepare("UPDATE desarrolladoras SET ciudad = :c WHERE nombre_desarrolladora = :n ");

        $consulta -> execute ([
            ":c" => "Magala",
            ":n" => "Valve"
        ]);
        echo "Se ha cambiado la ciudad de la desarrolladora :n a :a";
    } catch(PDOException $e){
        echo "ERROR -> ". $e -> getMessage();
    }

?>