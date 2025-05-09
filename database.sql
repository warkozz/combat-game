CREATE DATABASE combat_game;

USE combat_game;

CREATE TABLE personnages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    `force` INT NOT NULL,
    localisation VARCHAR(50) NOT NULL,
    niveau INT NOT NULL,
    hp INT NOT NULL
);