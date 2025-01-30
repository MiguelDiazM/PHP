<?php
    require("../funciones/conexion_pdo.php");

    //ELIMINAR


    try{

        $consulta = $_conexion -> prepare("DELETE FROM desarrolladoras WHERE id_desarrolladora = :i ");

        $consulta -> execute ([
            ":i" => 7
        ]);
        echo "Se ha borracho correctamente";


    } catch(PDOException $e){
        echo "ERROR: " . $e -> getMessage();
    }

?>