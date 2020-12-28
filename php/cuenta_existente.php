<?php
    require("conexion.php");
    session_start();
    if(isset($_SESSION["rut_persona"])){
        header('location: login.php');
     }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <title>no_existe</title>
</head>
<body id="prueba">
    <div class="body-login">
        <div class="contenedor-login">
            <div class="isesion">
                <h3>Usuario ya existe</h3>
                <p>Haz click aquí para <a href='login.php'>Logearte</a></p>
            </div>
        </div>
    </div>
</body>
</html>