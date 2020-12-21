let edificiosNotificados = [];
let rut_persona = $("#rut_persona").val();

function lanzar_notificacion(title, body, icon) {
    if (!("Notification" in window)) {
        alert("Tu navegador no soporta notificaciones")
    } else if (Notification.permission === "granted") {
        var notificacion = new Notification(title, {
            body,
            icon
        });
        setTimeout(() => {
            notificacion.close();
        }, 35 * 1000);
    } else if (Notification.permission !== "denied") {
        Notification.requestPermission(function (permission) {
            if (Notification.permission === "granted") {
                var notificacion = new Notification(title, {
                    body,
                    icon
                });
                setTimeout(() => {
                    notificacion.close();
                }, 35 * 1000);
            }
        });
    }
}

function notificacion_aforo() {
    $.ajax({
        url: "../php/lista-edificios.php",
        success: function (response) {
            let datos = JSON.parse(response);

            datos.forEach(datos => {
                if (datos.aforo_actual == datos.aforo_total && !edificiosNotificados.includes(datos.id_edificio)) {
                    let title = `Aforo Maximo Alcanzado`;
                    let body = `El edificio ${datos.nombre_edificio} se encuentra en su maximo aforo permitido con ${datos.aforo_total} personas`;
                    let icon = "../Imagenes/ucsc.png";
                    lanzar_notificacion(title, body, icon);
                    edificiosNotificados.push(datos.id_edificio);
                }
                if(datos.aforo_actual < datos.aforo_total && edificiosNotificados.includes(datos.id_edificio)){
                    removeFromArray(edificiosNotificados, datos.id_edificio);
                }
            })
        }

    })
}

function notificar_edificio(){

    $.ajax({
        url: "../php/comprobar_modificacion.php",
        data: {rut_persona},
        type: "POST",
        success: function (response){
            let datos = JSON.parse(response);
            datos.forEach(datos => {
                    if(datos.ingreso){
                        let title = `Se Ingreso Un Edificio`;
                        let body = `El edificio ${datos.nombre_edificio} fue ingresado el dia ${datos.fecha_ingreso}`;
                        let icon = "../Imagenes/ucsc.png";
                        lanzar_notificacion(title, body, icon)
                    }
    
                    if(datos.modificado){
                        let title = `Se Modifico Un Edificio`;
                        let body = `El edificio ${datos.nombre_edificio} fue modificado el dia ${datos.fecha_modificacion}`;
                        let icon = "../Imagenes/ucsc.png";
                        lanzar_notificacion(title, body, icon)
                    }
            })
        }
    })
}

function removeFromArray ( arr, item ) {
    var i = arr.indexOf( item );
 
    if ( i !== -1 ) {
        arr.splice( i, 1 );
    }
}


function validar_cuenta(){
    $.ajax({
        url: "../php/informacion_cuenta.php",
        data: { rut_persona },
        type: "POST",
        success: function(response){
            let datos = JSON.parse(response);

            datos.forEach(datos => {
                if(datos.tipo_cuenta == "administrador"){
                    notificar_edificio();
                }
            })
        } 

    })
}

validar_cuenta();

setInterval(() => {
    notificacion_aforo();
}, 1000);
let tamaño=100;
function aumentar(){
    if(tamaño<=130){
        tamaño += 10;
        document.getElementById('prueba').style.fontSize = tamaño +"%";
    }
    if(tamaño ==140){
        alert("Tamaño maximo alcanzado");
    }
    
}
function disminuir(){
    if(tamaño>=100){
        tamaño -= 10;
        document.getElementById('prueba').style.fontSize = tamaño +"%";
    }
    if(tamaño ==100){
        alert("Tamaño minimo alcanzado");
    }
}
