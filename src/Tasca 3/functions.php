<?php
// funcions.php — Versió amb MySQL

// Paràmetres de connexió
$DB_HOST = 'mysql';
$DB_NAME = 'exercici1';
$DB_USER = 'root';
$DB_PASS = 'root';

// Connexió amb PDO
$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die("Error de connexió: " . $e->getMessage());
}

/**
 * Llegeix totes les usuaris.
 * Retorna un array d'arrays amb el mateix format que el CSV:
 * [nom, email, edat]
 */
function llegirUsuari() {
    global $pdo;
    $stmt = $pdo->query("SELECT nom, email, edat FROM usuaris ORDER BY email ASC");
    $usuaris = [];
    foreach ($stmt as $r) {
        $usuaris[] = [$r['nom'], $r['email'], $r['edat']];
    }
    return $usuaris;
}

/**
 * Aquesta funció ja no s’utilitza amb MySQL.
 */
function guardarUsuari($usuaris) {
    // No fa res, es manté per compatibilitat
}

/**
 * Busca un usuari pel email.
 * Retorna ['index' => null, 'usuari' => [...]] o null si no existeix.
 */
function buscarUsuari($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT nom, email, edat FROM usuaris WHERE email = ?");
    $stmt->execute([$email]);
    $r = $stmt->fetch();
    if ($r) {
        return ['index' => null, 'usuari' => [$r['nom'], $r['email'], $r['edat']]];
    }
    return null;
}

/**
 * Afegeix un usuari nou.
 */
function afegirUsuari($nom, $email, $edat) {
    global $pdo;

    if (buscarUsuari($email)) {
        throw new Exception("Ja existeix un usuari amb el email '$email'.");
    }

    $stmt = $pdo->prepare("INSERT INTO usuaris (nom, email, edat) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $edat]);
}

/**
 * Edita un usuari pel seu email.
 */
function editarUsuari($email, $nous_dades) {
    global $pdo;

    $camps = [];
    $vals  = [];

    if (!empty($nous_dades['nom'])) {
        $camps[] = "nom = ?";
        $vals[]  = $nous_dades['nom'];
    }
    if (!empty($nous_dades['edat'])) {
        $camps[] = "edat = ?";
        $vals[]  = $nous_dades['edat'];
    }

    if (empty($camps)) return;

    $vals[] = $email;
    $sql = "UPDATE usuaris SET " . implode(', ', $camps) . " WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($vals);
}

/**
 * Elimina un usuari pel nom.
 */
function eliminarUsuari($email) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM usuaris WHERE email = ?");
    $stmt->execute([$email]);
}
?>