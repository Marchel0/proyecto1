<?php
    require("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>index</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="nav">
        <div class="nav-brand"><img src="Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links">    
            <form action="comprobador.php" method="POST"">
                <li><input type="text" placeholder= "Usuario" class="cuenta" name="rut" id = "rut"></li>
                <li><input type="password" placeholder= "Contraseña" class="cuenta" name="clave" id="clave"></li> 
                <li><button type="submit" class="boton_ingresar" onclick="validacion()">Ingresar</button></li>
            </form>
        </ol>
    </nav>
    <div class="contenedor">
        <div class="aforo-permitido">
            
        </div>
        <div class="grafico">

        </div>
        <div class="tabla-datos">
            <table id="example" class="display" >
            <thead>
                <tr>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </thead>
            <tbody id="lista-datos">
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </tfoot>
            </table>    
    </div>
    <script type="text/javascript" src="funciones.js"></script>  
</body>
</html>