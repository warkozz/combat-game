<?php
require_once 'Personnage.php';
require_once 'Game.php';

// Création de plusieurs personnages via formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    session_start();
    if (!isset($_SESSION['game'])) {
        $_SESSION['game'] = new Game();
    }
    $game = $_SESSION['game'];

    if ($_POST['action'] === 'create') {
        $nom = $_POST['nom'] ?? 'Inconnu';
        $force = (int) ($_POST['force'] ?? 0);
        $localisation = $_POST['localisation'] ?? 'Inconnu';
        $niveau = (int) ($_POST['niveau'] ?? 1);
        $hp = (int) ($_POST['hp'] ?? 100);

        $personnage = new Personnage($nom, $force, $localisation, $niveau, $hp);
        $game->ajouterPersonnage($personnage);
        echo "Personnage créé avec succès !";
    } elseif ($_POST['action'] === 'stats') {
        $game->afficherStatistiques();
    }
    exit;
}

// Création de plusieurs personnages
$personnage1 = new Personnage(10, 'Forêt', 0, 5);
$personnage2 = new Personnage(8, 'Montagne', 0, 3);

// Simulation d'interactions
echo "Avant le combat:\n";
echo "Personnage 1: Force = " . $personnage1->getForce() . ", Localisation = " . $personnage1->getLocalisation() . ", Expérience = " . $personnage1->getExperience() . ", Dégâts = " . $personnage1->getDegats() . "\n";
echo "Personnage 2: Force = " . $personnage2->getForce() . ", Localisation = " . $personnage2->getLocalisation() . ", Expérience = " . $personnage2->getExperience() . ", Dégâts = " . $personnage2->getDegats() . "\n";

// Personnage 1 attaque Personnage 2
$personnage1->frapper($personnage2);

// Gagner de l'expérience
$personnage1->gagnerExperience(10);

// Déplacement
$personnage1->deplacer('Plage');

echo "Après le combat:\n";
echo "Personnage 1: Force = " . $personnage1->getForce() . ", Localisation = " . $personnage1->getLocalisation() . ", Expérience = " . $personnage1->getExperience() . ", Dégâts = " . $personnage1->getDegats() . "\n";
echo "Personnage 2: Force = " . $personnage2->getForce() . ", Localisation = " . $personnage2->getLocalisation() . ", Expérience = " . $personnage2->getExperience() . ", Dégâts = " . $personnage2->getDegats() . "\n";
?>