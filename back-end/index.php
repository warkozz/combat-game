<?php
require_once 'config/config.php';
require_once 'src/Game.php';

$game = new Game($pdo);

header('Content-Type: application/json'); // Assurez-vous que la réponse est au format JSON

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'create') {
            $nom = $_POST['nom'] ?? 'Inconnu';
            $force = (int) ($_POST['force'] ?? 0);
            $localisation = $_POST['localisation'] ?? 'Inconnu';
            $niveau = (int) ($_POST['niveau'] ?? 1);
            $hp = (int) ($_POST['hp'] ?? 100);

            $game->ajouterPersonnage($nom, $force, $localisation, $niveau, $hp);
            echo json_encode(["message" => "Personnage créé avec succès !"]);
        } elseif ($_POST['action'] === 'delete') {
            $id = (int) $_POST['id'];
            $game->supprimerPersonnage($id);
            echo json_encode(["message" => "Personnage supprimé avec succès !"]);
        } elseif ($_POST['action'] === 'update') {
            $id = (int) $_POST['id'];
            $nom = $_POST['nom'] ?? null;
            $force = isset($_POST['force']) ? (int) $_POST['force'] : null;
            $localisation = $_POST['localisation'] ?? null;
            $niveau = isset($_POST['niveau']) ? (int) $_POST['niveau'] : null;
            $hp = isset($_POST['hp']) ? (int) $_POST['hp'] : null;

            $game->modifierPersonnage($id, $nom, $force, $localisation, $niveau, $hp);
            echo json_encode(["message" => "Personnage modifié avec succès !"]);
        }
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
        if ($_GET['action'] === 'stats') {
            $personnages = $game->getPersonnages();
            echo json_encode($personnages);
        }
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Une erreur est survenue : " . $e->getMessage()]);
}