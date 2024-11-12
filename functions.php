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

  return [
    'message' => "Great! You have selected the $difficulty difficulty level.\nLet's start the game!\n\n",
    'difficulty' => $difficulty,
    'startTime' => time()
  ];
}

function guess(int $guess, int $number, int $chances, int $attempts): array|string
{
  if ($guess == $number) {
    return [
      'message' => "Congratulations! You guessed the correct number in $attempts attempts.\n",
      'endTime' => time(),
      'attempts' => $attempts,
    ];
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
          echo "Incorrect! The number is less than $guess.\n$hint\n";
          break;

        case $guess < $number:
          echo "Incorrect! The number is greater than $guess.\n$hint\n";
          break;
      }

      $guess = readline('Enter your guess: ');
      $attempts++;

      return guess(intval($guess), $number, $chances, $attempts);
    } else {
      return "Chances is over. The correct number is $number.\n\n";
    }
  }
}

function play(int $highestScore = 10): string
{
  $scores = json_decode(file_get_contents('attempts.json'), true);

  echo "\nWelcome to the Number Guessing Game!\nI'm thinking of a number between 1 and 100.\nYou have 5 chances to guess the correct number.\n\n";

  $number = rand(1, 100);

  echo "Please select the difficulty level:\n1. Easy (10 chances)\n2. Medium (5 chances)\n3. Hard (3 chances)\n\n";

  $choice = choice();
  echo $choice['message'];
  $difficulty = $choice['difficulty'];
  $startTime = $choice['startTime'];

  $guess = readline('Enter your guess: ');

  $chances = $difficulty == 'Easy' ? 10 : ($difficulty == 'Medium' ? 5 : 3);
  $attempts = 1;

  $result = guess(intval($guess), $number, $chances, $attempts);

  if (is_array($result) && isset($result['endTime'])) {
    $endTime = $result['endTime'];
    $time = gmdate('H:i:s', ($endTime - $startTime));

    if ($scores[$difficulty] > $result['attempts']) {
      $scores[$difficulty] = $result['attempts'];
      file_put_contents('attempts.json', json_encode($scores, JSON_PRETTY_PRINT));
    }

    echo $result['message'] . "Time: $time\nHighest score: {$scores[$difficulty]} attempts ($difficulty)\n\n";
  } else {
    echo $result;
  }

  $replay = readline("Want to play again? [y/n]");

  return $replay == 'y' ? play($highestScore) : "\nThank you for playing.";
}
