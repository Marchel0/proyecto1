<?php

    require("conexion.php");

    $id_edificio = $_POST["id_edificio"];

    $query = "SELECT nombre_edificio, aforo_total, aforo_permitido FROM edificio WHERE id_edificio = '$id_edificio'";
    
    $result = mysqli_query($conexion, $query);
    
    if(!$result) {
        die('Query Error'.mysqli_error($conexion));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {

        $query = "SELECT COUNT(rut_persona) as aforo_actual FROM permanecer WHERE id_edificio = '$id_edificio' AND fecha_salida is NULL";
        $aforo_actual = mysqli_query($conexion, $query);

        $query = "SELECT (COUNT(oficina.rut_persona) + (SELECT COUNT(rut_persona) FROM personal_requerido WHERE id_edificio = '$id_edificio')) as personal_edificio FROM oficina JOIN edificio USING(id_edificio) WHERE id_edificio = '$id_edificio'";
        $personal_edificio = mysqli_query($conexion, $query);

        $query = "SELECT COUNT(permanecer.rut_persona) as personal_requerido_actual FROM permanecer JOIN persona USING(rut_persona) JOIN personal_requerido USING(rut_persona) WHERE permanecer.id_edificio = '$id_edificio' AND fecha_salida IS NULL";
        $personal_requerido_actual = mysqli_query($conexion, $query);

        $query = "SELECT COUNT(permanecer.rut_persona) as personal_oficina_actual FROM permanecer JOIN edificio USING(id_edificio) JOIN oficina USING(rut_persona) WHERE oficina.id_edificio = '$id_edificio' AND oficina.rut_persona is NOT null AND fecha_salida IS NULL";
        $personal_oficina_actual = mysqli_query($conexion, $query);

        $json[] = array(
        'nombre_edificio' => $row['nombre_edificio'],
        'aforo_actual' => mysqli_fetch_array($aforo_actual)['aforo_actual'],
        'aforo_permitido' => $row['aforo_total']*($row['aforo_permitido']/100),
        'personal_edificio' => mysqli_fetch_array($personal_edificio)['personal_edificio'],
        'aforo_personal_actual' => mysqli_fetch_array($personal_requerido_actual)['personal_requerido_actual']+ mysqli_fetch_array($personal_oficina_actual)['personal_oficina_actual']

    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>