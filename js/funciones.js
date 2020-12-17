$(document).ready( function () {

    setInterval(() => {
       tablaMantenedor.ajax.reload();
    }, 1000);

    var tablaMantenedor = $('#tabla-mantenedor').DataTable({
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
                  text: 'Editar',
                  action: function(e,dt,node,config){
                    document.getElementById('editar').style.display = 'block'; 
                    document.getElementById('id_edificio').value = tablaMantenedor.rows('.selected').data()[0].id_edificio;
                    var edificio = tablaMantenedor.rows('.selected').data()[0]
                    let datos = `<table cellspacing="10" style="padding-left: 25%"> 
                                <tr> 
                                <td> 
                                <tr> 
                                <th>Nombre Edificio</th> 
                                <th>Aforo</th> 
                                </tr> 
                                <tr> 
                                <td>${edificio.nombre_edificio}</td>  
                                <td>${edificio.aforo_total}</td> 
                                </tr> 
                                </tr> 
                                </table> `
                    $('#edicion_datos').html(datos);
                }
              },
              {
                text: 'Eliminar',
                action: function(e,dt,node,config){
                    if(eliminarE()){
                        eliminarEdificio(tablaMantenedor.rows('.selected').data()[0].id_edificio);
                        console.log(tablaMantenedor.rows('.selected').data()[0].id_edificio);
                    }
                }
            },
            {
                text: 'Agregar',
                action: function(e,dt,node,config){
                    document.getElementById('agregar').style.display = 'block'; 
                }
            },
            {
                text: 'Detalle',
                action: function(e,dt,node,config){
                    detalleEdificio(tablaMantenedor.rows('.selected').data()[0].id_edificio)
                }
            },
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
    
    $('#tabla-mantenedor tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

    function eliminarEdificio(id_edificio){
        $.ajax({
            url: "../php/eliminar.php",
            data : { id_edificio },
            type: "POST",
            success: function(response){
                tablaMantenedor.ajax.reload();
            }
        })
    }

    function detalleEdificio(id_edificio){
        window.location.href = `pagina_edificio.php?&id_edificio=${id_edificio}`
    }

    function reporteEdificio(id_edificio){
        window.location.href = `../fpdf/pruebaPDF.php?rut_persona=${rut_persona}&id_edificio=${id_edificio}`
    }

    var tabla = $("#tabla").DataTable({
        ajax: {
          url: "php/lista-edificios.php",
          dataSrc: "",
        },
        columns: [
          { data: "nombre_edificio" },
          { data: "aforo_actual" },
          { data: "aforo_total" },
        ],
      });

    $('#form-aforo').submit(function(e) {
        e.preventDefault();
        var datos = {
            "aforo_permitido":$("#input-aforo").val(),
        }
        console.log(datos);
        $.ajax({
            url: "../php/actualizar_aforo.php",
            data: datos,
            type: "POST",
            success: function(response){
                if(response){
                    alert("El Valor debe ser entre 0 y 100");
                }else{
                    tablaMantenedor.ajax.reload();
                    $('#form-aforo').trigger('reset');
                }
            }
        })
    });

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