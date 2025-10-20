<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 3</title>
</head>

<body>

    <h1 style="text-align: center">INICI - Exercici 3 (Individual)</h1>

    <div>
        <button onclick="window.location.href='/0613/3/1/afegir.php'">Afegir usuari</button>
        <button onclick="window.location.href='/0613/3/1/editar.php'">Editar usuari</button>
        <button onclick="window.location.href='/0613/3/1/eliminar.php'">Eliminar usuari</button>
    </div>

    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>E-mail</td>
                <td>Edat</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </thead>
        <tbody>
            <?php

            require("functions.php");
            $usuaris = llegirUsuari();

            foreach ($usuaris as $user) {
                echo "
            <tr>
                <td>" . htmlspecialchars(array_search($user, $usuaris)) . "</td>
                <td>" . htmlspecialchars($user[0]) . "</td>
                <td>" . htmlspecialchars($user[1]) . "</td>
                <td>" . htmlspecialchars($user[2]) . "</td>
                <td><a href='editar.php?email=" . $user[1] . "'>Editar</a></td>
                <td><a href='eliminar.php?email=" . $user[1] . "'>Eliminar</a></td>
            </tr>";
            }
            ;

            ?>
        </tbody>
    </table>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</body>

</html>