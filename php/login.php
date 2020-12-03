<?php
    require("conexion.php");
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