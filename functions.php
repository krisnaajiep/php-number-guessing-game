<?php

function choice(): array
{
  $difficultyLevel = readline('Enter your choice: ');
  $validChoice = [1, 2, 3];

  if (!is_numeric($difficultyLevel) || !in_array(intval($difficultyLevel), $validChoice)) {
    echo "Pleace enter a valid numeric choice (1-3)\n\n";
    return choice();
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

  return ["Great! You have selected the $difficulty difficulty level.\nLet's start the game!\n\n", $difficulty, time()];
}

function guess(int $guess, int $number, int $chances, int $attempts): array|string
{
  if ($guess == $number) {
    return ["Congratulations! You guessed the correct number in $attempts attempts.\n", time()];
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
      return ["Chances is over. The correct number is $number.\n\n"];
    }
  }
}

function play(): string
{
  echo "\nWelcome to the Number Guessing Game!\nI'm thinking of a number between 1 and 100.\nYou have 5 chances to guess the correct number.\n\n";

  $number = rand(1, 100);

  echo "Please select the difficulty level:\n1. Easy (10 chances)\n2. Medium (5 chances)\n3. Hard (3 chances)\n\n";

  $choice = choice();
  echo $choice[0];
  $difficulty = $choice[1];
  $startTime = $choice[2];

  $guess = readline('Enter your guess: ');

  $chances = $difficulty == 'Easy' ? 10 : ($difficulty == 'Medium' ? 5 : 3);
  $attempts = 1;

  $result = guess(intval($guess), $number, $chances, $attempts);

  if (isset($result[1])) {
    $endTime = $result[1];
    $time = gmdate('H:i:s', ($endTime - $startTime));

    echo $result[0] . "Time: $time\n\n";
  } else {
    echo $result[0];
  }

  $replay = readline("Want to play again? [y/n]");

  return $replay == 'y' ? play() : "\nThank you for playing.";
}
