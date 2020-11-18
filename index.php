<?php
    require("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
    <nav class="nav">
        <div class="nav-brand"><img src="Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links">    
            <form action="comprobador.php" method="POST">
                <li><input type="text" placeholder= "Usuario" class="cuenta"></li>
                <li><input type="password" placeholder= "Contraseña" class="cuenta"></li> 
                <li><button type="submit" class="boton_ingresar">Ingresar</button></li>
            </form>
        </ol>
    </nav>  
</body>
</html>