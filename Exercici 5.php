<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <!-- 1. Formulari HTML -->
    <form action="" method="post">
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
        $name = $_POST["name"];
        $age = $_POST["age"];
        $mult = $_POST["mult"];


        if (!empty($name) && !empty($age) && !empty($mult)) {

            // Mostrar missatge amb nom i l'edat
            echo "<p>Hola " . $name . ", tens " . $age . " anys.</p>";


            // Major d'edat?
            function esMajorEdat($age)
            {
                if ($age >= 18) {
                    return true;
                }
                return false;
            }
            ;
            echo "<p>" . esMajorEdat($age) ? "Ets major d'edat" : "No ets major d'edat" . "</p>";


            // Mostrar taula multiplicar
            echo "<br><p>Taula del " . $mult . ":</p>";
            echo "<ul>";
            for ($i = 1; $i < 11; $i++) {
                echo "<li>" . $mult . " * " . $i . " = " . $mult * $i . "</li>";
            }
            ;
            echo "</ul>";


            // Mostrar compte enrere
            echo "<br><p>Compte enrere:</p>";
            $compte = $mult;
            echo "<ul>";
            while ($compte > -1) {
                echo "<li>" . $compte . "</li>";
                $compte--;
            }
            ;
            echo "</ul>";


            // Crear array amb tres notes
            $array = [6, 7.5, 8];
            echo "<br><p>Les notes són: ";
            foreach ($array as $key => $value) {
                echo $value . ($key != count($array) - 1 ? ", " : null);
            }
            ;
            echo "</p>";


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
            echo "<p>La mitjana de les notes és: " . number_format(mitjana($array), 2) . "</p>";
        } else {
            echo "Si us plau, omple tots els camps.";
        }
    }
    ?>
</body>


</html>