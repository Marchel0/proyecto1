<?php

    require("conexion.php");

    $aforo_permitido = $_POST['aforo_permitido'];
    
    if(!empty($aforo_permitido)){
        $query = "UPDATE edificio SET aforo_permitido = '$aforo_permitido'";
    }

    $result = mysqli_query($conexion, $query);
  
    if(!$result) {
        die('Query Error' . mysqli_error($conexion));
    }
?>