<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Videojocs</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>plataforma</th>
                <th>Any Estrena</th>
                <th>Estat</th>
                <th>Preu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($variable as $key); ?>
            <tr>
                <?php foreach ($key as $value => $v) {
                    echo '<td>' . $v . '</td>';
                } ?>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>
