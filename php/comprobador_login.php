<?php
    require("conexion.php");
    session_start();
    if (isset($_POST['rut'])){
      	
      	$rut = stripslashes($_REQUEST['rut']); // removes backslashes
      	$rut = mysqli_real_escape_string($conexion,$rut); //escapes special characters in a string
      	$clave = stripslashes($_REQUEST['clave']);
      	$clave = mysqli_real_escape_string($conexion,$clave);
      	
      //Checking is user existing in the database or not
        $query = "SELECT * FROM `cuenta` WHERE rut_persona='$rut' and clave='$clave'";
          $result = mysqli_query($conexion,$query) or die(mysql_error());
          
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($rows==1){
            $_SESSION['rut'] = $rut;
            $tipo_cuenta = $row['tipo_cuenta'];

      		if($tipo_cuenta == administrador){
                header("Location: mantenedor.php");
            }else if ($tipo_cuenta == administrativa){
                header("Location: ../index.php");
            }else{
                header("Location: ../index.php");
            }
        }else{
            header("Location: no_existe.php");
      	}
        }
?>