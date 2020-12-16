<?php
    session_start();
    if(!isset($_SESSION["rut_persona"])){
       header('location: login.php');
    }else{
        $rut= $_SESSION['rut_persona'];
        $query = "SELECT tipo_cuenta FROM `cuenta` WHERE rut_persona='$rut'";
        $result = mysqli_query($conexion,$query);
        $tipo_cuenta = mysqli_fetch_assoc($result)['tipo_cuenta'];
        if($tipo_cuenta != "administrador"){
           header('location: login.php');
        }
    }
?>