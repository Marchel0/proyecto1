
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

function validacion(){
    var rut = document.getElementById('rut');
    var clave = document.getElementById('clave');
    if(rut.value === null || rut.value === '' || clave.value === null || clave.value === ''){
        alert("Datos no validos");
    } 

}