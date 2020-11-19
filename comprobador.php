<?php
    require("conexion.php");
    $rut = $_POST["rut"];
    $clave = $_POST["clave"];
    $existe = "SELECT id_cuenta FROM cuenta WHERE rut = '$rut' AND clave = '$clave'";
    $result = mysqli_query($conexion,$existe);
    while($row = mysqli_fetch_assoc($result)){
        $response = $row['id_cuenta'];
    }

    if(!empty($response)){
        header("Location: ingresado.php?id_cuenta=$response");
    }else{
        header("Location: noexiste.php");
    }

    ?>