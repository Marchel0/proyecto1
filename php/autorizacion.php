<?php
    session_start();
    if(!isset($_SESSION["rut_persona"])){
        header("Location: login.php");
    }
?>
