<?php

    require("conexion.php");

    $id_cuenta = $_POST["id_cuenta"];

    $query = "SELECT nombre, tipo_cuenta FROM persona JOIN cuenta USING(rut) WHERE id_cuenta='$id_cuenta'";

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