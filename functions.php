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

function guess(int $guess, int $number, int $chances, int $attempts, int $startTime): string
{
  if ($guess == $number) {
    echo "Congratulations! You guessed the correct number in $attempts attempts.\n";
    $endTime = time();
    $time = gmdate('H:i:s', ($endTime - $startTime));
    echo "Time: $time\n\n";
  } else {
    if ($attempts < $chances) {
      if ((60 * $chances) / 100  <= $attempts) {
        $numRange = strlen(strval($number)) > 1 && strlen(strval($number)) < 90
          ? strval($number)[0] . '0-' . strval($number)[0] . '9'
          : (strlen(strval($number)) >= 90
            ? '90-100'
            : '0-9');
        $hint = "Hint: the number is beetween $numRange\n";
      } else {
        $hint = '';
      }

      switch (true) {
        case $guess > $number:
          $comp = 'less';
          break;

        case $guess < $number:
          $comp = 'greater';
          break;
      }

      echo "Incorrect! The number is $comp than $guess.\n$hint\n";

      $guess = readline('Enter your guess: ');
      $attempts++;

      return guess(intval($guess), $number, $chances, $attempts, $startTime);
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
    $startTime = time();
    $guess = readline('Enter your guess: ');
    guess(intval($guess), $number, $chances, $attempts, $startTime);
  } else {
    return false;
  }
}
