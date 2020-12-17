<?php
    require("conexion.php");
    if (isset($_POST['id_edificio'])){
        $id_edificio = $_POST["id_edificio"];
        $delete = "DELETE FROM edificio WHERE id_edificio='$id_edificio'";
        $result = mysqli_query($conexion,$delete);
    }else{
        header("Location: login.php");
    }
?>