<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="ejercicios.php" method="POST">
        <input type="hidden" name="form" value="ej1">
        <input type="submit" value="Ejercicio 1">
    </form>




    <form action="ejercicios.php" method="POST">
        <input type="hidden" name="form" value="ej2">
        <input type="number" name="num1">
        <input type="number" name="num2">
        <input type="submit" value="Ejercicio 2">
    </form>

    <form action="ejercicios.php" method="GET">
        <input type="hidden" name="form" value="ej3">
        <input type="text" name="operacion">
        <input type="submit" value="Ejercicio 3">
    </form>


    <form action="ejerciciosExamenOriginal.php" method="POST">
        <input type="hidden" name="form" value="ej1">
        <input type="number" name="filas">
        <input type="submit" value="Pascal">
    </form>

    <form action="ejerciciosExamenOriginal.php" method="POST">
        <input type="hidden" name="form" value="ej2">
        <input type="number" name="filas">
        <input type="submit" value="Floid">
    </form>

    <form action="ejerciciosExamenOriginal.php" method="post">
        <input type="hidden" name="form" value="ej3">
        <input type="number" name="numero">
        <input type="submit" value="Traspuesta">

    </form>
    
</body>
</html>