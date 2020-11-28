<?php
    require("conexion.php");
    $id_cuenta=$_GET['id_cuenta'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>Mantenedor</title>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
</head>

<body>
    <nav class="nav">
        <div class="nav-brand"><img src="Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links" id="nav-info">    
        </ol>
    </nav>  
    <div class="contenedor">
        <div class="aforo-permitido">
            <h3>Aforo Permitido</h3>
            <form id="form-aforo">
                <input id="input-aforo" type="text" placeholder="Aforo Permitido">
                <br>
                <button type="submit" class="boton_ingresar">Modificar</button>
            </form>
        </div>
        <div class="tabla-datos">
            <table id="tabla-mantenedor" class="display" >
            <thead>
                <tr>
                    <th>Identificador</th>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Identificador</th>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <div class="añadir-edificio">
        <h3>Añadir Edificio</h3>
        <form action="agregar.php" method="POST">
            <input type="text" placeholder="Nombre Edificio" name="nombre_edificio">
            <br>
            <input type="text" placeholder="Aforo Edificio" name="aforo_total">
            <br>
            <input type="hidden" name="id_cuenta" value='<?php echo $id_cuenta; ?>' >
            <button class="boton_ingresar" type="submit" onclick="return confirmarE()" >Agregar</button> 
        </form>
        </div>
        
    </div>
    <script type="text/javascript" src="funciones.js"></script>
</body>
</html>