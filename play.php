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

echo play();
