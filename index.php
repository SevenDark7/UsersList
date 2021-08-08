<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Project2</title>
  </head>
  <body>

    <?php

    $Users = [
      [1, 'مهدی عابدی', 20, 'اصفهان'],
      [2, 'محمد ایزدی', 32, 'کرمان'],
      [3, 'حامد محمدی', 18, 'تهران'],
      [4, 'حسین حسینی', 27, 'کاشان'],
      [5, 'علی یاسینی', 24, 'شیراز']
    ];

    /////////// Write User Information In CSV File ///////////

    if (!file_exists('csv')){
      mkdir('csv');
      $csvFile = fopen('csv/users.csv', 'w');
      foreach ($Users as $user) {
        fputcsv($csvFile, $user);
      }
      fclose($csvFile);
    }

    /////////// Add Delete And Edit Event Using PHP ///////////

    if (isset($_GET['line'])) {
      $id = $_GET['line'];
      if (!str_contains($id, 'e')) {
        $remaining = array();
        $csvFile = fopen('csv/users.csv', 'r');
        while(!feof($csvFile)) {
          $row = fgetcsv($csvFile);
          if(empty($row))
            break;
          if (($row[0] != $_GET['line']))
            array_push($remaining, $row);
        }
        fclose($csvFile);
        $csvFile = fopen('csv/users.csv', 'w');
        foreach($remaining as $item) {
          fputcsv($csvFile, $item);
        }
        fclose($csvFile);
        header('Location: index.php');
      }
      else {
        $id = trim($id, 'e');
        $csvFile = fopen('csv/users.csv', 'r');
        while(!feof($csvFile)) {
          $row = fgetcsv($csvFile);
          if(empty($row))
            break;
          if (($row[0] == $id)){
            $etRow = $row;
            break;
          }
        }
        fclose($csvFile);
      }
    }

    // if (isset($etRow)) {
    //   echo 'Yes';
    //   if (isset($_POST['userName']) && isset($_POST['userAge']) && isset($_POST['userCity'])) {
    //     $edited = [$etRow[0], $_POST['userName'], $_POST['userAge'], $_POST['userCity']];
    //     $remaining = array();
    //     $csvFile = fopen('csv/users.csv', 'r');
    //     while (!feof($csvFile)) {
    //       $line = fgetcsv($csvFile);
    //       if (empty($line))
    //         break;
    //       elseif (($line[0] == $edited[0])) 
    //         array_push($remaining, $edited);   
    //       else 
    //         array_push($remaining, $line);
    //     }
    //     fclose($csvFile);
    //     $csvFile = fopen('csv/users.csv', 'w');
    //     foreach($remaining as $users) {
    //       fputcsv($csvFile, $users);
    //     }
    //     fclose($csvFile);
    //   }
    // } else {
    //   if (isset($_POST['userName']) && isset($_POST['userAge']) && isset($_POST['userCity'])) {
    //     echo 'No';
    //     $csvFile = file('csv/users.csv');
    //     $count = count($csvFile);
    //     $info = [++$count, $_POST['userName'], $_POST['userAge'], $_POST['userCity']];
    //     $csvFile = fopen('csv/users.csv', 'a');
    //     fputcsv($csvFile, $info);
    //     fclose($csvFile);
    //   }
    // }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_POST['userName']) && isset($_POST['userAge']) && isset($_POST['userCity'])) {
      if (isset($_GET['line'])) {
        echo 'yes';
        $id = trim($_GET['line'], 'e');
        $edited = [$id, $_POST['userName'], $_POST['userAge'], $_POST['userCity']];
        $remaining = array();
        $csvFile = fopen('csv/users.csv', 'r');
        while (!feof($csvFile)) {
          $line = fgetcsv($csvFile);
          if (empty($line))
            break;
          elseif (($line[0] == $edited[0])) 
            array_push($remaining, $edited);   
          else 
            array_push($remaining, $line);
        }
        fclose($csvFile);
        $csvFile = fopen('csv/users.csv', 'w');
        foreach($remaining as $users) {
          fputcsv($csvFile, $users);
        }
        fclose($csvFile);
      }
      else {
        echo "No";
        $csvFile = file('csv/users.csv');
        $count = count($csvFile);
        $info = [++$count, $_POST['userName'], $_POST['userAge'], $_POST['userCity']];
        $csvFile = fopen('csv/users.csv', 'a');
        fputcsv($csvFile, $info);
        fclose($csvFile);
      }
    } 
    /////////// Get User Information From Form And Write In CSV File ///////////
    ?>
    
    <article>
      <header>
        <h5 class="time"></h5>
        <a href="form.html" target="_blank">صفحه ورود</a>
        <a href="signup.html" target="_blank">صفحه ثبت نام</a>
      </header>
    </article>

    <article class="formContine">
      <form class="inputForm" action="index.php" method="post">
        <div class="name">
          <label for="nameLabel">نام و نام خانوادگی</label>
          <input type="text" id="userName" name="userName" value="<?php if (isset($etRow)) echo $etRow[1]; ?>" autocomplete="off" placeholder="مثال: مهدی عابدی" autofocus> 
        </div>

        <div class="age">
          <label for="ageLabel">سن</label>
          <input type="number" id="userAge" name="userAge" value="<?php if (isset($etRow)) echo $etRow[2]; ?>" placeholder="مثال: 20">
        </div>
        
        <div class="city">
          <label for="cityLabel">شهر</label>
          <input type="text" id="userCity" name="userCity" value="<?php if (isset($etRow)) echo $etRow[3]; ?>" autocomplete="off" placeholder="مثال: اصفهان">
        </div>
    
        <div class="btn">
          <button type="reset" id="reset">انصراف</button>
          <button type="submit" id="register">ثبت</button>
          <button type="button" id="change">ویرایش</button>
        </div>
      </form>
    </article>
    
    <table class="user">
      <thead>
        <tr>
          <th>حذف</th>
          <th>ویرایش</th>
          <th>شهر</th>
          <th>سن</th>
          <th>نام و نام خانوادگی</th>
        </tr>
      </thead>
      <tbody class="users">

        <?php
        $csvFile = fopen('csv/users.csv', 'r');
        while(!feof($csvFile)) {
          $data = fgetcsv($csvFile);
          if(empty($data)){
            fclose($csvFile);
            break;
          }
          echo "
            <tr>
              <td><a href='index.php?line=$data[0]'><button type='button' class='del'>حذف</button></a></td>
              <td><a href='index.php?line=$data[0]e'><button type='button' class='edit'>ویرایش</button></a></td>
              <td>$data[3]</td>
              <td>$data[2]</td>
              <td>$data[1]</td>
            </tr>
          ";
        }
        ?>

      </tbody>
    </table>

    <!-- <script src="js/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    
  </body>
</html>
