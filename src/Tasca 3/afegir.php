<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir | Exercici 3</title>
</head>

<body>
    <form action="afegir.php" method="post" style="display: flex; flex-direction: column; gap: 4px; width: 300px;">
        <label for="nom">Nom</label>
        <input type="text" name="nom">
        <label for="email">E-mail</label>
        <input type="mail" name="email">
        <label for="edat">Edat</label>
        <input type="number" name="edat">
        <button type="submit">Crear</button>
    </form>

    <?php
    require "functions.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $edat = $_POST["edat"];
        if ($edat >= 18) {
            echo "<script>alert('Ets major d\'edat!')</script>";
        } else {
            echo "<script>alert('No ets major d\'edat!')</script>";
        }
        $edat = (int) $edat;

        afegirUsuari($_POST['nom'], $_POST['email'], $_POST['edat']);
        header("Location: index.php");
        exit;
    }
    ?>
</body>

</html>