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
    if(tamaño>=110){
        tamaño -= 10;
        document.getElementById('prueba').style.fontSize = tamaño +"%";
    }
    if(tamaño ==100){
        alert("Tamaño minimo alcanzado");
    }
}