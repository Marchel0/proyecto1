<?php
    require("conexion.php");
    session_start();
    if(isset($_SESSION["rut_persona"])){
        $rut= $_SESSION['rut_persona'];
    }
    
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
    <link rel="stylesheet" href="../css/footer.css">
    <title>index</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbEsbwt6jDg-QFFy8ASTZS5fmjj2jzabk&callback=initMap&libraries=&v=weekly"
      defer
    ></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> 
    <script type="text/javascript" src="../js/funciones-pagina-mapa.js"></script>
</head>
<body id="prueba">
    <nav class="nav">
        <?php  
            if(isset($_SESSION["rut_persona"])){
                echo "<input type='hidden' id='rut_persona' value='$rut'>";
            }?>
        <div class="nav-brand">
            <ul class="nav-menu-ul">
                <li class="nav-menu-li"><img src="../Imagenes/ucsc.png" alt=""></li>
                <li class="nav-menu-li"><a href="../index.php" class="boton-menu">Home</a></li>
                <li class="nav-menu-li"><a href="contacto.php" class="boton-menu">Contacto</a></li>
                <li class="nav-menu-li"><a href="noticias.php" class="boton-menu">Noticias</a></li>
                <li class="nav-menu-li"><a href="mapa.php" class="boton-menu">Mapa</a></li>
            </ul>
        </div>
        <ol class="nav-links" id="nav-info">    
            
        </ol>
    </nav>
    <div class="contenedor">
        <div id="map" class="mapa"></div>
        <div class="opciones-mapa">
            <ul class="opciones-mapa-ul">
            </ul>
        </div>
    </div>
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
</body>
</html>