<?php
    require("conexion.php");
    date_default_timezone_set("America/Santiago");

    $rut_persona = $_POST["rut_persona"];
    $id_edificio = $_POST["id_edificio"];
    $fecha_actual = date('Y-m-d H:i:s');
    
    $consulta = "SELECT count(rut_persona) as permanece FROM permanecer WHERE rut_persona = '$rut_persona' AND fecha_salida is NULL";
    
    $result = mysqli_query($conexion, $consulta);
    while($row = mysqli_fetch_array($result)){
        if($row['permanece'] > 0){
            $update = "UPDATE permanecer SET fecha_salida = '$fecha_actual' WHERE rut_persona = '$rut_persona' AND fecha_salida is NULL";

            $result = mysqli_query($conexion, $update);
        }else{
            $insert = "INSERT INTO permanecer (rut_persona, id_edificio, fecha_entrada, fecha_salida) VALUES ('$rut_persona', '$id_edificio', '$fecha_actual', NULL)";

            $result = mysqli_query($conexion, $insert);
        }
    }
    
?>