<?php

    require("conexion.php");
    if (isset($_POST['aforo_permitido'])){
        $aforo_permitido = $_POST['aforo_permitido'];
    
        if($aforo_permitido >=0 && $aforo_permitido <= 100){
            $query = "UPDATE edificio SET aforo_permitido = '$aforo_permitido'";
        }else{
            echo false;
        }

        $result = mysqli_query($conexion, $query);
  
        if(!$result) {
            die('Query Error' . mysqli_error($conexion));
        }
    }else{
        include('no_entrar.php');
    }
?>