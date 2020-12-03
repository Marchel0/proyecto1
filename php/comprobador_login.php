<?php
    require("conexion.php");
    session_start();
    if (isset($_POST['rut_persona'])){
      	$rut_persona = stripslashes($_REQUEST['rut_persona']);
      	$rut_persona = mysqli_real_escape_string($conexion,$rut_persona);
      	$clave = stripslashes($_REQUEST['clave']);
      	$clave = mysqli_real_escape_string($conexion,$clave);
        $query = "SELECT * FROM `cuenta` WHERE rut_persona='$rut_persona' and clave='$clave'";
        $result = mysqli_query($conexion,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($rows==1){
            $_SESSION['rut_persona'] = $rut_persona;
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