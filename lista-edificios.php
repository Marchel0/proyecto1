<?php

    require("conexion.php");

    $query = "SELECT nombre_edificio, COUNT(rut) as aforo_actual, aforo_total FROM edificio JOIN permanecer USING(id_edificio) WHERE fecha_salida IS NULL GROUP BY id_edificio;";

    $result = mysqli_query($conexion, $query);
  
    if(!$result) {
        die('Query Error' . mysqli_error($conexion));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'nombre_edificio' => $row['nombre_edificio'],
        'aforo_actual' => $row['aforo_actual'],
        'aforo_total' => $row['aforo_total']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>