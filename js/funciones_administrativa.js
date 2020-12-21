$(document).ready( function () {

    setInterval(() => {
       tablaAdministrativa.ajax.reload();
    }, 1000);

    var tablaAdministrativa = $('#tabla-administrativa').DataTable({
        select: {
            style: 'single'
        },
        ajax: {
            url: "../php/lista-edificios.php",
            dataSrc: "",
          },
          columns: [
            { data: "id_edificio" },
            { data: "nombre_edificio" },
            { data: "aforo_actual" },
            { data: "aforo_total" },
          ],
          "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            }
        ],
        rowId: 'id_edificio',
        deferRender: true,
          dom: 'Bfrtip',
          buttons: [
            {
                text: 'Reporte',
                action: function(e,dt,node,config){
                    reporteEdificio()
                }
            }
          ],
          dom: 'Blfrtip',
          lengthMenu: [
              [10, 25, 50, -1],
              ['10 Filas', '25 Filas', '50 Filas', 'Mostrar todo']
          ],
    });
    
    $('#tabla-administrativa tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

    function reporteEdificio(id_edificio){
        window.location.href = `../fpdf/pruebaPDF.php?rut_persona=${rut_persona}&id_edificio=${id_edificio}`
    }

informacionUsuario();
function informacionUsuario(){
    let rut_persona = $('#rut_persona').val();
    $.ajax({
        url: "../php/informacion_cuenta.php",
        data: { rut_persona },
        type: "POST",
        success: function(response){
            let datosCuenta = JSON.parse(response);
            let template2 = '';

            datosCuenta.forEach(datosCuenta => {
                template2 += 
                `<li><a href = 'perfil.php'>${datosCuenta.nombre}/${datosCuenta.tipo_cuenta}</a></li><br>
                <button type="submit" class="boton_ingresar" onclick="window.location.href='logout.php'">Cerrar sesion</button>`
            });

            $('#nav-info').html(template2);
            
        }
    });
}

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

let map;
let aux1 = -36.79810;
let aux2 = -73.05573;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: aux1, lng: aux2 },
    zoom: 17,
  });
}
function grafico(nombre,aforo,aforo_total){
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
      
      type: 'bar',
  
      data: {
          labels: nombre,
          datasets: [{
              barPercentage: 0.5,
              barThickness: 50,
              maxBarThickness: 20,
              minBarLength: 1,
              label: 'Aforo actual edificio',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: '#000',
              borderWidth: '100px',
              data: aforo
              
  
          },{
            barPercentage: 0.5,
            barThickness: 50,
            maxBarThickness: 20,
            minBarLength: 1,
            label: 'Aforo total edificio',
            backgroundColor: 'rgb(235,59, 20)',
            borderColor: '#000',
            borderWidth: '100px',
            data: aforo_total
  
          }]
      },
      // Configuration options go here
      options: {
        animation: {
          duration: 0 // general animation time
        },
        hover: {
          animationDuration: 0 // duration of animations when hovering an item
        }
      }
  });
  }
  setInterval(() => {
    informacionEdificio()
  }, 1000);
  
  informacionEdificio();
  function informacionEdificio(){
      $.ajax({
          url: "../php/lista-edificios.php",
          success: function(response){
              let datosEdificio = JSON.parse(response);
              var nombre = [];
              var aforo = [];
              var aforo_total = [];
              datosEdificio.forEach(datosEdificio => {
                  nombre.push(datosEdificio.nombre_edificio);
                  aforo.push(datosEdificio.aforo_actual);
                  aforo_total.push(datosEdificio.aforo_total);
              });
              grafico(nombre,aforo,aforo_total);
          }
      });
  }