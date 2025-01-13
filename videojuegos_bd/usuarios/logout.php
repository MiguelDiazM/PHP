<?php

    require("../funciones.php");
    comprobarSesion();

    session_start();
    session_destroy();
    header("location: login.php");

?>