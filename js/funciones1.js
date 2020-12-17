
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
        url: "../proyecto1/php/lista-edificios.php",
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