$(document).ready( function () {
    let valores = window.location.search;
    let urlParams = new URLSearchParams(valores);
    let rut_persona = urlParams.get('rut_persona');
    
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
              [1, 2, 3, -1],
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

    $.ajax({
        url: "../php/informacion_cuenta.php",
        data: { rut_persona },
        type: "POST",
        success: function(response){
            let datosCuenta = JSON.parse(response);
            let template2 = '';

            datosCuenta.forEach(datosCuenta => {
                template2 += 
                `<li>${datosCuenta.nombre}/${datosCuenta.tipo_cuenta}</li>`
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



