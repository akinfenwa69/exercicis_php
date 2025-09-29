<?php

// Declarar variables
$nom = "Pol";       // String
$edat_str = "19";   // String
$nota_float = 7.5;  // Float
$aprovat = true;    // Boolean

// Convertir $edat_str a integer i desar a $edat
$edat = (int) $edat_str;

// Calcular la suma de $edat + $nota_float i mostrar-la amb echo
$suma = $edat + $nota_float;
echo "Suma edat i nota: " . $suma;

// Mostra totes les variables amb missatge
echo "<div>
        <p>Nom: $nom</p>
        <p>Edat: $edat</p>
        <p>Nota: $nota_float</p>
        <p>Suma edat + nota: $suma</p>
    </div>";

// Crear condició
if ($aprovat) {
    echo "L'alumne ha aprovat";
} else {
    echo "L'alumne ha suspès";
}

// Conversions addisionals
$edat_str2 = (string) $edat;
echo $edat_str;

$nota_int = (int) $nota_float;
echo $nota_int;

?>