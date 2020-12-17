<?php
    require("conexion.php");
    include("autorizacion_administrador.php");
    $rut= $_SESSION['rut_persona'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/ventana-emergente.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Mantenedor</title>
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
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
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbEsbwt6jDg-QFFy8ASTZS5fmjj2jzabk&callback=initMap&libraries=&v=weekly"
      defer
    ></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> 
</head>

<body id="prueba">
    <nav class="nav">
        <?php echo "<input type='hidden' id='rut_persona' value='$rut'>"?>
        <div class="nav-brand"><img src="../Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links" id="nav-info"> 
            
        </ol>
    </nav>  
    <div class="contenedor">
        
        
        <div class="tabla-datos">
            <div class="grafico"><canvas id="myChart"></canvas></div>
            <div class="aforo-permitido">
                <br>
                <h3>Aforo Permitido</h3>
                <form id="form-aforo">
                <input id="input-aforo" type="text" placeholder="Aforo Permitido">
                <br>
                <button type="submit" class="boton_ingresar">Modificar</button>
                </form>
            
            </div>
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
            
    <div class="footer">

        <div class="cuadrado">
            <div id="map"></div>
            <div class="tam-letras" style="margin:20px;">
                <p>Tamaño Texto</p>
                <br>
                <button type="submit" class="disminuye" onclick="return disminuir()"><span class="material-icons">remove</span></button>
                <button type="submit" class="aumenta" onclick="return aumentar()"><span class="material-icons">add</span></button>
            </div>
            <br>
            <div class="clima" style="margin:20px;">
                <a target="_blank" href="https://hotelmix.es/weather/concepcion-6746">
                <img src="https://w.bookcdn.com/weather/picture/31_6746_1_4_e74c3c_250_c0392b_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=582&anc_id=63677"  alt="booked.net"/></a><!-- weather widget end -->
                    
            </div>
            <div>
                <?php
                    $consulta = "SELECT ultima_conexion FROM cuenta WHERE cuenta.rut_persona=$rut";
                    $resultado = mysqli_query($conexion,$consulta);
                    while($row=mysqli_fetch_assoc($resultado)){
                        $info=$row['ultima_conexion'];
                        echo "ULTIMA CONEXIÓN:<br>".$info;
                    }
                ?>
            </div>
    </div>
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
    <script src="../js/notificacion.js"></script>
    
</body>
</html>