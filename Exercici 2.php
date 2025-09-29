<?php

// Declarar variables
$nom = "Anna";                  // String
$edat = 20;                     // Integer
$correu = "anna@example.com";   // String
$telefon = "";                  // Empty array
$nota = 7;                      // Integer
$registre = null;               // Empty variable

// Comprova l'estat de les variables
echo "Nom: " . isset($nom) . empty($nom) . is_null($nom);
echo "\nEdat: " . isset($edat) . empty($edat) . is_null($edat);
echo "\nCorreu: " . isset($correu) . empty($correu) . is_null($correu);
echo "\nTeléfon: " . isset($telefon) . empty($telefon) . is_null($telefon);
echo "\nNota: " . isset($nota) . empty($nota) . is_null($nota);
echo "\nRegistre: " . isset($registre) . empty($registre) . is_null($registre);

// Condicions amb `if`, `elseif` i `else`
if ($edat >= 18) {
    $missatge_edat = "Ets major d'edat!";
} else {
    $missatge_edat = "No ets major d'edat!";
}

if ($nota >= 9) {
    $missatge_nota = "Excel·lent";
} elseif ($nota >= 7 && $nota < 9) {
    $missatge_nota = "Notable";
} elseif ($nota >= 5 && $nota < 7) {
    $missatge_nota = "Aprovat";
} else {
    $missatge_nota = "Suspès";
}

// Operadors lògics
if (empty($telefon) && filter_var($correu, FILTER_VALIDATE_EMAIL)) {
    $op1 = "Missatge d'avís!";
}

if (is_null($registre) || empty($registre)) {
    $op2 = "Altre missatge!";
}


// BONUS: Mostra tots els resultats dins d'una llista HTML
echo "\n<ul>
        <li>Edat: $missatge_edat</li>
        <li>Nota: $missatge_nota</li>
        <li>Operadors lògics 1: $op1</li>
        <li>Operadors lògics 2: $op2</li>
    </ul>";

?>