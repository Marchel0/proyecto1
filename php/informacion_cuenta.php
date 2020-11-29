<?php

    require("conexion.php");

    $rut_persona = $_POST["rut_persona"];

    $query = "SELECT nombre_persona, tipo_cuenta FROM persona JOIN cuenta USING(rut_persona) WHERE rut_persona='$rut_persona'";

    $result = mysqli_query($conexion, $query);

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
        'nombre' => $row['nombre_persona'],
        'tipo_cuenta' => $row['tipo_cuenta']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;