<?php
    require("conexion.php");
    session_start();
    if(isset($_SESSION["rut_persona"])){
        $rut= $_SESSION['rut_persona'];
        $query = "SELECT tipo_cuenta FROM `cuenta` WHERE rut_persona='$rut'";
        $result = mysqli_query($conexion,$query);
        $tipo_cuenta = mysqli_fetch_assoc($result)['tipo_cuenta'];
        if($tipo_cuenta == "administrador"){
            header("Location: mantenedor.php");
        }else if ($tipo_cuenta == "administrativa"){
            header("Location: ../index.php");
        }else{
            header("Location: ../index.php");
        }
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
    <link rel="stylesheet" href="../css/ventana-emergente.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbEsbwt6jDg-QFFy8ASTZS5fmjj2jzabk&callback=initMap&libraries=&v=weekly"
      defer
    ></script>  
</head>
<body id="prueba">
    <div class="body-login">
        <div class="contenedor-login">
            <div class="isesion">
                <h1>Inicia sesión</h1>
                </div>
                <div class="campos"> 
                    <form class="ingresa" action="comprobador_login.php" method="POST" name="login">
                    <input type="text" placeholder= "123456789" name = "rut_persona"  style="width : 71%; height: 30px" required/>
                    <br>
                    <br>
                    <input type="password" placeholder= "Contraseña" name = "clave" style="width : 71%; height : 30px" required />    
                    <br>
                    <button type = "submit" style="width : 73%; height: 45px; color:white; margin-top:15px; margin-bottom:30px; font-size:18px; background-color:red">Entrar</button>
                </form>
                <p>No estas registrado aún? <a href='registro.php'>Registrate Aquí</a></p>
                <br>
                <hr>
                <br>
                <a href="../index.php">Atras</a>
            </div>

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
            </div>
        <br>
        <br>
    </div>
    <script type="text/javascript" src="../js/funciones_login.js"></script>
</body>
</html>