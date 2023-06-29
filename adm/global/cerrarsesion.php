<?php

session_start();
session_destroy();
header("Location:/pag/recuperar/login.php");
?>