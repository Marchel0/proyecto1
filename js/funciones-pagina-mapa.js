$(document).ready( function () {

    // informacionUsuario();
    // function informacionUsuario(){
    //     let rut_persona = $('#rut_persona').val();
    //     $.ajax({
    //         url: "../php/informacion_cuenta.php",
    //         data: { rut_persona },
    //         type: "POST",
    //         success: function(response){
    //             let datosCuenta = JSON.parse(response);
    //             let template2 = '';
    
    //             datosCuenta.forEach(datosCuenta => {
    //                 template2 += 
    //                 `<li><a href = 'perfil.php'>${datosCuenta.nombre}/${datosCuenta.tipo_cuenta}</a></li><br>
    //                 <button type="submit" class="boton_ingresar" onclick="window.location.href='logout.php'">Cerrar sesion</button>`
    //             });
    
    //             $('#nav-info').html(template2);
                
    //         }
    //     });
    //}    

});


function confirmarE(){
    var nombre = $("#campo_n").val()
    var aforo = $("#campo_a").val()

    if(nombre === null || nombre === '' || aforo === null || aforo === ''){
        
    }else{
        var respuesta = confirm('¿Está seguro que desea añadir este edificio?');
        console.log(aforo, nombre);
    if(respuesta == true){
        alert("Se añadio de manera exitosa!");
        return true;
    }else{
        alert("Operación cancelada");
        return false;
    }
    }
    
}
 function cancelar(){
    alert("Operación cancelada");
    Document.getElementById("agregar").style.display="none";
    return false;
 }
function eliminarE(){
    var respuesta = confirm('¿Está seguro que desea eliminar este edificio de los registros?');

    if(respuesta == true){
        alert("Registro del edificio eliminado con éxito");
        return true;
    }else{
        alert("Operación cancelada");
        return false;
    }
}
function editarE(){
    var respuesta = confirm('¿Está seguro que desea modificar este edificio?');

    if(respuesta == true){
        alert("Cambios guardados");
        return true;
    }else{
        alert("Operación cancelada");
        return false;
    }
}
function editarP(){
    var respuesta = confirm('¿Está seguro que desea modificar estos parámetros?');

    if(respuesta == true){
        alert("Cambios guardados");
        return true;
    }else{
        alert("Operación cancelada");
        return false;
    }
}

let tamaño=100;
function aumentar(){
    if(tamaño<=150){
        tamaño += 10;
        document.getElementById('prueba').style.fontSize = tamaño +"%";
    }
    if(tamaño >=150){
        alert("Tamaño maximo alcanzado");
    }
    
}
function disminuir(){
    if(tamaño>=100){
        tamaño -= 10;
        document.getElementById('prueba').style.fontSize = tamaño +"%";
    }
    if(tamaño <=100){
        alert("Tamaño minimo alcanzado");
    }
}

let map;
let aux1 = -36.79810;
let aux2 = -73.05573;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: aux1, lng: aux2 },
    zoom: 18,
  });
}

array_marcadores = [];

$(document).on('click','.nombre-edificios', function(){
        let aux = this.id;
        $.ajax({
            url: "../php/lista-edificios.php",
            success: function(response){
                let datosEdificio = JSON.parse(response);
                if(array_marcadores.length > 0){
                    array_marcadores[0].setMap(null); 
                    array_marcadores.pop();
                }
                datosEdificio.forEach(datosEdificio => {
                    if(datosEdificio.id_edificio === aux){
                        var marcador = new google.maps.Marker({
                            position: { lat: parseFloat(datosEdificio.latitud), lng: parseFloat(datosEdificio.longitud) },
                            map: map,});
                            array_marcadores.push(marcador);
                        }  
                });             
            }
        });
});

informacionMapaEdificio();
function informacionMapaEdificio(){
    $.ajax({
        url: "../php/lista-edificios.php",
        success: function(response){
            let datosEdificio = JSON.parse(response);
            let template2 = '';
            let aux =1;
            datosEdificio.forEach(datosEdificio => {
                template2 += 
                `<li class="nombre-edificios" id="${datosEdificio.id_edificio}">${aux}.- ${datosEdificio.nombre_edificio}</li>`;
                aux++;
            });

            $('.opciones-mapa-ul').html(template2);
            
        }
    });
}