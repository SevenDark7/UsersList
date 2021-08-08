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
        $csvFile = file('csv/users.csv');
        $count = count($csvFile);
        $info = [++$count, $_POST['username'], $_POST['userage'], $_POST['usercity']];
        $csvFile = fopen('csv/users.csv', 'a');
        fputcsv($csvFile, $info);
        fclose($csvFile);
        header('location: index.php');
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
                        <input type="text" name="username" placeholder="Your Name" autocomplete="off">
                    </div>  
                    <div> 
                        <i class="material-icons">date_range</i>
                        <input type="number" name="userage" placeholder="Your Age">
                    </div>
                    <div>
                        <i class="material-icons">location_city</i>
                        <input type="text" name="usercity" placeholder="Your City" autocomplete="off">
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