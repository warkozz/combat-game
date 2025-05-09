<?php
class Personnage
{
    private int $_force;
    private string $_localisation;
    private int $_experience;
    private int $_degats;

    public function __construct(int $force, string $localisation, int $experience = 0, int $degats = 0)
    {
        $this->_force = $force;
        $this->_localisation = $localisation;
        $this->_experience = $experience;
        $this->_degats = $degats;
    }

    public function frapper(Personnage $cible): void
    {
        $cible->recevoirDegats($this->_force);
    }

    public function gagnerExperience(int $points): void
    {
        $this->_experience += $points;
    }

    public function deplacer(string $nouvelleLocalisation): void
    {
        $this->_localisation = $nouvelleLocalisation;
    }

    public function recevoirDegats(int $degats): void
    {
        $this->_degats += $degats;
    }

    public function getForce(): int
    {
        return $this->_force;
    }

    public function getLocalisation(): string
    {
        return $this->_localisation;
    }

    public function getExperience(): int
    {
        return $this->_experience;
    }

    public function getDegats(): int
    {
        return $this->_degats;
    }

    public function setForce(int $force): void
    {
        $this->_force = $force;
    }

    public function setLocalisation(string $localisation): void
    {
        $this->_localisation = $localisation;
    }

    public function setExperience(int $experience): void
    {
        $this->_experience = $experience;
    }

    public function setDegats(int $degats): void
    {
        $this->_degats = $degats;
    }
}
