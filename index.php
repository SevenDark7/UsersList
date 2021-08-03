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
      <form class="inputForm" action="#">
        <div class="name">
          <label for="nameLabel">نام و نام خانوادگی</label>
          <input type="text" id="userName" placeholder="مثال: مهدی عابدی" autofocus> 
        </div>

        <div class="age">
          <label for="ageLabel">سن</label>
          <input type="number" id="userAge" placeholder="مثال: 20">
        </div>
        
        <div class="city">
          <label for="cityLabel">شهر</label>
          <input type="text" id="userCity" placeholder="مثال: اصفهان">
        </div>
        
        <div class="btn">
          <button type="reset" id="reset">انصراف</button>
          <button type="button" id="register">ثبت</button>
          <button type="button" id="change">ویرایش</button>
        </div>
      </form>
    </article>

    <?php 
      $Users = array( ['مهدی عابدی', 20, 'اصفهان'],
                      ['حسین مرادی', 37, 'تهران'],
                      ['محمد یاسینی', 24, 'یاسوج'],
                      ['علی فتحی', 18, 'گرگان'],
                      ['حامد میرعلائی', 27, 'کاشان'],
                      ['محسن امینی', 43, 'کرمان']
                    );
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
        <!-- Read User Information From The Array -->
      <?php
      foreach($Users as $user) {
        echo "
          <tr>
            <td><button type='button' class='del'>حذف</button></td>
            <td><button type='button' class='edit'>ویرایش</button></td>
            <td>{$user[2]}</td>
            <td>{$user[1]}</td>
            <td>{$user[0]}</td>
          </tr>";
      }
      ?>
      </tbody>
    </table>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
    
  </body>
</html>
