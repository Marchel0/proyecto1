<?php
    require("conexion.php");
    $id=$_POST['id_edificio'];
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
                    <th>Aforo Total</th>
                </tr>
            </thead>
            <tbody id="lista-datos">
                    <?php
                        $consulta = "SELECT nombre_edificio, aforo_total FROM edificio WHERE id_edificio=$id ";
                        $resultado = mysqli_query($conexion,$consulta);
                        while($row=mysqli_fetch_assoc($resultado)){
                        $nombre=$row['nombre_edificio'];
                        $aforo=$row['aforo_total'];
                            echo"<thead>";
                            echo "<tr>".$nombre."</tr>";
                            echo "<tr>".$aforo. "</tr>";
                            echo"</thead>";
                        }
                    ?>
            </tbody>
            <tfoot>
                <tr>
                    <form action='edicion.php'   method='POST'>
                        <?php  
                            echo "<input type='hidden' name='id_edificio' value=$id>" 
                        
                        ?>
                        
                        <input type="text" name="nombre_edificio">
                        <input type="text" name="aforo_total">
                        <button type="submit">Confirmar</button>
                    </form>
                </tr>
            </tfoot>
            </table>
        </div>
        </div>
        
    </div>
</body>
</html>