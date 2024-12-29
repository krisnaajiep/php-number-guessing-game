<?php

require_once 'functions.php';

if (
  !file_exists('attempts.json') ||
  is_null(json_decode(file_get_contents('attempts.json'), true))
) {
  $data = json_encode([
    'Easy' => 10,
    'Medium' => 5,
    'Hard' => 3,
  ], JSON_PRETTY_PRINT);

  file_put_contents('attempts.json', $data);
}

echo "\nWelcome to the Number Guessing Game!\nI'm thinking of a number between 1 and 100.\nYou have 5 chances to guess the correct number.\n";

$number = rand(1, 100);

echo "\nPlease select the difficulty level:\n1. Easy (10 chances)\n2. Medium (5 chances)\n3. Hard (3 chances)\n\n";

$difficulty = difficulty();
echo "Great! You have selected the $difficulty difficulty level.\nLet's start the game!\n\n";

$chances = $difficulty == 'Easy' ? 10 : ($difficulty == 'Medium' ? 5 : 3);
$attempts = 1;
$startTime = time();
$guess = readline('Enter your guess: ');

echo guess(intval($guess), $number, $chances, $attempts, $startTime, $difficulty);
