<?php
$cache_file = 'data.json';
if(file_exists($cache_file)){
  $data = json_decode(file_get_contents($cache_file));
}else{
  $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
  $data = file_get_contents($api_url);
  file_put_contents($cache_file, $data);
  $data = json_decode($data);
}

$current = $data->results->current[0];
$forecast = $data->results->seven_day_forecast;

?>
<link rel="stylesheet" href="clima.css">


<?php
  function convert2cen($value,$unit){
    if($unit=='C'){
      return $value;
    }else if($unit=='F'){
      $cen = ($value - 32) / 1.8;
      	return round($cen,2);
      }
  }
?>
<p class="weather-icon">
              <img  src="<?php echo $current->image;?>">
              <?php if ($current->description = "Mostly clear"){
                 echo "Mayormente despejado";
               }
               else if ($current->description = "Mostly sunny and beautiful"||"Mostly sunny and nice" || "Delightful with plenty of sun"){
                  echo "Mayormente soleado";
               }
               else if ($current->description = "A stray shower in the morning" || "partial sunshine"){
               echo "Parcialmente soleado";
               }
               else if ($current->description = "Clear"){
                  echo "Despejado";
                  }
              
              ?>
            </p>
            <div class="weather-icon">
              <p><strong>Velocidad del Viento : </strong><?php echo $current->windspeed;?> <?php echo $current->windspeed_unit;?></p>
            </div>