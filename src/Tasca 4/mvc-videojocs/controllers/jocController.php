<?php

require_once __DIR__ . "/../models/jocModel.php";

class JocController
{
    private $model;
    public function __construct()
    {
        $this->model = new JocModel();
    }

    // Llistar jocs
    public function llista()
    {
        $videojocs = $this->model->llegirJocs();
        $header = $this->model->header;
        require __DIR__ . "/../views/llistaJocs.php";
    }

    // Afegir joc
    public function afegir()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->afegirJoc($_POST['nom'], $_POST['plataforma'], $_POST['any_estrena'], $_POST['estat']);
            header('Location: index.php');
            exit;
        }
        require __DIR__ . '/../views/afegirJoc.php';
    }

    // Editar joc
    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->model = $this->model->editarJoc($_POST["id"], [
                'nom' => $_POST['nom'] ?: null,
                'plataforma' => $_POST['plataforma'] ?: null,
                'any_estrena' => $_POST['any_estrena'] ?: null,
                'estat' => $_POST['estat'] ?: null,
            ]);
            header('Location: index.php');
            exit;
        }
        require __DIR__ . "/../views/editarJoc.php";
    }

    // Eliminar joc
    public function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->eliminarJoc($_POST["id"]);
            header("Location: index.php");
            exit;
        }
        require __DIR__ . "/../views/eliminarJoc.php";
    }
}

?>