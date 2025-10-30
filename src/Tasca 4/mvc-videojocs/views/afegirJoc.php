<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir</title>
</head>

<body>

    <h1>Afegir videjoc</h1>

    <form action="/index.php?accio=afegir" method="post" style="display:flex;flex-direction:column;gap:8px;max-width:400px;">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom">

        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" id="plataforma">

        <label for="any_estrena">Any d'estrena</label>
        <input type="number" name="any_estrena" id="any_estrena">

        <label for="estat">Estat</label>
        <select name="estat" id="estat">
            <option value="Completat">Completat</option>
            <option value="Pendent">Pendent</option>
            <option value="Jugant">Jugant</option>
        </select>

        <button type="sumit">Afegir</button>
        <a href="/">Tornar a la llista</a>
    </form>

</body>

</html>