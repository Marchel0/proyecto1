<?php
    require("conexion.php");
    session_start();
    if(isset($_SESSION["rut_persona"])){
        $rut= $_SESSION['rut_persona'];
        $query = "SELECT tipo_cuenta FROM `cuenta` WHERE rut_persona='$rut'";
        $result = mysqli_query($conexion,$query) or die(mysql_error());
        $tipo_cuenta = mysqli_fetch_assoc($result);
        if($tipo_cuenta == administrador){
            header("Location: mantenedor.php");
        }else if ($tipo_cuenta == administrativa){
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
    <title>Login</title>
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
            </div>

        </div>
    </div>
</body>
</html>