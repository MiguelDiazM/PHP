<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

header("Conten-Type: application/json"); // Se usa para enviar una cabecera HHTP a palo seco
// normalmente lo hemos usado para redirigir (con location)
// pero tambien lo podemos usar para indicar el tipo de 
// contenido de las respuestas
require("funciones/conexion_pdo.php");

$metodo = $_SERVER["REQUEST_METHOD"]; // Guardamos el método del cliente en la variable 
$entrada = file_get_contents("php://input"); // Lee el cuerpo de las solicitudes enviadas

var_dump($entrada);

$entrada = json_decode($entrada, true); // Convierte el JSON en un array aasociativo

switch ($metodo) {

    case "GET":

        controlGet($_conexion);

        break;

    case "POST":

        controlPost($_conexion, $entrada);

        break;

    case "PUT":

        controlPut($_conexion, $entrada);

        break;

    case "DELETE":

        controlDelete($_conexion, $entrada);

        break;

    default:

        echo json_encode(["metodo" => "otro"]);

        break;
}

// Empecemos con las funciones!!!! :DDDDD :DDDD :DDD
function controlGet($_conexion)
{

    if (isset($_GET["ciudad"]) && $_GET["ciudad"] != "") {

        $consulta = "SELECT * FROM desarrolladoras WHERE ciudad = :c";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute(["c" => $_GET["ciudad"]]);
    } else {

        $consulta = "SELECT * FROM desarrolladoras";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute();
    }

    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /*
    Devuelve todos los registro como un array ASOCIATIVO
    [
        ["nombre_desarrolladora" => "nombre1", "..",....],
        ["nombre_desarrolladora" => "nombre1", "..",....],
        ["nombre_desarrolladora" => "nombre1", "..",....]
    ]
    */
    echo json_encode($res);
    // Lo contrario que el json_decode(), los valores del array asociativo, os transforma
    //! en JSON y los envia
}

function controlPost($_conexion, $entrada) {

        $consulta = "INSERT INTO desarrolladoras (nombre_desarrolladora, ciudad, anno_fundacion) VALUES (:n, :c, :f)";
        $stmt = $_conexion->prepare($consulta);
        $stmt->execute([
            "n" => $entrada["nombre_desarrolladora"],
            "c" => $entrada["ciudad"],
            "f" => $entrada["anno_fundacion"]
        ]);

    if($stmt) {

        echo json_encode(["mensaje" => "Se ha insertado correctamente la fila"]);
    } else {

        echo json_encode(["mensaje" => "Liada criminal"]);
    }
}

function controlPut($_conexion, $entrada) {

    $consulta = "UPDATE desarrolladoras SET ciudad = :c, anno_fundacion = :f WHERE nombre_desarrolladora = :n";
    $stmt = $_conexion->prepare($consulta);
    $stmt->execute([
        "c" => $entrada["ciudad"],
        "f" => $entrada["anno_fundacion"],
        "n" => $entrada["nombre_desarrolladora"]
    ]);

    if ($stmt) {
        echo json_encode(["mensaje" => "Se ha modificado correctamente la fila"]);
    } else {
        echo json_encode(["mensaje" => "Liada criminal"]);
    }
}

function controlDelete($_conexion, $entrada){
    echo "HOLAA";
    $consulta = "DELETE FROM desarrolladoras WHERE nombre_desarrolladora = :n";
    $stmt = $_conexion->prepare($consulta);
    $stmt->execute([
        "n" => $entrada["nombre_desarrolladora_borrar"]
    ]);

    if ($stmt) {
        echo json_encode(["mensaje" => "Se ha borrado correctamente "]);
    } else {
        echo json_encode(["mensaje" => "Error a la hora de eliminar la desarrolladora (Liada criminal)"]);
    }
}


