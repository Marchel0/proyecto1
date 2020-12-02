<?php
    require("conexion.php");
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['rut_persona'])){
    $rut_persona = stripslashes($_REQUEST['rut_persona']);
    $rut_persona = mysqli_real_escape_string($conexion,$rut_persona);
    $nombre_persona = stripslashes($_REQUEST['nombre_persona']);
    $nombre_persona = mysqli_real_escape_string($conexion,$nombre_persona); 
    $clave = stripslashes($_REQUEST['clave']);
    $clave = mysqli_real_escape_string($conexion,$clave);
    $correo = stripslashes($_REQUEST['correo']);
    $correo = mysqli_real_escape_string($conexion,$correo);
    $telefono = stripslashes($_REQUEST['telefono']);
    $telefono = mysqli_real_escape_string($conexion,$telefono);
    $direccion = stripslashes($_REQUEST['direccion']);
    $direccion = mysqli_real_escape_string($conexion,$direccion);
    $fecha_nacimiento = stripslashes($_REQUEST['fecha_nacimiento']);
    $fecha_nacimiento = mysqli_real_escape_string($conexion,$fecha_nacimiento);
    $tipo_cuenta = "invitado";
    $codigo_qr = "3";
    $query = "INSERT INTO persona (rut_persona, nombre_persona) VALUES ('$rut_persona','$nombre_persona')";
    $result = mysqli_query($conexion,$query);
    $query = "INSERT INTO cuenta (rut_persona, clave, correo,telefono, direccion, fecha_nacimiento, tipo_cuenta, codigo_qr) VALUES ('$rut_persona', '".md5($clave)."', '$correo', '$telefono', '$direccion', '$fecha_nacimiento', '$tipo_cuenta', '$codigo_qr')";
    $result = mysqli_query($conexion,$query);
    if($result){
        echo "onlaegeag";
    }   
    }
?>