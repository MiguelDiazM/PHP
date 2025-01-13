<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //Almaceno el valor de la etiqueta hidden de cada formulario para cada ejercicio
        $ejercicio=$_POST['form'];

        if($ejercicio=="ej1"){
            //Inicializo el array con los valores de la tabla
            $arrayEstudiantes=["Juanito" => ["Sist. Informaticos" => 9, "Lenguaje de Marcas" => 5, "BBDD" =>7],
                               "Rosa" => ["Sist. Informaticos" => 6, "Lenguaje de Marcas" => 9, "BBDD" =>9],
                               "Hector" => ["Sist. Informaticos" => 4, "Lenguaje de Marcas" => 8, "BBDD" =>7],
                               "Florencia" => ["Sist. Informaticos" => 6, "Lenguaje de Marcas" => 10, "BBDD" =>8],
                               "Eugenio" => ["Sist. Informaticos" => 9, "Lenguaje de Marcas" => 5, "BBDD" =>6]

        ];

        //Con un doble bucle for-each voy recorriendo todos los alumnos y sus notas

        // ! Importante

        //En el primero recorro el array y voy sacando los nombres de los alumnos y el array de sus asignaturas y notas
        foreach ($arrayEstudiantes as $nombre => $asignaturas) {
            //En cada iteración del bucle reseteo la variable media para calcular la del nuevo alumno
            $media=0;
            //Voy haciendo la salida por pantalla por partes para ir concatentando en cada momento lo que necesite sin hacer uso del br para que aparezca en la misma linea
            echo "La nota de $nombre es: ";

            //En este for-each recorro las asignaturas y sus notas
            foreach($asignaturas as $asignatura => $nota){
                //Voy sumando las notas a la media
                $media+=$nota;

                //Con un if controlo la salida para que sea bonita
                if ($asignatura == "Sist. Informaticos"){
                    echo "( $nota  ";
                } else {
                    echo " + $nota" ;
                }
            }
            //Calculo la media con un count por si en algún alumno cambiase el número de asignaturas
            $media/=count($asignaturas);

            //Termino la salida por pantalla
            echo ") / ".  count($asignaturas) . " = $media <br>";
            
        }

        }

        if($ejercicio=="ej2"){
            //Creo la funcion esPerfecto y le paso por parametro $num1 que sera cada uno de los números del 1 al 500
            function esPerfecto($num1){
                //Creo una variable suma para almacenar la suma de los divisores
                $suma=0;

                //Creo un bucle igualando $i a el número que le he pasado menos 1 para que no coja el propio número y le voy restando hasta llegar a 1
                for($i=$num1-1;$i>0;$i--){

                    //Si el divisor de $num1 entre $i es 0 significa que es un divisor por lo que lo guardo en suma
                    if($num1%$i==0){
                        $suma+=$i;
                    }
                }

                //Si la suma de los divisores es igual al número que le he pasado por parametro significa que el número es perfecto por lo que devuelvo true, si no devuelvo false
                if($suma==$num1){
                    return true;
                }
                return false;
            }


            //Recojo los dos números del formulario usando post
            $num1=$_POST["num1"];
            $num2=$_POST["num2"];

            //Si el número 1 es mayor al 2 devuelvo un echo diciendo que no se puede hacer el ejercicio
            if($num1>$num2){
                echo "El número 1 tiene que ser menor al 2";
            } else {
                //Recorro los números desde $num1 hasta $num2 y voy llamando a la función pasando $i como parametro, si devuelve true $i es perfecto.
                echo "Números perfectos de $num1 a $num2: <br>";
                for($i=$num1;$i<$num2;$i++){
                    if(esPerfecto($i)){
                        echo "$i es perfecto<br>";
                    }
                }
            }
        }

       


    }

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $ejercicio=$_GET['form'];

        if($ejercicio=="ej3"){
            //Función para generar array a la que le paso filas y columnas 
            function generarArrayRand($filas, $columnas){
                //Creo un array vacio que devolvere con un return
                $resultado = [];

                //Usando un doble bucle for voy rellenando el array con números aleatorios del 1 al 10
                for ($i = 0; $i < $filas; $i++){
                    for($j = 0; $j < $columnas; $j++){
                        $resultado[$i] [$j] = rand(1,10);
                    }
                }
                //Devuelvo el array
                return $resultado;
            }

            //Funcion que le paso por parametro los dos arrays para sumarlos
            function sumarArray($array1, $array2){
                $resultado=[];

                //Usando el doble bucle for voy sumando las dos posiciones de cada array
                for($i=0;$i<3;$i++){
                    for($j=0;$j<3;$j++){
                        $resultado[$i][$j] = $array1[$i][$j] + $array2[$i][$j];
                    }
                }

                return $resultado;
            }

             //Funcion que le paso por parametro los dos arrays para restarloa
            function restarArray($array1, $array2){
                $resultado=[];

                //Usando el doble bucle for voy restando las dos posiciones de cada array
                for($i=0;$i<3;$i++){
                    for($j=0;$j<3;$j++){
                        $resultado[$i][$j] = $array1[$i][$j] - $array2[$i][$j];
                    }
                }

                return $resultado;
            }

            //Funcion que muestra los arrays en modo tabla html
            function mostrarTabla($array){

                //Usando un echo hago la etiqueta table con el border 1
                echo "<table border='solid'>";
                //Usando un doble bucle for en cada iteracion de la i creo un tr y en cada iteración de la j un td con la posición del array
                for($i=0;$i<3;$i++){
                    echo "<tr>";
                    for($j=0;$j<3;$j++){
                        echo "<td>".$array[$i][$j]."</td>";
                    }
                    echo "</tr>";
                }
            }

            //Recupero del formulario get la operación que quiere hacer (Suma o resta)
            $operacion=$_GET['operacion'];


            

            //Si operacion no es suma o resta corto la ejecución
            if($operacion!= "suma" && $operacion != "resta"){
                echo "Debes introducir suma o resta";
            } else {
                //Si es suma o resta genero los arrays
                $array1=generarArrayRand(3,3);
                $array2=generarArrayRand(3,3);

                //Si es suma genero el array resultado con la funcion sumarArray y si no es hago lo mismo pero con resta ya que no hay mas opciones
                if($operacion =="suma"){
                    $resultado = sumarArray($array1, $array2);

                } else {
                    $resultado = restarArray($array1, $array2);
                }

               
                //Muestro los arrays con la función mostrarTabla
                mostrarTabla($array1);
                echo "Array 1: ";
                
                mostrarTabla($array2);
                echo "<br>";
                echo "Array 2: ";
                
                mostrarTabla($resultado);
                echo "<br>";
                echo "Resultado de la $operacion: ";

            }

            
        }
    }


?>