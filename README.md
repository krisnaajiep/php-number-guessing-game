# PHP Number Guessing Game
> Simple number guessing CLI (Command Line Interface) based game built with PHP.

## Table of Contents
* [General Info](#general-information)
* [Technologies Used](#technologies-used)
* [Features](#features)
* [Setup](#setup)
* [How to play](#how-to-play)
* [Project Status](#project-status)
* [Acknowledgements](#acknowledgements)

## General Information
PHP Number Guessing Game is a simple CLI (Command Line Interface) based game built with PHP where the computer randomly selects a number and the user has to guess it. This project is designed to explore and practice logic building and working with the Command Line Interface (CLI) in PHP.

## Technologies Used
- PHP - version 8.3.6

## Features
- **Difficulty Level**: Difficulty level options (easy, medium, hard) which will determine the number of chances they get to guess the number.
- **Hint System**: Provides clues to the user if they are stuck.
- **Multiple Round**: Asking the user if they want to play again after each round.
- **Timer**: Display a timer to see how long it takes the user to guess the number.
- **High Score**: Keep track of the user’s fewest attempts under a specific difficulty level.

## Setup
To run this CLI tool, you’ll need:
- **PHP**: Version 8.3 or newer

How to install:
1. Clone the repository
   ```bash
   git clone https://github.com/krisnaajiep/php-number-guessing-game.git
   ```

2. Change the current working directory
   ```bash
   cd path/php-number-guessing-game
   ```

3. Run the game
   ```bash
   php play.php
   ```

## How to play
After running the game, a welcome message along with the rules of the game will be displayed.

```bash
Welcome to the Number Guessing Game!
I'm thinking of a number between 1 and 100.
You have 5 chances to guess the correct number.
```

Select the difficulty level (easy, medium, hard) which will determine the number of chances you get to guess the number.

```bash
Please select the difficulty level:
1. Easy (10 chances)
2. Medium (5 chances)
3. Hard (3 chances)

Enter your choice: 2
```

Enter your guess.

```bash
Great! You have selected the Medium difficulty level.
Let's start the game!

Enter your guess: 50
```

If the guess is incorrect, the game will display a message indicating whether the number is greater or less than the guess.

```bash
Incorrect! The number is less than 50.
```

If more than half of the guesses are wrong, a hint will be displayed.

```bash
Incorrect! The number is less than 20.
Hint: the number is beetween 10-19
```

If the guess is correct, the game will display a congratulatory message along with the number of attempts made to guess the number. The game will also display time to see how long it took the user to guess the number and the highest score means the fewest number of attempts required to guess the number at a certain difficulty level.

```bash
Congratulations! You guessed the correct number in 3 attempts.
Time: 00:00:05
Highest score: 3 attempts (Medium)
```

At the end of the game, a question for replaying the game will be displayed. If you choose `y` then the game will be played again, if you choose `n` then the game ends.

```bash
Want to play again? [y/n]n

Thank you for playing.
```

## Project Status
Project is: _complete_.

## Acknowledgements
This project was inspired by [roadmap.sh](https://roadmap.sh/projects/number-guessing-game).
