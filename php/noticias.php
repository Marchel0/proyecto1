<?php
    require("conexion.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/ventana-emergente.css">
    <link rel="stylesheet" href="../css/noticias.css">
    <title>Mantenedor</title>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
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
        <div class="noticias">
            <br>
            <h1>Noticias</h1>
            <br>
                <?php
                include("simple_html_dom.php");
            
                $html = file_get_html("https://www.minsal.cl/");
            
                foreach($html->find("div.tarjeta") as $noticia)
                {
                    echo "<p>";
                        echo "<a href='".$noticia->find("a",1)->href."'>".$noticia->find("a",1)->innertext."</a>";
                        echo "<a href='".$noticia->find("a",1)->href."'>".$noticia->find("a",1)->innertext."</a>";
                        echo "<br>";
                        echo "<hr>";
                        echo "<br>";
                    echo "</p>";
                }
                ?>
            <a href='https://www.minsal.cl/'>Fuente Minsal</a>
            <br>
            <form action="mantenedor.php">
                <button class="boton_cancelar" type="submit">Regresar</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/funciones.js"></script>
</body>
</html>