
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

function grafico(nombre,aforo){
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    
    type: 'bar',

    data: {
        labels: nombre,
        datasets: [{
            barPercentage: 0.5,
            barThickness: 6,
            maxBarThickness: 8,
            minBarLength: 2,
            label: 'Aforo actual edificios',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: aforo
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
        url: "../proyecto1/php/lista-edificios.php",
        success: function(response){
            let datosEdificio = JSON.parse(response);
            var nombre = [];
            var aforo = [];
            datosEdificio.forEach(datosEdificio => {
                nombre.push(datosEdificio.nombre_edificio);
                aforo.push(datosEdificio.aforo_actual);
            });
            grafico(nombre,aforo);
        }
    });
}