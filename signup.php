<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sign.css">
    <link rel="stylesheet" href="fonts/icon.css">
    <title>Signup</title>
</head>
<body>

    <?php
    if (isset($_POST['username']) && isset($_POST['userage']) && isset($_POST['usercity'])) {
        $name = $_POST['username'];
        $age = (int)$_POST['userage'];
        $city = $_POST['usercity'];
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
        if ($flag == false) {
            $stmt = mysqli_prepare($connection, 'INSERT INTO users (Name, Age, City) VALUES (?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'sis', $name, $age, $city);
            mysqli_stmt_execute($stmt);
            header('location: index.php');
            return;
        }
        else {
            ?>
            <script>alert("کاربری با این مشخصات یافت شد");</script>
            <?php
        }
    }
    ?>

    <section class="body">
        <article class="first">
            <main>
                <img src="images/signup.png" alt="Avatar Image">
            </main>
            <aside>
                <h2>Sign up</h2>
                <form action="signup.php" method="post" id="signup">
                    <div>
                        <i class="material-icons">person</i>
                        <input type="text" name="username" dir="auto" placeholder="Your Name" autocomplete="off">
                    </div>  
                    <div> 
                        <i class="material-icons">date_range</i>
                        <input type="number" name="userage" dir="auto" placeholder="Your Age">
                    </div>
                    <div>
                        <i class="material-icons">location_city</i>
                        <input type="text" name="usercity" dir="auto" placeholder="Your City" autocomplete="off">
                    </div>
                    <div>
                        <input type="checkbox" checked="checked">
                        <label for="chkbox">I agree all statements in terms of service</label>
                    </div>
                </form>
            </aside>
        </article>
        <article class="secound">
            <h4>Have already an account? <a href="login.php">Login here</a></h4>
            <button type="submit" form="signup">Register</button>
        </article>
    </section>

</body>
</html>