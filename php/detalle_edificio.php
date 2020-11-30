<?php
    require("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
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
        <div class="nav-brand"><img src="../Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links">
        </ol>
    </nav>
    <div class="contenedor">
        <div class="aforor-actual">
            <h3>Aforo Actual</h3>
        </div>
        <div class="aforo-permitido">
            <h3>Aforo Permitido</h3>
        </div>
    </div>
    <script type="text/javascript" src="js/funciones1.js"></script>  
</body>
</html>