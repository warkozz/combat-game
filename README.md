# Combat Game

## Description
Combat Game is a simple PHP-based combat simulation game where players can create characters and simulate battles between them. The game is built using Object-Oriented Programming principles, ensuring a clean and maintainable code structure.

## Project Structure
```
combat-game
├── src
│   ├── Personnage.php  # Contains the Personnage class definition
│   ├── Game.php        # Manages game logic and interactions
│   └── index.php       # Entry point for the application
├── composer.json        # Composer configuration file
└── README.md            # Project documentation
```

## Installation
1. Clone the repository:
   ```
   git clone https://github.com/yourusername/combat-game.git
   ```
2. Navigate to the project directory:
   ```
   cd combat-game
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```

## Usage
To run the game, execute the `index.php` file from the command line or through a web server:
```
php src/index.php
```

## Classes and Methods

### Personnage Class
- **Attributes:**
  - `private $force`
  - `private $localisation`
  - `private $experience`
  - `private $degats`

- **Methods:**
  - `public function frapper(Personnage $cible)`: Attacks another character.
  - `public function gagnerExperience(int $points)`: Increases the character's experience.
  - `public function deplacer(string $nouvelleLocalisation)`: Changes the character's location.

### Game Class
- Responsible for managing the game flow, including:
  - Instantiating multiple `Personnage` objects.
  - Simulating interactions between characters.

## Contributing
Feel free to submit issues or pull requests to improve the game. Contributions are welcome!

## License
This project is open-source and available under the MIT License.