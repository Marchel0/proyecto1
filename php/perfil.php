<?php
    require("conexion.php");
    include("autorizacion.php");
    $rut= $_SESSION['rut_persona'];
    
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
            <h2>Datos Personales:</h2> 
            <br>
            <table cellspacing="10" cellpadding="10" border="2">
                <?php
                            $consulta = "SELECT * FROM cuenta, persona WHERE persona.rut_persona=cuenta.rut_persona and cuenta.rut_persona=$rut";
                            $resultado = mysqli_query($conexion,$consulta);
                            while($row=mysqli_fetch_assoc($resultado)){
                                $nombre=$row['nombre_persona'];
                                $rut=$row['rut_persona'];
                                $correo=$row['correo'];
                                $telefono=$row['telefono'];
                                $direccion=$row['direccion'];
                                $nacimiento=$row['fecha_nacimiento'];
                                echo "<tr>";
                                echo "<th>Nombre</th>";
                                echo "<td>".$nombre."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Rut</th>";
                                echo "<td>".$rut."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Correo</th>";
                                echo "<td>".$correo."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Fono</th>";
                                echo "<td>".$telefono."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Direccion</th>";
                                echo "<td>".$direccion."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Fecha de nacimiento</th>";
                                echo "<td>".$nacimiento."</td>";
                                echo "</tr>";
                            }
                ?>
            </table>
            <br>
            <form action="editar-perfil.php">
                <button class="boton_ingresar" type="submit">Editar</button> 
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