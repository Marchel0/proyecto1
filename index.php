<?php
    require("php/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <title>index</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
        
</head>
<body>
    <nav class="nav">
        <div class="nav-brand"><img src="Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links">    
            <form action="php/comprobador.php" method="POST"">
                <li><input type="text" placeholder= "Usuario" class="cuenta" name="rut" id = "rut"></li>
                <li><input type="password" placeholder= "Contraseña" class="cuenta" name="clave" id="clave"></li> 
                <li><button type="submit" class="boton_ingresar" onclick="validacion()">Ingresar</button></li>
            </form>
        </ol>
    </nav>
    <div class="contenedor">
        <div class="tabla-datos">
            <table id="tabla" class="display responsive nowrap" style="width:100%" >
            <thead>
                <tr>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </tfoot>
            </table>    
    </div>
    <script type="text/javascript" src="js/funciones1.js"></script>  
</body>
</html>