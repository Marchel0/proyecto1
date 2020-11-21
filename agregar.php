<?php
    require("conexion.php");

    $nombre_edificio = $_POST["nombre_edificio"];
    $aforo_total = $_POST["aforo_total"];
    
    if(!empty($_POST["nombre_edificio"]) and !empty($_POST["aforo_total"])){
    $insert = "INSERT INTO edificio (nombre_edificio, aforo_total)
               VALUES ('$nombre_edificio', '$aforo_total')";
                $result = mysqli_query($conexion,$insert);
    }
         

    header("Location: mantenedor.php");

?>
