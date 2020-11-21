<?php
    require("conexion.php");
    $id=$_POST['id_edificio'];
    $id_cuenta=$_POST['id_cuenta'];
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
        <div class="editor">     
            <table style="width: 20%" >
                <thead>
                    <tr>
                        <th>Nombre Edificio</th>
                        <th>Aforo</th>
                    </tr>
                </thead>
                        <th>
                        <hr style="width : 200px; margin-left:10px">
                        </th>
                        <th>
                        <hr style="width : 200px; margin-left:10px">
                        </th>
                <tbody>
                    <?php
                        $consulta = "SELECT nombre_edificio, aforo_total FROM edificio WHERE id_edificio=$id ";
                        $resultado = mysqli_query($conexion,$consulta);
                        while($row=mysqli_fetch_assoc($resultado)){
                        $nombre=$row['nombre_edificio'];
                        $aforo=$row['aforo_total'];
                            echo "<tr>";
                            echo "<td>".$nombre."</td>";
                            echo "<td>".$aforo. "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tr>
                <form action='edicion.php'   method='POST'>
                    <?php  
                        echo "<input type='hidden' name='id_edificio' value=$id>" ;
                        echo "<input type='hidden' name='id_cuenta' value=$id_cuenta>"; 
                    ?>
                    <td><input type="text" name="nombre_edificio" placeholder = "Nombre Edificio"></td>
                    <td><input type="text" name="aforo_total" placeholder = "Aforo"></td>
                    <td><button class="boton_ingresar" type="submit" onclick="return editarE()">Guardar</button><td>
                </form>
                </tr>
            </table>
        </div>
    </div>
</html>