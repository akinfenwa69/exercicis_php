<?php

require_once __DIR__ . '/controllers/jocController.php';

$controller = new JocController();
$accio = $_GET['accio'] ?? 'llista';

// redirect
switch ($accio) {
    case 'afegir':
        $controller->afegir();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    default:
        $controller->llista();
        break;
}

?>