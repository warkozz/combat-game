<?php

class Game {
    private $personnages = [];

    public function ajouterPersonnage(Personnage $personnage) {
        $this->personnages[] = $personnage;
    }

    public function simulerCombat($attaquantIndex, $defenseurIndex) {
        if (isset($this->personnages[$attaquantIndex]) && isset($this->personnages[$defenseurIndex])) {
            $attaquant = $this->personnages[$attaquantIndex];
            $defenseur = $this->personnages[$defenseurIndex];

            $degatsInfliges = $attaquant->frapper();
            $defenseur->recevoirDegats($degatsInfliges);
            $attaquant->gagnerExperience(10); // Gagner de l'expérience après un combat
        } else {
            throw new Exception("Personnage non trouvé.");
        }
    }

    public function afficherStatistiques() {
        foreach ($this->personnages as $index => $personnage) {
            echo "Personnage " . ($index + 1) . ": Force: " . $personnage->getForce() . 
                 ", Localisation: " . $personnage->getLocalisation() . 
                 ", Expérience: " . $personnage->getExperience() . 
                 ", Dégâts: " . $personnage->getDegats() . PHP_EOL;
        }
    }
}