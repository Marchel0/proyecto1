<?php  

    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    $destinatario = "ncereceda@ing.ucsc.cl";
    $asunto = "Formualario de contacto de $nombre";

    $carta = "De: $nombre \n";
    $carta .= "Correo: $correo \n";
    $carta .= "Mensaje: $mensaje";

    mail($destinatario, $asunto, $carta);
    header('Location:index.php');

?>