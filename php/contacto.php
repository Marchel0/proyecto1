<?php
    require("conexion.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/ventana-emergente.css">
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
    
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
</head>

<body>
    <nav class="nav">
        <div class="nav-brand"><img src="../Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links" id="nav-info">    
        </ol>
    </nav>  
    <div class="contenedor">
        <div class="perfil">
            <br>
            <br>
            <h1>Contacto:</h1>
            <form action="enviocontacto.php" method="POST">
                    <p>Nombre:</p>
                    <input type="text" name = "nombre"  style="width : 70%; height: 20px">
                    <br>
                    <p>Mail:</p>
                    <input type="text" name = "email"  style="width : 70%; height: 20px">
                    <br>
                    <p>Asunto:</p>
                    <input type="text" name = "mensaje"  style="width : 100%; height: 100px">
                    <br>
                    <br>
                    <button class="boton_ingresar" type="submit">Guardar</button> 
            </form>
            <br>
            <form action="mantenedor.php">
                <button class="boton_cancelar" type="submit">Regresar</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/funciones.js"></script>
</body>
</html>