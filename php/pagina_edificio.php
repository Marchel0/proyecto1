<?php
require("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pagina_edificio.css">
    <title>Pagina Edificio</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="nav">
        <div class="nav-brand"><img src="../Imagenes/ucsc.png" alt=""></div>
        <ol class="nav-links">
        </ol>
    </nav>
    <div class="body-content">
        <div id="titulo">

        </div>
        <div class="marcador">
            <div id="actual">

            </div>
            <div id="permitido">

            </div>
        </div>
        <div class="marco-acceso">
            <video id="lector"></video>
            <div id="total-aforo">
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
            comprobador(rut);
        });
        Instascan.Camera.getCameras().then(cameras => {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
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
                    mostrarDatos();
                    document.getElementById('acceso-confirmacion').style.backgroundColor = 'green';
                    setTimeout(() => {
                        document.getElementById('acceso-confirmacion').style.backgroundColor = 'white';
                    }, 3000);
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
                    let template4 = '';

                    datos.forEach(datos => {
                        template +=
                            `<h1>${datos.nombre_edificio}</h1>`
                        template2 +=
                            `<h4>Aforo Personas Actual</h4>
                <h3>${datos.aforo_actual-datos.aforo_personal_actual}</h3>
                <h4>Aforo Personal Actual</h4>
                <h3>${datos.aforo_personal_actual}</h3>`
                        template3 +=
                            `<h4>Aforo Personas Permitido</h4>
                <h3>${datos.aforo_permitido-datos.personal_edificio}</h4>
                <h4>Aforo Personal Permitido</h4>
                <h3>${datos.personal_edificio}</h3>`

                        template4 +=
                            `<div class="marcador-datos"><h2>Aforo Actual</h2>
                <h1>${datos.aforo_actual}</h1></div>
                <div id="acceso-confirmacion">
                </div>
                <div class="marcador-datos"><h2>Aforo Permitido</h2>
                <h1>${datos.aforo_permitido}</h1></div>`
                    });

                    $('#titulo').html(template);
                    $('#actual').html(template2);
                    $('#permitido').html(template3);
                    $('#total-aforo').html(template4);
                }
            });
        }

        function comprobador(rut_persona) {
            $.ajax({
                url: "../php/datos_edificio.php",
                data: {
                    id_edificio
                },
                type: "POST",
                success: function(response) {
                    let datos = JSON.parse(response);

                    datos.forEach(datos => {
                        if (datos.aforo_actual < datos.aforo_permitido) {
                            registrarPersona(rut_persona);
                            mostrarDatos();
                        } else {
                            document.getElementById('acceso-confirmacion').style.backgroundColor = 'red';
                            setTimeout(() => {
                                document.getElementById('acceso-confirmacion').style.backgroundColor = 'white';
                            }, 3000);
                        }
                    });
                }
            });

        }
    </script>
</body>

</html>