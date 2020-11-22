<?php
    require("conexion.php");
    $rut = $_POST["rut"];
    $clave = $_POST["clave"];
    $existe = "SELECT id_cuenta,tipo_cuenta FROM cuenta WHERE rut = '$rut' AND clave = '$clave'";
    $result = mysqli_query($conexion,$existe);
    while($row = mysqli_fetch_assoc($result)){
        $id_cuenta = $row['id_cuenta'];
        $tipo_cuenta = $row['tipo_cuenta'];
    }

    if($tipo_cuenta == mantenedor){
        header("Location: mantenedor.php?id_cuenta=$id_cuenta");
    }else{
        header("Location: index.php");
    }
    ?>