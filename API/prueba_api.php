<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div>

        <h1>Testinggg</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Selecciona el método</label>
                <select name="metodo" class="form-select">
                    <option value="GET">GET (Recuperar datos)</option>
                    <option value="POST">POST (Insertar datos)</option>
                    <option value="PUT">PUT(Modificar datos)</option>
                    <option value="DELETE">DELETE(Borrar datos)</option>
                </select>
            </div>
            <div id="datosPosts" class="mb-3">
                <label class="form-label">Datos para POST:</label>
                <input type="text" name="nombre_desarrolladora" class="form-control" placeholder="Nombre desarrolladora">
                <input type="text" name="ciudad" class="form-control" placeholder="Nombre de la ciudad">
                <input type="number" name="anno_fundacion" class="form-control" placeholder="Año de fundación">
            </div>
            <div id="datosPosts" class="mb-3">
                <label class="form-label">Datos para DELETE:</label>
                <input type="text" name="nombre_desarrolladora_borrar" class="form-control" placeholder="Nombre desarrolladora borrar">
            </div>
            <button type="submit" class="btn btn-primary">Insertar datito</button>
        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $metodo = $_POST["metodo"];
            $url = "http://localhost/entornoserverphp/API/nucleoAPI.php";
            $datos = [];
            if ($metodo == "GET") {

                echo "<h3>Hemos lanzao un get</h3>";

                // Construir la URL depediendo de si se proporciona una ciudad o no
                $ciudad = isset($_POST["ciudad"]) && !empty($_POST["ciudad"]) ? "?ciudad=" . urlencode($_POST["ciudad"]) : ""; // urlencode para quitarte caracteres especiales y adaptarlo a una url

                $url = "http://localhost/entornoserverphp/API/nucleoAPI.php" . $ciudad;

                echo "URL generada: " . htmlspecialchars($url) . "<br>";

                try {
                    $res = file_get_contents($url);
                    echo "<pre>" . htmlspecialchars($res) . "</pre>";
                } catch (Exception $e) {

                    echo "Error al realizar la solicitud: " . $e->getMessage();
                }
            } else if ($metodo == "POST" || $metodo == "PUT" || $metodo == "DELETE") {

                $datos= match($metodo){
                    "POST", "PUT" => $datos = [
                        "nombre_desarrolladora" => $_POST["nombre_desarrolladora"],
                        "ciudad" => $_POST["ciudad"],
                        "anno_fundacion" => $_POST["anno_fundacion"]
                        ],
                    "DELETE" => $datos = [
                        "nombre_desarrolladora" => $_POST["nombre_desarrolladora_borrar"],
                        ],

                };

               
                $opciones = [
                    "http" => [
                        "header" => "Content-Type: application/json",
                        "method" => $metodo,
                        "content" => json_encode($datos)
                    ]
                ];

                $contexto = stream_context_create($opciones);
                try{
                    $respuesta = file_get_contents($url, false, $contexto);
                    /**
                     * Construye una conexión HTTP usando el contexto por stream_context_create()
                     * y envía la solicitud POST al server con los datos, devuelve la respuesta del 
                     * server si todo va bien o lanza un fallo en caso de que algo vaya mal.
                     *  El false es del atributo $use_include_path, si lo ponemos a false PHP
                     * no buscará el archivo en las rutas especificadas en el inlude_path
                     */
                }catch(Exception $e){
                    echo "Error al realizar la solicitud" . $e -> getMessage();
                }

                echo "<pre>" . htmlspecialchars($respuesta) . "</pre>";
            }
        }

        ?>

    </div>
</body>

</html>