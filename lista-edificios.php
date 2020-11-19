<?php

    require("conexion.php");

    $query = "SELECT id_edificio, nombre_edificio, aforo_total FROM edificio";

    $result = mysqli_query($conexion, $query);
  
    if(!$result) {
        die('Query Error' . mysqli_error($conexion));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $id_edificio = $row['id_edificio'];

        $query = "SELECT COUNT(rut) as aforo_actual FROM permanecer WHERE id_edificio = '$id_edificio AND fecha_salida is NULL'";
        $aforo_total = mysqli_query($conexion, $query);
        
        $json[] = array(
        'id_edificio' => $row['id_edificio'],
        'nombre_edificio' => $row['nombre_edificio'],
        'aforo_actual' => mysqli_fetch_array($aforo_total)['aforo_actual'],
        'aforo_total' => $row['aforo_total']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>