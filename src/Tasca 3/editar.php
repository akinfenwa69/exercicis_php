<?php

require "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    editarUsuari($_POST['email'], [
        'nom' => $_POST['nom'] ?: null,
        'edat' => $_POST['edat'] ?: null,
    ]);
    header("Location: index.php");
    exit;
}

if (isset($_GET["email"]) && !empty(trim($_GET["email"]))) {
    $email = trim($_GET["email"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar | Exercici 3</title>
</head>

<body>

    <form action="editar.php" method="post" style="width: 300px;display: flex; flex-direction: column; gap: 4px;">
        <label for="email">E-mail <span style="color: red;">*</span></label>
        <input type="mail" name="email" required value="<?php echo $email ?>">
        <label for="nom">Nom</label>
        <input type="text" name="nom" value="<?php echo $nom ?>">
        <label for="edat">Edat</label>
        <input type="number" name="edat" value="<?php echo $edat ?>">
        <button type="submit">Guardar</button>
    </form>

</body>

</html>