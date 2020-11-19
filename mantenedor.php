<?php
    require("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
    <nav class="nav">
        <div class="nav-brand"><img src="Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links">    
            <form action="comprobador.php" method="POST">
            </form>
        </ol>
    </nav>  
    <div class="contenedor">
        <div class="tabla-datos">
            <table id="example" class="display" >
            <thead>
                <tr>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="lista-datos">
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                    <th>Opciones</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <div>
        <h3>Añadir Edificio</h3>
        <form action="agregar.php" method="POST">
            <input type="text" placeholder="Nombre Edificio" name="nombre_edificio">
            <input type="text" placeholder="Aforo Edificio" name="aforo_total">
            <button type="submit">Agregar</button>
        </form>
        </div>
        
    </div>
    <script type="text/javascript" src="funciones.js"></script>
</body>
</html>