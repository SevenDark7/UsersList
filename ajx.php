<?php
    $users = [
        [1, 'مهدی عابدی', 20, 'اصفهان'],
        [2, 'محمد ایزدی', 32, 'کرمان'],
        [3, 'حامد محمدی', 18, 'تهران'],
        [4, 'حسین حسینی', 27, 'کاشان'],
        [5, 'علی یاسینی', 24, 'شیراز']
      ];
    if(isset($_POST['action'])) {
      $act = $_POST['action'];
      switch($act) {
        case 1:
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
          break;
        case 2:
          $name = isset($_POST['userName']) ? $_POST['userName'] : 'No Name';
          $age = isset($_POST['userAge']) ? $_POST['userAge'] : 'No Age';
          $city = isset($_POST['userCity']) ? $_POST['userCity'] : 'No City';

          $csvFile = file('csv/users.csv');
          $count = count($csvFile);
          $info = [++$count, $name, $age, $city];
          $csvFile = fopen('csv/users.csv', 'a');
          fputcsv($csvFile, $info);
          fclose($csvFile);

          $csvFile = fopen('csv/users.csv', 'r');
          $users = array();
          while(!feof($csvFile)) {
              $user = fgetcsv($csvFile);
              if (empty($user)) {
                  break;
              }
              array_push($users, $user);
          }

          fclose($csvFile);

          echo json_encode($users);
          break;
        case 3:
          $row = isset($_POST['row']) ? $_POST['row'] : 'No Row';
          $csvFile = fopen('csv/users.csv', 'r');
          $users = array();
          while(!feof($csvFile)) {
              $user = fgetcsv($csvFile);
              if (empty($user))
                  break;
              if ($user[0] != $row)
                  array_push($users, $user);
          }

          fclose($csvFile);

          $csvFile = fopen('csv/users.csv', 'w');
          foreach ($users as $user) {
              fputcsv($csvFile, $user);
          }
          fclose($csvFile);

          $csvFile = fopen('csv/users.csv', 'r');
          $users = array();
          while(!feof($csvFile)) {
              $user = fgetcsv($csvFile);
              if (empty($user))
                  break;
              array_push($users, $user);
          }

          fclose($csvFile);

          echo json_encode($users);
          break;
        case 4:
          $id = isset($_POST['id']) ? $_POST['id'] : 'No ID';
          $name = isset($_POST['name']) ? $_POST['name'] : 'No Name';
          $age = isset($_POST['age']) ? $_POST['age'] : 'No Age';
          $city = isset($_POST['city']) ? $_POST['city'] : 'No City';

          $edtUser = [$id, $name, $age, $city];
          $users = array();
          $csvFile = fopen('csv/users.csv', 'r');
          while (!feof($csvFile)) {
              $data = fgetcsv($csvFile);
              if (empty($data))
                  break;
                  
              if ($data[0] != $id) {
                  array_push($users, $data);
              }
              else {
                  array_push($users, $edtUser);
              }
          }
          fclose($csvFile);

          $csvFile = fopen('csv/users.csv', 'w');
          foreach ($users as $user) {
              fputcsv($csvFile, $user);
          }
          fclose($csvFile);

          $csvFile = fopen('csv/users.csv', 'r');
          $users = array();
          while(!feof($csvFile)) {
              $user = fgetcsv($csvFile);
              if (empty($user))
                  break;
              array_push($users, $user);
          }
          fclose($csvFile);

          echo json_encode($users);
          break;
        default:
          echo 'Error to loading information...';
      }
    }
    // if (!file_exists('csv')) {
    //   mkdir('csv');
    //   $csvFile = fopen('csv/users.csv', 'w');
    //   foreach ($users as $user) {
    //     fputcsv($csvFile, $user);
    //   }
    //   fclose($csvFile);
    // }
    // else {
    //   $csvFile = fopen('csv/users.csv', 'w');
    //   foreach ($users as $user) {
    //     fputcsv($csvFile, $user);
    //   }
    //   fclose($csvFile);
    // }

    // $users = array();
    // $csvFile = fopen('csv/users.csv', 'r');
    // while (!feof($csvFile)) {
    //   $data = fgetcsv($csvFile);
    //   if (empty($data))
    //     break;
    //   array_push($users, $data);
    // }
    // fclose($csvFile);
    // echo json_encode($users);
?>