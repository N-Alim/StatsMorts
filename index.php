<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 10px;
    }
</style>

<?php


$filename = "./files/valeurs_mensuelles.csv";
$handle = fopen($filename, "rb");

fgets($handle);
fgets($handle);
fgets($handle);
fgets($handle);

$deaths = array();
$tab = "<table class='tab'>
<thead>
    <tr>
        <th>Date</th>
        <th>Nombre de morts</th>
    </tr>
</thead>

<tbody>";


while (!feof($handle))
{
    $values = explode(";", str_replace("\"", "",fgets($handle)));
    // $deaths += [ $values[0] => $values[1] ];
    $deaths[ $values[0] ] = $values[1];

    $date = DateTime::createFromFormat('Y-m', $values[0]);
    $tab .= "<td>" . $date->format('M Y') . "</td>";
    
    $tab .= "<td>" . $values[1] . "</td>";
    $tab .= "</tr>";
}

fclose($handle);

$tab .= "</tbody>
</table>";

echo $tab;