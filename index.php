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

    // $Users = [
    //   [1, 'مهدی عابدی', 20, 'اصفهان'],
    //   [2, 'محمد ایزدی', 32, 'کرمان'],
    //   [3, 'حامد محمدی', 18, 'تهران'],
    //   [4, 'حسین حسینی', 27, 'کاشان'],
    //   [5, 'علی یاسینی', 24, 'شیراز']
    // ];

    /////////// Write User Information In CSV File ///////////

    // if (!file_exists('csv')){
    //   mkdir('csv');
    //   $csvFile = fopen('csv/users.csv', 'w');
    //   foreach ($Users as $user) {
    //     fputcsv($csvFile, $user);
    //   }
    //   fclose($csvFile);
    // }


    /////////// Add Delete And Edit Event Using PHP ///////////

    // if (isset($_GET['line'])) {
    //   $id = $_GET['line'];
    //   if (!function_exists('str_contains')) {
    //     function str_contains($text, $needle) {
    //       return empty($needle) || strpos($text, $needle) !== false;
    //     }
    //   }
    //   if (!str_contains($id, 'e')) {
    //     $remaining = array();
    //     $csvFile = fopen('csv/users.csv', 'r');
    //     while(!feof($csvFile)) {
    //       $row = fgetcsv($csvFile);
    //       if(empty($row))
    //         break;
    //       if (($row[0] != $_GET['line']))
    //         array_push($remaining, $row);
    //     }
    //     fclose($csvFile);
    //     $csvFile = fopen('csv/users.csv', 'w');
    //     foreach($remaining as $item) {
    //       fputcsv($csvFile, $item);
    //     }
    //     fclose($csvFile);
    //     header('Location: index.php');
    //   }
    //   else {
    //     $id = trim($id, 'e');
    //     $csvFile = fopen('csv/users.csv', 'r');
    //     while(!feof($csvFile)) {
    //       $row = fgetcsv($csvFile);
    //       if(empty($row))
    //         break;
    //       if (($row[0] == $id)){
    //         $etRow = $row;
    //         break;
    //       }
    //     }
    //     fclose($csvFile);
    //   }
    // }

    // /////////// Edit User ///////////

    // if (isset($_POST['userName']) && isset($_POST['userAge']) && isset($_POST['userCity'])) {
    //   if (isset($_GET['row'])) {
    //     $id = $_GET['row'];
    //     $edited = [$id, $_POST['userName'], $_POST['userAge'], $_POST['userCity']];
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
    //     header('Location: index.php');
    //   } /////////// Get User Information From Form And Write In CSV File ///////////
    //   else {
    //     $csvFile = file('csv/users.csv');
    //     $count = count($csvFile);
    //     $info = [++$count, $_POST['userName'], $_POST['userAge'], $_POST['userCity']];
    //     $csvFile = fopen('csv/users.csv', 'a');
    //     fputcsv($csvFile, $info);
    //     fclose($csvFile);
    //   }
    // } 

    ?>

    <article>
      <header>
        <h5 class="time"></h5>
        <a href="form.html" target="_blank">صفحه ورود</a>
        <a href="signup.html" target="_blank">صفحه ثبت نام</a>
        <button type="button" id="default">پیشفرض</button>
      </header>
    </article>

    <article class="formContine">
      <form class="inputForm" action="index.php<?php if (isset($etRow)) echo '?row=' . $etRow[0]; ?>" method="post">
        <div class="name">
          <label for="nameLabel">نام و نام خانوادگی</label>
          <input type="text" id="userName" value="<?php if (isset($etRow)) echo $etRow[1]; ?>" autocomplete="off" placeholder="مثال: مهدی عابدی" autofocus> 
        </div>

        <div class="age">
          <label for="ageLabel">سن</label>
          <input type="number" id="userAge" value="<?php if (isset($etRow)) echo $etRow[2]; ?>" placeholder="مثال: 20">
        </div>
        
        <div class="city">
          <label for="cityLabel">شهر</label>
          <input type="text" id="userCity" value="<?php if (isset($etRow)) echo $etRow[3]; ?>" autocomplete="off" placeholder="مثال: اصفهان">
        </div>
    
        <div class="btn">
          <button type="reset" id="reset">انصراف</button>
          <button type="submit" id="register">ثبت</button>
          <!-- <button type="button" id="change">ویرایش</button> -->
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

    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#default').click(function () {
          var url = 'def.php';
          $.ajax(url, {
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
              $('tbody tr').remove();
              data.forEach(function(item) {
                $('tbody').append('<tr>' + '<td>' + "<a href=index.php?line=" + item[0] +"><button type='button' class='del'>حذف</button></a>" + '</td>' +
                '<td>' + "<a href=index.php?line=" + item[0] +"e><button type='button' class='del'>ویرایش</button></a>" + '</td>' +
                '<td>' + item[3] + '</td>' + 
                '<td>' + item[2] + '</td>' + 
                '<td>' + item[1] + '</td>' + '</tr>');
              });
            },
            error: function() {
              alert('Error loading information');
            },
          });
        });

        $("#register").click(function(e) {
          e.preventDefault();
          $.ajax('reg.php', {
            url: 'reg.php',
            type: "POST",
            data: {"userName":$('#userName').val(), "userAge":$('#userAge').val(), "userCity":$('#userCity').val()},
            dataType: "json",
            success: function (data) {
              $('tbody tr').remove();
              data.forEach(function(item, index) {
                $('tbody').append('<tr>' + '<td>' + "<a href=index.php?line=" + item[0] +"><button type='button' class='del'>حذف</button></a>" + '</td>' +
                '<td>' + "<a href=index.php?line=" + item[0] +"e><button type='button' class='del'>ویرایش</button></a>" + '</td>' +
                '<td>' + item[3] + '</td>' + 
                '<td>' + item[2] + '</td>' + 
                '<td>' + item[1] + '</td>' + '</tr>');
              });
              $("#reset").click();
              $('#userName').focus();
            },
            error: function() {
              alert('Error registering user');
            },
          });
        });

        $(document).on('click', '.del', function(e) {
          e.preventDefault();
          var row = $(this).parent().attr('href');
          row = row.split('=');
          var user = {'row':row[1]};
          $.ajax({
            url: 'dlt.php',
            type: 'POST',
            data: user,
            dataType: 'json',
            success: function(data) {
              $('tbody tr').remove();
              data.forEach(function(item) {
                $('tbody').append('<tr>' + '<td>' + "<a href=index.php?line=" + item[0] +"><button type='button' class='del'>حذف</button></a>" + '</td>' +
                '<td>' + "<a href=index.php?line=" + item[0] +"e><button type='button' class='del'>ویرایش</button></a>" + '</td>' +
                '<td>' + item[3] + '</td>' + 
                '<td>' + item[2] + '</td>' + 
                '<td>' + item[1] + '</td>' + '</tr>');
              });
            },
            error: function() {
              alert('Error loading users');
            },
          });
        });

        setInterval(function() {
          var currentTime = new Date();
          var secounds = currentTime.getSeconds();
          var minutes = currentTime.getMinutes();
          var hours = currentTime.getHours();
          secounds = (secounds < 10 ? "0" : "") + secounds;
          minutes = (minutes < 10 ? "0" : "") + minutes;
          hours = (hours < 10 ? "0" : "") + hours;
          var fullTime = hours + " : " + minutes + " : " + secounds;
          $(".time").text(fullTime);
        }, 1000);
      });
    </script>
    <!-- <script src="js/main.js"></script> -->
    
  </body>
</html>
