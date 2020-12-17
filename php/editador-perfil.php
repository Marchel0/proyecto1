<?php
    require('conexion.php');
    session_start();
    if (isset($_POST['rut_persona'])){
        $rut= $_SESSION['rut_persona'];
        $nombre=$_POST['nombre'];
        $correo=$_POST['correo'];
        $telefono=$_POST['telefono'];
        $direccion=$_POST['direccion'];

        if($nombre!=null){
            $update =   "UPDATE persona
            SET nombre_persona='$nombre'
            WHERE rut_persona='$rut'";
            $result = mysqli_query($conexion, $update);
        }
        if($correo!=null){
            $update =   "UPDATE cuenta
            SET correo='$correo'
            WHERE rut_persona='$rut'";
            $result = mysqli_query($conexion, $update);
        }
        if($telefono!=null){
            $update =   "UPDATE cuenta
            SET telefono='$telefono'
            WHERE rut_persona='$rut'";
            $result = mysqli_query($conexion, $update);
        }
        if($direccion!=null){
            $update =   "UPDATE cuenta
            SET direccion='$direccion'
            WHERE rut_persona='$rut'";
            $result = mysqli_query($conexion, $update);
        }
        header("Location: perfil.php");
    }else{
        header("Location: login.php");
    }
?>