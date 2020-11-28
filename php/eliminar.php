<?php
    require("conexion.php");

   $id_edificio = $_POST["id_edificio"];
   $id_cuenta=$_POST['id_cuenta'];
   
    $delete = "DELETE  FROM  edificio WHERE id_edificio='$id_edificio'";
    $result = mysqli_query($conexion,$delete);
    
    header("Location: mantenedor.php?id_cuenta=$id_cuenta");

?>