<?php
    require("../funciones/conexion_pdo.php");

    //Consulta con prepare() y execute(),
    //recupera una fila específica de la tabla desarrolladoras usando una consultita
    echo "<h2 text-align = 'center'> Recuperación de datos de dessarolladoras con prepare y execute";

    try{
        $consulta = $_conexion -> prepare("SELECT * FROM desarrolladoras WHERE nombre_desarrolladora = :nombre");

        $consulta -> execute(["nombre" => "Valve" ] );

        $fila = $consulta -> fetch();

        if($fila){
            echo "BOMBA <br>";
            echo "ID: ". $fila["id_desarrolladora"];
            echo "Desarrolladoras: ".  $fila ["nombre_desarrolladora"];
            echo "Ciudad: ". $fila["ciudad"];
            echo "Año fundación: ". $fila["anno_fundacion"]."<br>";

        } else {
            echo "CAGADA <br>";
        }


        

    } catch (PDOException $e){
        echo "ERROR -> ". $e-> getMessage();
    }

?>