
<?php
    require("conexion.php");
    if (isset($_POST['rut_persona'])){
        $rut_persona = $_POST["rut_persona"];
    
        $query = "SELECT ultima_conexion FROM cuenta WHERE rut_persona = '$rut_persona'";
        $resultado_uc = mysqli_query($conexion, $query);
        $ultima_conexion = mysqli_fetch_array($resultado_uc)["ultima_conexion"];
    
        $query = "SELECT id_edificio, nombre_edificio, fecha_ingreso FROM edificio WHERE fecha_ingreso > '$ultima_conexion'";
        $fechas_ingreso = mysqli_query($conexion, $query);

        $query = "SELECT id_edificio, nombre_edificio, fecha_modificacion FROM edificio WHERE fecha_modificacion IS NOT NULL AND fecha_ingreso > '$ultima_conexion'";
        $fechas_modificacion = mysqli_query($conexion, $query);

        $json = array();

        while($row = mysqli_fetch_array($fechas_ingreso)){
            $json[] = array(
                'id_edificio' => $row["id_edificio"],
                'fecha_ingreso' => $row["fecha_ingreso"],
                'nombre_edificio' => $row["nombre_edificio"],
                'ingreso' => true
            );
        }

        while($row = mysqli_fetch_array($fechas_modificacion)){
            $json[] = array(
                'id_edificio' => $row["id_edificio"],
                'fecha_modificacion' => $row["fecha_modificacion"],
                'nombre_edificio' => $row["nombre_edificio"],
                'modificado' => true 
            );
        }
    

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }else{
        header("Location: login.php");
    }
?>
