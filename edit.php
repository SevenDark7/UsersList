<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>

    <?php
/////////////////////// Connecting To Database ///////////////////////

    $connection = mysqli_connect('localhost:3306', 'root', '');
    if (!$connection) { 
      echo "Could not connect to the database" . mysqli_connect_error();
    }

/////////////////////////////////////////////////////////////////////

/////////////////////// Select User From Table For Edit ///////////////////////

    if (isset($_GET['edit'])) {
        $id = (int)$_GET['edit'];
        mysqli_select_db($connection, 'usersinfo');
        $stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE ID = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result->num_rows == 0) {
        header('Location: index.php');
        return;
        }
        $user = mysqli_fetch_assoc($result);
        if ($user['Level'] == 1) {
            header('Location: index.php');
            return;
        }
    }

/////////////////////////////////////////////////////////////////////

/////////////////////// Edit User From Database ///////////////////////

    if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['city'])) {
        $name = $_POST['name'];
        $age = (int)$_POST['age'];
        $city = $_POST['city'];
        if (isset($_GET['edit'])) {
          $id = (int)$_GET['edit'];
          mysqli_select_db($connection, 'userinfo');
          $stmt = mysqli_prepare($connection, "UPDATE users SET City = ?, Age = ?, Name = ? WHERE ID = ?");
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
            header('Location: index.php');
            return;
        }
    }

/////////////////////////////////////////////////////////////////////
    ?>

    <section>
        <div class="container">
            <div>
                <img src="images/edtAvatar.png" alt="Avatar">
                <h1>Edit User</h1>
            </div>
            <div>
                <form action="edit.php<?php if (isset($_GET['edit'])) {echo '?edit=' . $_GET['edit'];}?>" id="mainForm" method="post">
                    <div>
                        <fieldset>
                            <legend>Your Name</legend>
                            <input type="text" name="name" id="name" value="<?php if (isset($user)) {echo $user['Name'];}?>" dir="auto" autocomplete="off" placeholder="Example: Mehdi Abedi">
                        </fieldset>
                    </div>
                    <div>
                        <fieldset>
                            <legend>Your Age</legend>
                            <input type="number" name="age" id="age" value="<?php if (isset($user)) {echo $user['Age'];}?>" dir="auto" placeholder="Example: 20">
                        </fieldset>
                    </div>
                    <div>
                        <fieldset>
                            <legend>Your City</legend>
                            <input type="text" name="city" id="city" value="<?php if (isset($user)) {echo $user['City'];}?>" dir="auto" autocomplete="off" placeholder="Example: Isfahan">
                        </fieldset>
                    </div>
                    <div class="row">
                        <button type="button" onclick="checkVal ()">Edit</button>
                        <button type="reset">Reset</button>
                    </div>  
                </form>
            </div>
        </div>
    </section>

    <script>
        function checkVal () {
            let name = document.getElementById("name").value;
            let age = document.getElementById("age").value;
            let city = document.getElementById("city").value;
            if (name.trim().length < 1 || parseInt(age) < 1 || city.trim().length < 1) {
                alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
            }
            else {
                document.getElementById("mainForm").submit();
            }
        }
    </script>
</body>
</html>