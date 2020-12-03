<?php
    require("conexion.php");
    include("autorizacion.php");
    $rut= $_SESSION['rut_persona'];
    
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
        <?php echo "<input type='hidden' id='rut_persona' value='$rut'>"?>
        <div class="nav-brand"><img src="../Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links" id="nav-info"> 
            
        </ol>
    </nav>  
    <div class="contenedor">
        
        <div class="aforo-permitido">
            <?php
                $consulta = "SELECT ultima_conexion FROM cuenta WHERE cuenta.rut_persona=$rut";
                $resultado = mysqli_query($conexion,$consulta);
                while($row=mysqli_fetch_assoc($resultado)){
                    $info=$row['ultima_conexion'];
                    echo "ULTIMA CONEXIÓN:<br>".$info;
                }
            ?>
            <br>
            <h3>Aforo Permitido</h3>
            <form id="form-aforo">
                <input id="input-aforo" type="text" placeholder="Aforo Permitido">
                <br>
                <button type="submit" class="boton_ingresar">Modificar</button>
            </form>
        </div>
        <div class="tabla-datos">
            <table id="tabla-mantenedor" class="display responsive nowrap" style="width:100%" >
            <thead>
                <tr>
                    <th>Identificador</th>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Identificador</th>
                    <th>Nombre Edificio</th>
                    <th>Aforo Actual</th>
                    <th>Aforo Permitido</th>
                </tr>
            </tfoot>
            </table>
        </div>

        <div class="añadir-edificio" id="agregar">
        <h3>Añadir Edificio</h3>
        <form action="agregar.php" method="POST" >
            <input type="text" placeholder="Nombre Edificio" name="nombre_edificio">
            <br>
            <input type="text" placeholder="Aforo Edificio" name="aforo_total">
            <br>
            <input type="hidden" name="rut_persona" value='<?php echo $rut; ?>' >
            <button class="boton_ingresar" type="submit" onclick="return confirmarE()" >Agregar</button> 
            <button class="boton_cancelar" type="submit"  onclick="return cancelar()">Cancelar</button>
        </form>
        </div>
        
        <div class="añadir-edificio" id="editar">
        <h3>Editar Edificio</h3>
        <div id="edicion_datos">
        </div> 
        <form action="edicion.php" method="POST" >
            <input type="hidden" name="id_edificio" id="id_edificio" value="">
            <tfoot>
            <tr>
            <td><input type="text" placeholder="Nombre Edificio" name="nombre_edificio"></td>
            <td><input type="text" placeholder="Aforo Edificio" name="aforo_total"></td>
            </tr>
            </tfoot>
            <br>
            

            <button class="boton_ingresar" type="submit" onclick="return confirmarE()" >Agregar</button> 
            <button class="boton_cancelar" type="submit"  onclick="return cancelar()">Cancelar</button>
        </form>
        </div>
        
    </div>
    <script type="text/javascript" src="../js/funciones.js"></script>
</body>
</html>