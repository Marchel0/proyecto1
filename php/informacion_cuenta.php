<?php

    require("conexion.php");
    session_start();
    if (isset($_SESSION["rut_persona"])){
        $rut_persona = $_SESSION["rut_persona"];

        $query = "SELECT nombre_persona, tipo_cuenta, ultima_conexion FROM persona JOIN cuenta USING(rut_persona) WHERE rut_persona='$rut_persona'";

        $result = mysqli_query($conexion, $query);

        $json = array();
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
            'nombre' => $row['nombre_persona'],
            'tipo_cuenta' => $row['tipo_cuenta'],
            'ultima_conexion' => $row['ultima_conexion']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }else{
        header('location: ../index.php');
    }
?>