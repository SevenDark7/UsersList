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
     City VARCHAR(255) NOT NULL, Age INT NOT NULL, Name VARCHAR(255) NOT NULL)";
    if (! $table = mysqli_query($connection, $SQL)) {
      echo "Could not create table " . mysqli_error($connection);
    }
/////////////////////////////////////////////////////////////////////

/////////////////////// Edit User In Table ///////////////////////

    if (isset($_GET['edit'])) {
      $id = (int)$_GET['edit'];
      mysqli_select_db($connection, 'userinfo');
      $stmt = mysqli_prepare($connection,"SELECT * FROM users WHERE ID = ?");
      mysqli_stmt_bind_param($stmt, 'i', $id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($result->num_rows == 0) {
        header('Location: index.php');
        return;
      }
      $user = mysqli_fetch_assoc($result);
    }

/////////////////////////////////////////////////////////////////////

/////////////////////// Insert New User And Edit User To Table ///////////////////////

    if (isset($_POST['userName']) && isset($_POST['userAge']) && isset($_POST['userCity'])) {
      $name = $_POST['userName'];
      $age = (int)$_POST['userAge'];
      $city = $_POST['userCity'];
      if (isset($_GET['edit'])) {
        $id = (int)$_GET['edit'];
        mysqli_select_db($connection, 'userinfo');
        $stmt = mysqli_prepare($connection,"UPDATE users SET City = ?, Age = ?, Name = ? WHERE ID = ?");
        mysqli_stmt_bind_param($stmt, 'sisi', $city, $age, $name, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result->num_rows == 0) {
          header('Location: index.php');
          return;
        }
        if (mysqli_affected_rows($connection)) {
          header('Location: index.php');
        }
      }else {
        mysqli_select_db($connection, 'usersinfo');
        $stmt = mysqli_prepare($connection ,"INSERT INTO users (City, Age, Name) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sis', $city, $age, $name);
        mysqli_stmt_execute($stmt);
      }
    }

/////////////////////////////////////////////////////////////////////
    
/////////////////////// Select Informations From Table ///////////////////////

    $SQL = "SELECT * FROM users";
    $fetchUsers = mysqli_query($connection, $SQL);

/////////////////////////////////////////////////////////////////////

/////////////////////// Delete User In Table ///////////////////////

    if (isset($_GET['delete'])) {
      $id = (int)$_GET['delete'];
      mysqli_select_db($connection, 'userinfo');
      $stmt = mysqli_prepare($connection,"DELETE FROM users WHERE ID = ?");
      mysqli_stmt_bind_param($stmt, 'i', $id);
      mysqli_stmt_execute($stmt);
      header("Location: index.php");
      return;
    }

/////////////////////////////////////////////////////////////////////

/////////////////////// Change Auto Increment Value ///////////////////////

    $usrs = mysqli_query($connection, 'SELECT * FROM users');
    if (mysqli_num_rows($usrs) == 0) {
      mysqli_query($connection, 'ALTER TABLE users AUTO_INCREMENT = 1');
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
      <form class="inputForm" action="index.php<?php if (isset($_GET['edit'])) {echo '?edit=' . $_GET['edit'];}?>" method="post">
        <div class="name">
          <label for="nameLabel">نام و نام خانوادگی</label>
          <input type="text" id="userName" name="userName" value="<?php if (isset($user)) {echo $user['Name'];}?>" autocomplete="off" placeholder="مثال: مهدی عابدی" autofocus> 
        </div>

        <div class="age">
          <label for="ageLabel">سن</label>
          <input type="number" id="userAge" name="userAge" value="<?php if (isset($user)) {echo $user['Age'];}?>" placeholder="مثال: 20">
        </div>
        
        <div class="city">
          <label for="cityLabel">شهر</label>
          <input type="text" id="userCity" name="userCity" value="<?php if (isset($user)) {echo $user['City'];}?>" autocomplete="off" placeholder="مثال: اصفهان">
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
        <?php
        if ($fetchUsers) {
          while ($user = mysqli_fetch_assoc($fetchUsers)) {
            echo "
              <tr>
                <td><a href=index.php?delete=$user[ID]><button type=button class=del>حذف</button></a></td>
                <td><a href=index.php?edit=$user[ID]><button type=button class=edit>ویرایش</button></a></td>
                <td>$user[City]</td>
                <td>$user[Age]</td>
                <td>$user[Name]</td>
              </tr>
            ";
          }
        }
        ?>
      </tbody>
    </table>

    <div class="panel">
      <h3 id="subject"></h3>
      <p id="text"></p>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- <script src="js/ajx.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    
  </body>
</html>
