<?php

require_once __DIR__ . '/../config/db.php';

class JocModel
{
    private $pdo;
    public $header = ['ID', 'Nom', 'Plataforma', ' Any d\'estrena', 'Estat'];

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Llegir tots els jocs
    public function llegirJocs()
    {
        $stmt = $this->pdo->query('SELECT id, nom, plataforma, any_estrena, estat FROM videojocs ORDER BY id ASC');
        $out = [];
        foreach ($stmt as $row)
            $out[] = [$row['id'], $row['nom'], $row['plataforma'], $row['any_estrena'], $row['estat']];
        return $out;
    }

    // Afegir videojoc
    public function afegirJoc($nom, $plataforma, $any_estrena, $estat)
    {
        //$if(!in_array($estat, ['Jugant', 'Completat', 'Pendent'])) throw new Exception('Estat invàlid');
        $stmt = $this->pdo->prepare('INSERT INTO videojocs (nom, plataforma, any_estrena, estat) VALUES (?,?,?,?)');
        $stmt->execute([$nom, $plataforma, $any_estrena, $estat]);
    }

    // Modificar videojoc
    public function editarJoc($id, $nous_dades)
    {
        $camps = [];
        $vals = [];

        if (!empty($nous_dades['nom'])) {
            $camps[] = 'nom=?';
            $vals[] = $nous_dades['nom'];
        }

        if (!empty($nous_dades['plataforma'])) {
            $camps[] = 'plataforma=?';
            $vals[] = $nous_dades['plataforma'];
        }

        if (!empty($nous_dades['any_estrena'])) {
            $camps[] = 'any_estrena=?';
            $vals[] = $nous_dades['any_estrena'];
        }

        if (!empty($nous_dades['estat'])) {
            //$if(!in_array($estat, ['Jugant', 'Completat', 'Pendent'])) throw new Exception('Estat invàlid');
            $camps[] = 'estat=?';
            $vals[] = $nous_dades['estat'];
        }

        if (empty($camps))
            return;
        $vals[] = $id;
        $sql = 'UPDATE videojocs SET ' . implode(', ', $camps) . ' WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($vals);
    }

    // Eliminar videojoc
    public function eliminarJoc($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM videojocs WHERE id=?');
        $stmt->execute([$id]);
    }
}

// Utilitza prepared statements per evitar injeccions SQL
// Ordena els resultats per nom o any d'estrena

?>