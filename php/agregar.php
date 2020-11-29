<?php
    require("conexion.php");

    $nombre_edificio = $_POST["nombre_edificio"];
    $aforo_total = $_POST["aforo_total"];
    $rut=$_POST['rut_persona'];
    
    $sql_aforo=  "SELECT aforo_permitido FROM edificio LIMIT 1";
    $validacion_aforo = mysqli_query($conexion, $sql_aforo);
    $aforo_permitido = mysqli_fetch_array($validacion_aforo)['aforo_permitido'];
    
    if(!empty($_POST["nombre_edificio"]) and !empty($_POST["aforo_total"])){
    $insert = "INSERT INTO edificio (nombre_edificio, aforo_total, aforo_permitido)
               VALUES ('$nombre_edificio', '$aforo_total', ' $aforo_permitido')";
                $result = mysqli_query($conexion,$insert);
    }
         

    header("Location: mantenedor.php?rut_persona=$rut");

?>
