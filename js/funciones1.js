
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

let map;
let aux1 = -36.79810;
let aux2 = -73.05573;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: aux1, lng: aux2 },
    zoom: 17,
  });
}