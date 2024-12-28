<?php

require_once 'functions.php';

echo "\nWelcome to the Number Guessing Game!\nI'm thinking of a number between 1 and 100.\nYou have 5 chances to guess the correct number.\n";

$number = rand(1, 100);

echo "\nPlease select the difficulty level:\n1. Easy (10 chances)\n2. Medium (5 chances)\n3. Hard (3 chances)\n\n";

$difficulty = difficulty();
echo "Great! You have selected the $difficulty difficulty level.\nLet's start the game!\n\n";

$guess = readline('Enter your guess: ');

$chances = $difficulty == 'Easy' ? 10 : ($difficulty == 'Medium' ? 5 : 3);
$attempts = 1;

$result = guess(intval($guess), $number, $chances, $attempts);

if (!is_null($result)) {
  echo "Congratulations! You guessed the correct number in $result attempts.\n\n";
} else {
  echo "Chances is over. The correct number is $number.\n\n";
}
