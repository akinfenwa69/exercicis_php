<?php

// Declarar array indexada
$noms = ["Anna", "Pau", "Júlia"];

// Declarar array associativa
$notes = [
    "Anna" => ["nota1" => 8, "nota2" => 9],
    "Joan" => ["nota1" => 6, "nota2" => 7],
    "Pau" => ["nota1" => 4, "nota2" => 5],
    "Clara" => ["nota1" => 9, "nota2" => 10],
    "Júlia" => ["nota1" => 7, "nota2" => 8]
];

echo "<table>
    <thead>
        <th>Nom</th>
        <th>Nota 1</th>
        <th>Nota 2</th>
        <th>Mitjana</th>
        <th>Resultat</th>
    </thead>
    <tbody>";

// Fer bucle que recorri l'array de noms
foreach ($noms as $nom) {

    // Calcular nota mitjana
    $nota_mitjana = ($notes[$nom]['nota1'] + $notes[$nom]['nota2']) / 2;

    if ($nota_mitjana >= 9) {
        $missatge_nota = "Excel·lent";
    } elseif ($nota_mitjana >= 7 && $nota_mitjana < 9) {
        $missatge_nota = "Notable";
    } elseif ($nota_mitjana >= 5 && $nota_mitjana < 7) {
        $missatge_nota = "Aprovat";
    } else {
        $missatge_nota = "Suspès";
    }

    // Mostrar nom de l'alumne
    // Mostra missatge nota de l'alumne
    echo "\n        <tr>
            <td>" . $nom . "</td>
            <td>" . $notes[$nom]['nota1'] . "</td>
            <td>" . $notes[$nom]['nota2'] . "</td>
            <td>" . $nota_mitjana . "</td>
            <td>" . $missatge_nota . "</td>
        </tr>";
}

echo "\n    </tbody>
</table>\n";

?>