<?php
    $users = [
        [1, 'مهدی عابدی', 20, 'اصفهان'],
        [2, 'محمد ایزدی', 32, 'کرمان'],
        [3, 'حامد محمدی', 18, 'تهران'],
        [4, 'حسین حسینی', 27, 'کاشان'],
        [5, 'علی یاسینی', 24, 'شیراز']
      ];

    if (!file_exists('csv')) {
      mkdir('csv');
      $csvFile = fopen('csv/users.csv', 'w');
      foreach ($users as $user) {
        fputcsv($csvFile, $user);
      }
      fclose($csvFile);
    }
    else {
      $csvFile = fopen('csv/users.csv', 'w');
      foreach ($users as $user) {
        fputcsv($csvFile, $user);
      }
      fclose($csvFile);
    }

    $users = array();
    $csvFile = fopen('csv/users.csv', 'r');
    while (!feof($csvFile)) {
      $data = fgetcsv($csvFile);
      if (empty($data))
        break;
      array_push($users, $data);
    }
    fclose($csvFile);
    echo json_encode($users);
?>