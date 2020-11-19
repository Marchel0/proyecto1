$(document).ready( function () {
    $('#example').DataTable();
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
                        <td>
                            <button class="btn">
                                <span class="material-icons">
                                    delete
                                </span> 
                            </button>
                            <button class="btn">
                                <span class="material-icons">
                                    edit
                                </span>
                            </button>
                        </td>
                    </tr>
                    `
                });
    
                $('#lista-datos').html(template);
                
            }
        });
    } 
});