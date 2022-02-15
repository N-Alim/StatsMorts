<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 10px;
    }

    canvas#myChart {
        width: 400px;
        height: 400px;
    }
</style>
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

echo "<canvas id='myChart'></canvas>
<select range='tears' id='years' onchange='changeYear()'>
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
<script>

function changeYear()
{
    const year = parseInt(document.querySelector('select#years').value);
    
    myChart.data.datasets[0].label = 'Number of deaths in ' + year;
    myChart.data.datasets[0].data = values[year];
    myChart.update();

}

const values = " . json_encode($deaths) . "


const ctx = document.getElementById('myChart').getContext('2d');
let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'Number of deaths in 2010',
            data:values[2010],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',

            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
console.log(myChart);
</script>";

// echo $tab;