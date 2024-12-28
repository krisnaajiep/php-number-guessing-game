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

function guess(int $guess, int $number, int $chances, int $attempts): string
{
  if ($guess == $number) {
    echo "Congratulations! You guessed the correct number in $attempts attempts.\n\n";
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
      echo "Chances is over. The correct number is $number.\n\n";
    }
  }

  if (!replay($chances)) return "\nThank you for playing.\n\n";
}

function replay(int $chances)
{
  $replay = readline("Want to play again? [y/n]");

  if ($replay == 'y') {
    echo "\n";
    $number = rand(1, 100);
    $attempts = 1;
    $guess = readline('Enter your guess: ');
    guess(intval($guess), $number, $chances, $attempts);
  } else {
    return false;
  }
}
