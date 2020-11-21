$(document).ready( function () {
    $('#example').DataTable({
        searching :false,
        ordering: false,
        info : false,
        paging : false
    });


    listarEdificios();
    function listarEdificios(){
        $.ajax({
            url: "lista-edificios.php",
            type: "GET",
            success: function (response) {
                let edificios = JSON.parse(response);
                let template = '';
    
                edificios.forEach(edificios => {
                    template += 
                    `<tr>
                        <td> 
                            ${edificios.nombre_edificio}
                        </td>
                        <td> 
                            ${edificios.aforo_actual}
                        </td>
                        <td> 
                            ${edificios.aforo_total}
                        </td>
                        <td class="tabla-opciones">
                        <form action='eliminar.php' method='POST'>
                            <input type="hidden"  name="id_edificio" value=${edificios.id_edificio}>
                            <button class="btn" onclick="return eliminarE()" value="ELIMINAR DATOS">
                                <span class="material-icons">
                                    delete
                                </span> 
                            </button>
                            </form>

                            <form action='editar.php' method='POST'>
                            <input type="hidden" name="id_edificio" value=${edificios.id_edificio}>
                            <button class="btn">
                                <span class="material-icons">
                                    edit
                                </span> 
                            </button>
                            </form>
                        </td>
                    </tr>
                    `
                });
    
                $('#lista-datos').html(template);
                
            }
        });
    } 

   
    

});

function confirmarE(){
    var respuesta = confirm('¿Está seguro que desea añadir este edificio?');

    if(respuesta == true){
        alert("Se añadio de manera exitosa!");
        return true;
    }else{
        alert("Operación cancelada");
        return false;
    }
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