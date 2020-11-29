<?php

    require("conexion.php");

    $rut = $_POST["rut"];

    $query = "SELECT nombre_persona, tipo_cuenta FROM persona JOIN cuenta USING(rut_persona) WHERE rut_persona='$rut'";

    $result = mysqli_query($conexion, $query);

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
        'nombre' => $row['nombre'],
        'tipo_cuenta' => $row['tipo_cuenta']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;