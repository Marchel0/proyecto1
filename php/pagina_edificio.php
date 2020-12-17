<?php
    require("conexion.php");
    if (!isset($_GET['id_edificio'])){
        header('location: login.php'); 
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pagina_edificio.css">
    <title>Pagina Edificio</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    

</head>

<body id="prueba">
    <nav class="nav">
        <div class="nav-brand"><img src="../Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links">
        </ol>
    </nav>
    <div class="body-content">
        <div id="titulo">

        </div>
        <div class="content-info">
            <div class="marcador" id="marcador">

            </div>
            <div class="marco-acceso">
                <video id="lector"></video>
                <div id="total-aforo">
            </div>
        </div>
        </div>
    </div>
    <script>
        let valores = window.location.search;
        let urlParams = new URLSearchParams(valores);
        const id_edificio = urlParams.get('id_edificio');

        mostrarDatos();

        let scanner = new Instascan.Scanner({
            video: document.getElementById('lector')
        });
        scanner.addListener('scan', function(rut) {
            registrarPersona(rut);
        });
        Instascan.Camera.getCameras().then(cameras => {
            if (cameras.length > 0) {
                scanner.start(cameras[2]);
            } else {
                console.error("No se encontraron dispositivos!");
            }
        });

        function registrarPersona(content) {
            let rut_persona = content;
            var dato = {
                "rut_persona": rut_persona,
                "id_edificio": id_edificio
            }
            $.ajax({
                url: "registrar_aforo.php",
                data: dato,
                type: "POST",
                success: function(response) {
                    if(response){
                        document.getElementById('acceso-confirmacion').style.backgroundColor = 'green';
                        setTimeout(() => {
                            document.getElementById('acceso-confirmacion').style.backgroundColor = 'white';
                            mostrarDatos();
                        }, 2000);
                    }else{
                        document.getElementById('acceso-confirmacion').style.backgroundColor = 'red';
                        setTimeout(() => {
                            document.getElementById('acceso-confirmacion').style.backgroundColor = 'white';
                        }, 2000);
                    }
                }
            })
        }

        function mostrarDatos() {
            $.ajax({
                url: "../php/datos_edificio.php",
                data: {
                    id_edificio
                },
                type: "POST",
                success: function(response) {
                    let datos = JSON.parse(response);
                    let template = '';
                    let template2 = '';
                    let template3 = '';

                    datos.forEach(datos => {
                        template +=
                            `<h1>${datos.nombre_edificio}</h1>`
                        template2 +=
                            `<h3>Aforo Personas</h4>
                <h2>${datos.aforo_actual-datos.aforo_personal_actual} / ${datos.aforo_permitido-datos.personal_edificio}</h2>
                
                <h3>Aforo Personal</h3>
                <h2>${datos.aforo_personal_actual} / ${datos.personal_edificio}</h2>
                <h3>Aforo Actual</h3>
                <h2>${datos.aforo_actual} / ${datos.aforo_permitido}</h2>`

                        template3 +=
                            ` <div id="acceso-confirmacion">
                            </div>`
                    });

                    $('#titulo').html(template);
                    $('#marcador').html(template2);
                    $('#total-aforo').html(template3);
                }
            });
        }
    </script>
</body>

</html>