<?php
    require("conexion.php");
    $nombre=$_POST['nombre_edificio'];
    $aforo=$_POST['aforo_total'];
    $id=$_POST['id_edificio'];
   
    $update =   "UPDATE edificio
                SET nombre_edificio='$nombre' , aforo_total='$aforo'
                WHERE id_edificio='$id'";
                
    $result = mysqli_query($conexion, $update);
    header("Location: mantenedor.php");

?>