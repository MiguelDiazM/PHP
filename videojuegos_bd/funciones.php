<?php
    function comprobarSesion(){
        session_start();

        if(!isset($_SESSION["usuario"])){ 
            header("location: usuarios/login.php");
            exit;
        } 
    }

    function comprobarLogin(){
        session_start();

        if(isset($_SESSION["usuario"])){
            header("location: ../index.php");
        }
    }

?>