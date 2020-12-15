<?php
    require("conexion.php");
    date_default_timezone_set("America/Santiago");

    $rut_persona = $_POST["rut_persona"];
    $id_edificio = $_POST["id_edificio"];
    $fecha_actual = date('Y-m-d H:i:s');
    
    $consulta = "SELECT count(rut_persona) as permanece FROM permanecer WHERE rut_persona = '$rut_persona' AND fecha_salida is NULL";
    $seEncuentra = mysqli_query($conexion, $consulta);

    $query = "SELECT aforo_total, aforo_permitido FROM edificio WHERE id_edificio = '$id_edificio'";
    $datosEdificio = mysqli_query($conexion, $query);

    $query = "SELECT COUNT(rut_persona) as es_personal_oficina FROM edificio JOIN oficina USING(id_edificio) WHERE id_edificio = '$id_edificio' AND rut_persona = '$rut_persona'";
    $personal_oficina = mysqli_query($conexion, $query);
    $es_personal_oficina = mysqli_fetch_array($personal_oficina)['es_personal_oficina'];

    $query = "SELECT COUNT(rut_persona) as es_personal_requerido FROM edificio JOIN personal_requerido USING(id_edificio) WHERE id_edificio = '$id_edificio' AND rut_persona = '$rut_persona'";
    $personal_requerido = mysqli_query($conexion, $query);
    $es_personal_requerido = mysqli_fetch_array($personal_requerido)['es_personal_requerido'];

    $query = "SELECT (COUNT(oficina.rut_persona) + (SELECT COUNT(rut_persona) FROM personal_requerido WHERE id_edificio = '$id_edificio')) as personal_edificio FROM oficina JOIN edificio USING(id_edificio) WHERE id_edificio = '$id_edificio'";
    $personal_edificio = mysqli_query($conexion, $query);
    $personal_total = mysqli_fetch_array($personal_edificio)['personal_edificio'];

    $query = "SELECT COUNT(permanecer.rut_persona) as personal_requerido_actual FROM permanecer JOIN persona USING(rut_persona) JOIN personal_requerido USING(rut_persona) WHERE permanecer.id_edificio = '$id_edificio' AND fecha_salida IS NULL";
    $personal_requerido_actual = mysqli_query($conexion, $query);

    $query = "SELECT COUNT(permanecer.rut_persona) as personal_oficina_actual FROM permanecer JOIN edificio USING(id_edificio) JOIN oficina USING(rut_persona) WHERE oficina.id_edificio = '$id_edificio' AND oficina.rut_persona is NOT null AND fecha_salida IS NULL";
    $personal_oficina_actual = mysqli_query($conexion, $query);

    $personal_edificio_actual = mysqli_fetch_array($personal_requerido_actual)['personal_requerido_actual']+ mysqli_fetch_array($personal_oficina_actual)['personal_oficina_actual'];


    while ($row = mysqli_fetch_array($datosEdificio)){
        $aforo_permitido_temporales = $row['aforo_total']*($row['aforo_permitido']/100)-$personal_total;
    }

    $query = "SELECT COUNT(rut_persona) as aforo_actual FROM permanecer WHERE id_edificio = '$id_edificio' AND fecha_salida is NULL";
    $aforo = mysqli_query($conexion, $query);
    $aforo_actual = mysqli_fetch_array($aforo)['aforo_actual'];

    while ($row = mysqli_fetch_array($seEncuentra)){
        if($row['permanece'] == 0 && ($es_personal_oficina > 0 || $es_personal_requerido > 0) && $personal_edificio_actual < $personal_total){
            $insert = "INSERT INTO permanecer (rut_persona, id_edificio, fecha_entrada, fecha_salida) VALUES ('$rut_persona', '$id_edificio', '$fecha_actual', NULL)";

            $result = mysqli_query($conexion, $insert);

            $permitido = true;
        }else if($row['permanece'] > 0 && ($es_personal_oficina > 0 || $es_personal_requerido > 0) && $personal_edificio_actual <= $personal_total){
            $update = "UPDATE permanecer SET fecha_salida = '$fecha_actual' WHERE rut_persona = '$rut_persona' AND fecha_salida is NULL";

            $result = mysqli_query($conexion, $update);
            $permitido = true;
        }else if($row['permanece'] == 0 && ($es_personal_oficina == 0 && $es_personal_requerido == 0) && ($aforo_actual-$personal_edificio_actual) < $aforo_permitido_temporales){
            $insert = "INSERT INTO permanecer (rut_persona, id_edificio, fecha_entrada, fecha_salida) VALUES ('$rut_persona', '$id_edificio', '$fecha_actual', NULL)";

            $result = mysqli_query($conexion, $insert);

            $permitido = true;
        }else if($row['permanece'] > 0 && ($es_personal_oficina == 0 && $es_personal_requerido == 0) && ($aforo_actual-$personal_edificio_actual) <= $aforo_permitido_temporales){
            $update = "UPDATE permanecer SET fecha_salida = '$fecha_actual' WHERE rut_persona = '$rut_persona' AND fecha_salida is NULL";

            $result = mysqli_query($conexion, $update);
            $permitido = true;
        }else{
            $permitido = false;
        }
    }
    
    echo $permitido;
