<?php
    require("conexion.php");
    session_start();
    if(!isset($_SESSION["rut_persona"])){
        header("Location: login.php");
    }
    $rut= $_SESSION['rut_persona'];
    
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/ventana-emergente.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Perfil</title>
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
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbEsbwt6jDg-QFFy8ASTZS5fmjj2jzabk&callback=initMap&libraries=&v=weekly"
      defer
    ></script>  
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
    <br>
    <br>    
    <div class="footer">
        <br>    
        <br>
        <div class="cuadrado">
            <div class="campus">
                <img class="ucscbottom"src="../Imagenes/ucsc.png" alt="">
                <br>
                <p>CAMPUS SAN ANDRÉS<br><br>
                Alonso de Ribera 2850, Concepción, Chile<br>
                Teléfono: +56 41 234 50 00<br>
                Fax: +56 41 234 50 01<br><br>
                (cc) 2020 UCSC algunos derechos reservados<br></p>
            </div>
            <div id="map" style="padding-left:20px;"    ></div>
            <br>
            <div class="clima" style="margin:20px;">
                <a target="_blank" href="https://hotelmix.es/weather/concepcion-6746">
                <img src="https://w.bookcdn.com/weather/picture/31_6746_1_4_e74c3c_250_c0392b_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=582&anc_id=63677"  alt="booked.net"/></a><!-- weather widget end -->
            </div>
            <div class="tam-letras" style="margin:20px;">
                <p>Tamaño Texto</p>
                <br>
                <button type="submit" class="disminuye" onclick="return disminuir()"><span class="material-icons">remove</span></button>
                <button type="submit" class="aumenta" onclick="return aumentar()"><span class="material-icons">add</span></button>
                <br>
                <br>
                <?php
                    $consulta = "SELECT ultima_conexion FROM cuenta WHERE cuenta.rut_persona=$rut";
                    $resultado = mysqli_query($conexion,$consulta);
                    while($row=mysqli_fetch_assoc($resultado)){
                        $info=$row['ultima_conexion'];
                        echo "ULTIMA CONEXIÓN:<br>".$info;
                    }
                ?>
            </div>
        <br>
        <br>
    </div>
    <script type="text/javascript" src="../js/funciones_perfil.js"></script>
</body>
</html>