<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Project2</title>
  </head>
  <body>
    
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
          <input type="text" id="userName" name="userName" autocomplete="off" placeholder="مثال: مهدی عابدی" autofocus> 
        </div>

        <div class="age">
          <label for="ageLabel">سن</label>
          <input type="number" id="userAge" name="userAge" placeholder="مثال: 20">
        </div>
        
        <div class="city">
          <label for="cityLabel">شهر</label>
          <input type="text" id="userCity" name="userCity" autocomplete="off" placeholder="مثال: اصفهان">
        </div>
    
        <div class="btn">
          <button type="reset" id="reset">انصراف</button>
          <button type="submit" id="register">ثبت</button>
          <button type="button" id="change">ویرایش</button>
        </div>
      </form>
    </article>

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

      /////////// Get User Information From Form And Write In CSV File ///////////

      if (isset($_POST['userName']) && isset($_POST['userAge']) && isset($_POST['userCity'])) {
        $csvFile = file('csv/users.csv');
        $count = count($csvFile);
        $info = [++$count, $_POST['userName'], $_POST['userAge'], $_POST['userCity']];
        $csvFile = fopen('csv/users.csv', 'a');
        fputcsv($csvFile, $info);
        fclose($csvFile);
      }
    ?>
    
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
              <td><button type='button' class='edit'>ویرایش</button></td>
              <td>$data[3]</td>
              <td>$data[2]</td>
              <td>$data[1]</td>
            </tr>
          ";
        }
        if (isset($_GET['line'])) {
          $remaining = array();
          $csvFile = fopen('csv/users.csv', 'r');
          while(!feof($csvFile)) {
            $row = fgetcsv($csvFile);
            if(empty($row))
              break;
            elseif (($row[0] != $_GET['line']))
              array_push($remaining, $row);
          }
          fclose($csvFile);
          $csvFile = fopen('csv/users.csv', 'w');
          foreach($remaining as $item) {
            fputcsv($csvFile, $item);
          }
          fclose($csvFile);
          header("Refresh:0; url=index.php");
        } 
        ?>

      </tbody>
    </table>

    <!-- <script src="js/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    
  </body>
</html>
