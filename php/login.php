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
<body>
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
            </div>
        <br>
        <br>
    </div>
    <script type="text/javascript" src="../js/funciones_login.js"></script>
</body>
</html>