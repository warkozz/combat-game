<?php
require_once __DIR__ . '/../config/config.php';

class Game {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterPersonnage($nom, $force, $localisation, $niveau, $hp) {
        $stmt = $this->pdo->prepare("INSERT INTO personnages (nom, `force`, localisation, niveau, hp) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $force, $localisation, $niveau, $hp]);
    }

    public function getPersonnages() {
        $stmt = $this->pdo->query("SELECT * FROM personnages");
        return $stmt->fetchAll();
    }

    public function supprimerPersonnage($id) {
        $stmt = $this->pdo->prepare("DELETE FROM personnages WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function modifierPersonnage($id, $nom, $force, $localisation, $niveau, $hp) {
        $stmt = $this->pdo->prepare("UPDATE personnages SET nom = ?, `force` = ?, localisation = ?, niveau = ?, hp = ? WHERE id = ?");
        $stmt->execute([$nom, $force, $localisation, $niveau, $hp, $id]);
    }
}