<?php

function difficulty(): string
{
  $difficultyLevel = readline('Enter your choice: ');
  $validChoice = [1, 2, 3];

  if (!is_numeric($difficultyLevel) || !in_array(intval($difficultyLevel), $validChoice)) {
    echo "Pleace enter a valid numeric choice (1-3)\n\n";
    return difficulty();
  }

  switch ($difficultyLevel) {
    case 1:
      $difficulty = 'Easy';
      break;

    case 2:
      $difficulty = 'Medium';
      break;

    case 3:
      $difficulty = 'Hard';
      break;
  }

  return $difficulty;
}

function guess(int $guess, int $number, int $chances, int $attempts): int|null
{
  if ($guess == $number) {
    return $attempts;
  } else {
    if ($attempts < $chances) {
      switch (true) {
        case $guess > $number:
          echo "Incorrect! The number is less than $guess.\n\n";
          break;

        case $guess < $number:
          echo "Incorrect! The number is greater than $guess.\n\n";
          break;
      }

      $guess = readline('Enter your guess: ');
      $attempts++;

      return guess(intval($guess), $number, $chances, $attempts);
    } else {
      return null;
    }
  }
}
