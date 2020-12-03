<?php
    session_start();
    require('conexion.php');
    $rut= $_SESSION['rut_persona'];
    $trn_date = date("Y-m-d H:i:s");
    $update =   "UPDATE cuenta
    SET ultima_conexion='$trn_date'
    WHERE rut_persona='$rut'";
    $result = mysqli_query($conexion, $update);

    if(session_destroy()){
        header("Location: login.php");
    }
?>