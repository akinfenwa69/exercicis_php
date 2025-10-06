<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- 1. Formulari HTML -->
    <form action="./Exercici 5.php" method="post">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name">
        <label for="age">Edat</label>
        <input type="number" name="age" id="age">
        <label for="mult">Número 1-10</label>
        <input type="number" name="mult" id="mult" max="10" min="1">
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = $_POST("name");
        $age = $_POST["age"];
        $mult = $_POST["mult"];

        if (!empty($name) && !empty($age) && !empty($mult)) {
            
            // Mostrar missatge amb nom i l'edat
            echo "Hola " . $name . ", tens " . $age . " anys.\n";

            // Major d'edat?
            function esMajorEdat($age)
            {
                if ($age >= 18) {
                    return true;
                }
                return false;
            }
            ;
            echo esMajorEdat($age) ? "Ets major d'edat" : "No ets major d'edat";

            // Mostrar taula multiplicar
            echo "\n\nTaula del " . $mult . ":\n";
            for ($i = 1; $i < 11; $i++) {
                echo $mult . " * " . $i . " = " . $mult * $i . "\n";
            }
            ;

            // Mostrar compte enrere
            echo "\nCompte enrere:\n";
            $compte = $mult;
            while ($compte > -1) {
                echo $compte . ($compte != 0 ? ", " : null);
                $compte--;
            }
            ;

            // Crear array amb tres notes
            $array = [6, 7.5, 8];
            echo "\n\nLes notes són: ";
            foreach ($array as $key => $value) {
                echo $value . ($key != count($array) - 1 ? ", " : null);
            }
            ;

            // Afegir funció mitjana($notes)
            function mitjana($array)
            {
                $mitjana = 0;
                foreach ($array as $key => $value) {
                    $mitjana += $value;
                }
                return $mitjana / count($array);
            }
            ;
            echo "\nLa mitjana de les notes és: " . number_format(mitjana($array), 2) . "\n";
        } else {
            echo "Si us plau, omple tots els camps.";
        }
    }
    ?>
</body>

</html>