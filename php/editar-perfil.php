<?php
    require("conexion.php");
    $rut=$_GET['rut_persona'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/ventana-emergente.css">
    <title>Mantenedor</title>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
</head>

<body>
    <nav class="nav">
        <div class="nav-brand"><img src="../Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links" id="nav-info">    
        </ol>
    </nav>  
    <div class="contenedor">
        <div class="perfil">
            <br>
            <br>
            <h2>Editar datos Personales:</h2> 
            <br>
            <form action="editador-perfil.php" method="POST">
                <table cellspacing="10" cellpadding="10" border="2">
                    <tr>
                        <th>Nombre</th>
                        <td><input type="text" placeholder= "Nombre" name = "nombre"  style="width : 71%; height: 20px"></td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td><input type="text" placeholder= "example@email.com" name = "correo"  style="width : 71%; height: 20px"></td>
                    </tr>
                    <tr>
                        <th>Fono</th>
                        <td><input type="text" placeholder= "11223344" name = "telefono"  style="width : 71%; height: 20px"></td>
                    </tr>
                    <tr>
                        <th>Direccion</th>
                        <td><input type="text" placeholder= "Direccion" name = "direccion"  style="width : 71%; height: 20px"></td>
                    </tr>
                </table>
            <br>
            <input type="hidden" name="rut_persona" value='<?php echo $rut; ?>' >
                <button class="boton_ingresar" type="submit" onclick="return editarP()" >Agregar</button> 
            </form>
            <br>
            <form action="perfil.php">
                <button class="boton_cancelar" type="submit"  onclick="return cancelar()">Cancelar</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/funciones.js"></script>
</body>
</html>