<?php
session_start();
    if(!isset($_SESSION['correo']) ){
        header("Location:../cliente/login.html");
       // print_r($_SESSION['correo']);
    }{
       //print_r($_SESSION['correo']);
       
    }

?>