<?php
    require("conexion.php");
    session_start();
    if(!isset($_SESSION["rut_persona"])){
        header("Location: login.php");
    }
    $rut= $_SESSION['rut_persona'];
    
?>
<?php
$cache_file = 'data.json';
if(file_exists($cache_file)){
  $data = json_decode(file_get_contents($cache_file));
}else{
  $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
  $data = file_get_contents($api_url);
  file_put_contents($cache_file, $data);
  $data = json_decode($data);
}

$current = $data->results->current[0];
$forecast = $data->results->seven_day_forecast;

?>


<?php
  function convert2cen($value,$unit){
    if($unit=='C'){
      return $value;
    }else if($unit=='F'){
      $cen = ($value - 32) / 1.8;
      	return round($cen,2);
      }
  }
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

<body id="prueba">
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
            <div class="clima" style="margin:10px;">
            <p class="weather-icon">
            <h3 class="title text-center bordered"><?php echo $current->city.' ('.$current->country.')';?></h3>
            <br>
              <p class="aqi-value"><?php echo convert2cen($current->temp,$current->temp_unit);?> °C</p>
              <img  src="<?php echo $current->image;?>">
              <br>
            </p>
            <br>
            <div class="weather-icon">
              <p><strong>Velocidad del Viento : </strong>
              <br>
              <?php echo $current->windspeed;?> <?php echo $current->windspeed_unit;?></p>
            </div>
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
        <?php
                if(isset($_SESSION["rut_persona"])){
                  $consulta = "SELECT ultima_conexion FROM cuenta WHERE cuenta.rut_persona=$rut";
                    $resultado = mysqli_query($conexion,$consulta);
                    while($row=mysqli_fetch_assoc($resultado)){
                        $info=$row['ultima_conexion'];
                        echo "ULTIMA CONEXIÓN:<br>".$info;
                    }
                }
                    
        ?>
    </div>
    <script type="text/javascript" src="../js/funciones_perfil.js"></script>
</body>
</html>