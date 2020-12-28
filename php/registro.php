<?php
    require("conexion.php");
    session_start();
    if(isset($_SESSION["rut_persona"])){
        header('location: login.php');
     }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <title>Registro</title>
</head>
<body id="prueba">
    <div class="body-login">
        <div class="contenedor-login">
            <div class="isesion">
                <h1>Registrate Aquí</h1>
                </div>
                <div class="campos"> 
                    <form class="ingresa" action="comprobador_registro.php" method="POST" name="registro">
                    <input type="text" placeholder= "Rut" name = "rut_persona"  style="width : 71%; height: 30px" required/>
                    <br>
                    <br>
                    <input type="text" placeholder= "Nombre y apellido" name = "nombre_persona"  style="width : 71%; height: 30px" required/>
                    <br>
                    <br>
                    <input type="password" placeholder= "Contraseña" name = "clave" style="width : 71%; height : 30px" required />    
                    <br>
                    <br>
                    <input type="email" placeholder= "Correo" name = "correo" style="width : 71%; height : 30px" required />    
                    <br>
                    <br>
                    <input type="text" placeholder= "Telefono" name = "telefono" style="width : 71%; height : 30px" required />    
                    <br>
                    <br>
                    <input type="text" placeholder= "direccion" name = "direccion" style="width : 71%; height : 30px" required />    
                    <br>
                    <br>
                    <p>Fecha Nacimiento:</p>
                    <input type="date" name = "fecha_nacimiento" style="width : 71%; height : 30px" required />    
                    <br>
                    <br>
                    <br>
                    <button type = "submit" style="width : 73%; height: 45px; color:white; margin-top:15px; margin-bottom:30px; font-size:18px; background-color:red">Registrarse</button>
                    <br>
                    <hr>
                    <br>
                    <a href="../index.php">Atras</a>
                </form>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="js/funciones.js"></script>  
</body>
</html>