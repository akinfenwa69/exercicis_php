<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar</title>
</head>

<body>

    <h1>Eliminar videojoc</h1>

    <form action="index.php?accio=eliminar" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" id="id" require>

        <button type="sumit">Eliminar</button>
        <a href="/">Tornar a la llista</a>
    </form>

</body>

</html>