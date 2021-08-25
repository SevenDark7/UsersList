<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/master.css">
    <title>intro page</title>
  </head>
  <body>

    <?php
    if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['city'])) {
      $name = $_POST['name'];
      $age = (int)$_POST['age'];
      $city = $_POST['city'];
      $connection = mysqli_connect('localhost:3306', 'root', '');
      if (!$connection) {
        echo "Could not connect to the database" . mysqli_connect_error();
      }
      mysqli_select_db($connection, 'usersinfo');
      $flag = false;
      $users = mysqli_query($connection, 'SELECT * FROM users');
      if ($users) {
        while ($user = mysqli_fetch_assoc($users)) {
          if ($user['Name'] == $name && $user['Age'] == $age && $user['City'] == $city) {
            $flag = true;
          }
        }
      }
      if ($flag == true) {
        ?>
        <script>alert("خوش آمدید");</script>
        <?php
        header('location: index.php');
        return;
      }
      else {
        ?>
        <script>alert("کاربری با این مشخصات یافت نشد");</script>
        <?php
      }
    }
    ?>

    <form action="login.php" method="post" id="loginForm">
      <div class="image">
        <img src="images/avatar.png" alt="Avatar Image">
      </div>
      <fieldset>
        <legend>Login</legend>
        <div>
          <table>
            <tr>
              <td><label for="username">Username: </label></td>
              <td><input type="text" name="name" autocomplete="off" autofocus></td>
            </tr>
            <tr>
              <td><label for="age"></label>Age: </td>
              <td><input type="number" name="age"></td>
            </tr>
            <tr>
              <td><label for="city">city: </label></td>
              <td><input type="text" name="city" autocomplete="off"></td>
            </tr>
          </table>
        </div>
        <div class="login">
          <label class="chkBox">
            <input type="checkbox" checked="checked"> Remember me
          </label>
          <input type="submit" class="loginbtn" value="Login">
        </div>

        <div class="foot">
          <button type="reset" class="cancel" name="cancel">Cancel</button>
          <span class="psw">Forgot <a href="#">Account Name?</a> </span>
        </div>
      </fieldset>
    </form>

  </body>
</html>