<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Project2</title>
    <script src="js/jquery-3.6.0.min.js"></script>
  </head>
  <body>

    <?php

/////////////////////// Connecting To Database ///////////////////////

    $connection = mysqli_connect('localhost:3306', 'root', '');
    if (!$connection) { 
      echo "Could not connect to the database" . mysqli_connect_error();
    }
/////////////////////////////////////////////////////////////////////

/////////////////////// Create Database And Table ///////////////////////

    $dataBase = mysqli_query($connection, 'CREATE DATABASE IF NOT EXISTS usersinfo');
    if (!$dataBase) {
      echo "Could not create database " . mysqli_error($connection);
    }
    mysqli_select_db($connection, 'usersinfo');
    $SQL = "CREATE TABLE IF NOT EXISTS users (ID INT AUTO_INCREMENT PRIMARY KEY,
     Name VARCHAR(255) NOT NULL, Age INT NOT NULL, City VARCHAR(255) NOT NULL)";
    if (! $table = mysqli_query($connection, $SQL)) {
      echo "Could not create table " . mysqli_error($connection);
    }
/////////////////////////////////////////////////////////////////////
    ?>


    <article>
      <header>
        <h5 class="time"></h5>
        <a href="login.php" target="_blank">صفحه ورود</a>
        <a href="signup.php" target="_blank">صفحه ثبت نام</a>
        <button type="button" id="default">پیشفرض</button>
      </header>
    </article>

    <article class="formContine">
      <form class="inputForm" action="index.php" method="post">
        <div class="name">
          <label for="nameLabel">نام و نام خانوادگی</label>
          <input type="text" id="userName" autocomplete="off" placeholder="مثال: مهدی عابدی" autofocus> 
        </div>

        <div class="age">
          <label for="ageLabel">سن</label>
          <input type="number" id="userAge" placeholder="مثال: 20">
        </div>
        
        <div class="city">
          <label for="cityLabel">شهر</label>
          <input type="text" id="userCity" autocomplete="off" placeholder="مثال: اصفهان">
        </div>
    
        <div class="btn">
          <button type="reset" id="reset">انصراف</button>
          <button type="submit" id="register">ثبت</button>
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
      </tbody>
    </table>

    <div class="panel">
      <h3 id="subject"></h3>
      <p id="text"></p>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/ajx.js"></script>
    <!-- <script src="js/main.js"></script> -->
    
  </body>
</html>
