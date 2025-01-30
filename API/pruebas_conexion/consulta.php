<?php
    require("../funciones/conexion_pdo.php");


    /**
     * Consulta sencilla con query(). Recuperar todos los datos de la tabla desarrolladoras y mostrarlos
    */

    echo "<h2 style='text-align: center;'> Recuperación de datos de desarrolladoras</h2>";

    try{

        $res = $_conexion -> query("SELECT * FROM desarrolladoras");

        while($fila = $res -> fetch()){
            echo "ID: ". $fila["id_desarrolladora"];
            echo "Desarrolladoras: ".  $fila ["nombre_desarrolladora"];
            echo "Ciudad: ". $fila["ciudad"];
            echo "Año fundación: ". $fila["anno_fundacion"]."<br>";
        }

        /**
         * 
         * / SEGUNDA FORMA DE ITERAR
         *foreach($res as $filas) {
         *   echo "ID: " . $fila["ID_desarrolladora"] . " | Desarrolladora: " . $fila["nombre_desarrolladora"] . 
         *   " | Ciudad: " . $fila["ciudad"] . " | Año de fundacion: " . $fila["anno_fundacion"] . "<br>";
         * }
         */

    } catch(PDOException $e){
        echo "ERROR -> ". $e-> getMessage();
    }



?>