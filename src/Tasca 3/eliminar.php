<?php

require "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    eliminarUsuari($_POST['email']);
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
    <title>Eliminar | Exercici 3</title>
</head>

<body>

    <form action="eliminar.php" method="post" style="width: 300px;display: flex; flex-direction: column; gap: 4px;">
        <label for="email">E-mail <span style="color: red;">*</span></label>
        <input type="mail" name="email" required value="<?php echo $email ?>">
        <button type="submit">Eliminar</button>
    </form>

</body>

</html>