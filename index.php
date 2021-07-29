<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Project2</title>
  </head>
  <body>
    
    <article>
      <header>
        <h5><?php echo date("l, M d, Y") ?></h5>
        <a href="form.html" target="_blank">پروژه فرم</a>
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
      $Users = [['مهدی عابدی', 20, 'اصفهان'], ['حسین مرادی', 37, 'تهران'], ['محمد یاسینی', 24, 'یاسوج'], ['علی فتحی', 18, 'گرگان'], ['حامد میرعلائی', 27, 'کاشان']];
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
        <tr>
          <td><button type="button" class="del">حذف</button></td>
          <td><button type="button" class="edit">ویرایش</button></td>
          <td><?php echo $Users[0][2] ?></td>
          <td><?php echo $Users[0][1] ?></td>
          <td><?php echo $Users[0][0] ?></td>
        </tr>
        <tr>
          <td><button type="button" class="del">حذف</button></td>
          <td><button type="button" class="edit">ویرایش</button></td>
          <td><?php echo $Users[1][2] ?></td>
          <td><?php echo $Users[1][1] ?></td>
          <td><?php echo $Users[1][0] ?></td>
        </tr>
        <tr>
          <td><button type="button" class="del">حذف</button></td>
          <td><button type="button" class="edit">ویرایش</button></td>
          <td><?php echo $Users[2][2] ?></td>
          <td><?php echo $Users[2][1] ?></td>
          <td><?php echo $Users[2][0] ?></td>
        </tr>
        <tr>
          <td><button type="button" class="del">حذف</button></td>
          <td><button type="button" class="edit">ویرایش</button></td>
          <td><?php echo $Users[3][2] ?></td>
          <td><?php echo $Users[3][1] ?></td>
          <td><?php echo $Users[3][0] ?></td>
        </tr>
        <tr>
          <td><button type="button" class="del">حذف</button></td>
          <td><button type="button" class="edit">ویرایش</button></td>
          <td><?php echo $Users[4][2] ?></td>
          <td><?php echo $Users[4][1] ?></td>
          <td><?php echo $Users[4][0] ?></td>
        </tr>
      </tbody>
    </table>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- <script>
      $(document).ready(function() {
        $("#change").hide();
        $("#register").click(function() {
          var username = $("#userName").val();
          var userage = $("#userAge").val();
          var usercity = $("#userCity").val();
          if (username.trim().length < 1 || userage.trim().length < 1 || parseInt(userage) < 1 || usercity.trim().length < 1) {
            alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
          }else {
            var userRow = $("<tr></tr>").prependTo(".users");
            var deleteData = $("<td></td>").appendTo(userRow);
            $("<button></button>").addClass("del").attr("type", "button").text("حذف").appendTo(deleteData);
            var editData = $("<td></td>").appendTo(userRow);
            $("<button></button>").addClass("edit").attr("type", "button").text("ویرایش").appendTo(editData);
            $("<td></td>").text(usercity).appendTo(userRow);
            $("<td></td>").text(userage).appendTo(userRow);
            $("<td></td>").text(username).appendTo(userRow);
            $("#reset").click();
          }
        });

        $(document).on('click', '.del', function() {
          $(this).parents('tr').remove();
        });

        let editRow;
        let usercity;
        let userage;
        let username;

        $(document).on('click', '.edit', function() {
          $("#register").hide();
          $("#change").show();
          editRow = $(this).parent().parent();
          usercity = editRow.children("td:nth-child(3)");
          userage = editRow.children("td:nth-child(4)");
          username = editRow.children("td:nth-child(5)");
          $("#reset").click();
          $("#userName").val(username.text());
          $("#userAge").val(userage.text());
          $("#userCity").val(usercity.text());
        });
        
        $("#change").click(function() {
          if ($("#userCity").val().trim().length < 1 || $("#userAge").val().trim().length < 1 || parseInt($("#userAge").val()) < 1 || $("#userName").val().trim().length < 1) {
            alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
          }else {
            usercity.text($("#userCity").val());
            userage.text($("#userAge").val());
            username.text($("#userName").val());
            $("#reset").click();
            $("#change").hide();
            $("#register").show();
          }
        });

      });
    </script> -->

    <script>
      document.getElementById('change').hidden = true;
      document.querySelector('#register').addEventListener('click', function() {
        let username = document.getElementById('userName').value;
        let userage = document.getElementById('userAge').value;
        let usercity = document.getElementById('userCity').value;
        if (username.trim().length < 1 || parseInt(userage) < 1 || usercity.trim().length < 1) {
          alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
        }else {
          //////////// Create Row For New User ////////////
          var row = document.createElement('tr');
          document.querySelector('.users').prepend(row);

          //////////// Create Button For Delete User ////////////
          var dltCell = document.createElement('td');
          row.appendChild(dltCell);
          var dltBtn = document.createElement('button');
          dltBtn.type = 'button';
          dltBtn.className = 'del';
          dltBtn.innerHTML = 'حذف';
          dltCell.appendChild(dltBtn);

          //////////// Create Button For Edit User ////////////
          var edtCell = document.createElement('td');
          row.appendChild(edtCell);
          var edtBtn = document.createElement('button');
          edtBtn.type = 'button';
          edtBtn.className = 'edit';
          edtBtn.innerHTML = 'ویرایش';
          edtCell.appendChild(edtBtn);

          //////////// Create Cell For User City ////////////
          var cityCell = document.createElement('td');
          cityCell.innerHTML = usercity;
          row.appendChild(cityCell);

          //////////// Create Cell For User Age ////////////
          var ageCell = document.createElement('td');
          ageCell.innerHTML = userage;
          row.appendChild(ageCell);

          //////////// Create Cell For User Name ////////////
          var nameCell = document.createElement('td');
          nameCell.innerHTML = username;
          row.appendChild(nameCell);

          //////////// Clear Form Inputs ////////////
          document.getElementById('reset').click();
        }
      });
      
      //////////// Create Delete Button Event ////////////
      $(document).on('click', '.del', function() {
        $(this).parents('tr').remove();
      });

      //////////// Create Edit Button Event ////////////
      let childs;
      let usercity;
      let userage;
      let username;

      $(document).on('click', '.edit', function() {
        document.getElementById('register').hidden = true;
        document.getElementById('change').hidden = false;
        childs = $(this).parents('tr');
        usercity = childs.children("td:nth-child(3)");
        userage = childs.children("td:nth-child(4)");
        username = childs.children("td:nth-child(5)");
        document.getElementById('reset').click();
        document.getElementById('userName').value = username.text();
        document.getElementById('userAge').value = userage.text();
        document.getElementById('userCity').value = usercity.text();
      });

      //////////// Create Change Button Event ////////////
      document.getElementById('change').addEventListener('click', function() {
        city = document.getElementById('userCity').value;
        age = document.getElementById('userAge').value;
        name = document.getElementById('userName').value;
        if (city.trim().length < 1 || parseInt(age) < 1 || name.trim().length < 1) {
          alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
        } else {
          usercity.text(city)
          userage.text(age);
          username.text(name);
          document.getElementById('reset').click();
          document.getElementById('change').hidden = true;
          document.getElementById('register').hidden = false;
        }
      });

      // document.getElementById('reset').addEventListener('click', function () {
      //   if (document.getElementById('register').hidden == true) {
      //     document.getElementById('change').hidden = true;
      //     document.getElementById('register').hidden = false;
      //   }
        
      // })
      
    </script>
   
  </body>
</html>
