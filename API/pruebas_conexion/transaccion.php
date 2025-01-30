<?php
    require("../funciones/conexion_pdo.php");

    //Inserta varias filas en una sola transacción

    try{
        $_conexion -> beginTransaction();

        $consulta = $_conexion -> prepare("INSERT INTO desarrolladoras (nombre_desarrolladora, ciudad, anno_fundacion) VALUES (?, ?, ?)");

        $consulta -> execute(["DAW1", "Malagueta", 2025]);
        $consulta -> execute(["DAW2", "Sevilleta", 2024]);
        $consulta -> execute(["DAW3", "Madrileta", 2023]);

        $_conexion -> commit();

    } catch(PDOException $e){
        $_conexion -> rollBack();
        echo "Error -> " . $e -> getMessage();
    }

?>