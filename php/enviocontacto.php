<?php  
    session_start();
    if (isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
        $correo = $_POST['email'];
        $mensaje = $_POST['mensaje'];

        $destinatario = "ncereceda@ing.ucsc.cl";
        $asunto = "Formualario de contacto de $nombre";

        $carta = "De: $nombre \n";
        $carta .= "Correo: $correo \n";
        $carta .= "Mensaje: $mensaje";

        mail($destinatario, $asunto, $carta);

        if(!isset($_SESSION["rut_persona"])){
            header('location: ../index.php');
        }else{
            header('location: login.php'); 
        }
    }else{
        header('location: login.php'); 
    }
?>