<link rel="stylesheet" href="assets/css/chart.css">

<canvas id='myChart'></canvas>
<select range='years' id='years' onchange='changeYear()'>
    <option value='2010' selected> 2010 </option>
    <option value='2011'> 2011 </option>
    <option value='2012'> 2012 </option>
    <option value='2013'> 2013 </option>
    <option value='2014'> 2014 </option>
    <option value='2015'> 2015 </option>
    <option value='2016'> 2016 </option>
    <option value='2017'> 2017 </option>
    <option value='2018'> 2018 </option>
    <option value='2019'> 2019 </option>
    <option value='2020'> 2020 </option>
    <option value='2021'> 2021 </option>
</select>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<?php

$filename = "./files/valeurs_mensuelles.csv";
$handle = fopen($filename, "rb");

fgets($handle);
fgets($handle);
fgets($handle);
fgets($handle);

$deaths = array();

while (!feof($handle))
{
    $values = explode(";", str_replace("\"", "",fgets($handle)));
    // $deaths += [ $values[0] => $values[1] ];

    $date = DateTime::createFromFormat('Y-m', $values[0]);
    
    $deaths[intval($date->format('Y'))][$date->format('F')] = $values[1];
}

fclose($handle);

echo "
<script>
const values = " . json_encode($deaths) . "
</script>";

?>

<script src="assets/js/chart.js"></script>
