<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llista | Jocs MVC</title>
</head>

<body>

    <h1>Llista de videojocs (MySQL)</h1>
    <a href="/index.php?accio=afegir">Afegir</a>
    <a href="/index.php?accio=editar">Editar</a>
    <a href="/index.php?accio=eliminar">Eliminar</a>

    <br>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <?php
                foreach ($header as $h)
                    echo "<th>$h</th>";
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videojocs as $v): ?>
                <tr>
                    <?php foreach ($v as $i => $c) {
                        echo "<td>" . htmlspecialchars($c) . "</td>";
                    } ?>
                <tr> <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>