<?php

// Declarar array associatiu
$productes = [
    "Llibre" => 12.5,
    "Motxilla" => 35,
    "Bolígraf" => 1.2,
    "Carpeta" => 4.8
];

// Declarar un altre array associatiu
$quantitats = [
    "Llibre" => 2,
    "Motxilla" => 1,
    "Bolígraf" => 5,
    "Carpeta" => 3
];

// Crear una funció
function array_detallat($productes, $quantitats)
{
    $array = [];
    foreach ($productes as $nom => $preu) {
        $array[$nom] = $nom;
        $array[$preu] = $preu;
        $array[$quantitats[$nom]] = $quantitats[$nom];
        $array[$preu * $quantitats[$nom]] = $preu * $quantitats[$nom];
    }
    return $array;
}

// Crear un altra funció
function calc_total($productes, $quantitats)
{
    $total = 0;
    foreach ($productes as $nom => $preu) {
        $total += $preu * $quantitats[$nom];
    }
    return $total;
}

// Mostra el resultat en una taula HTML
echo "<table>
    <thead>
        <th>Producte</th>
        <th>Preu unitari</th>
        <th>Quantitat</th>
        <th>Subtotal</th>
    </thead>
    <tbody>\n";

// Sota la taula, mostra el total de la compra
$resultats = array_detallat($productes, $quantitats);

foreach ($productes as $nom => $preu) {
    echo "        <tr>
            <td>" . $resultats[$nom] . "</td>
            <td>" . $resultats[$preu] . " €</td>
            <td>" . $quantitats[$nom] . "</td>
            <td>" . $resultats[$preu] * $quantitats[$nom] . " €</td>
        </tr>\n";
}

echo "    </tbody>
</table>";

echo "\nTotal compra: " . calc_total($productes, $quantitats) . " €\n";

?>