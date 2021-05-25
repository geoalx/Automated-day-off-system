<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style1.css"/>
</head>
<body>
<?php
require('db.php');
session_start();
// When form submitted, check and create user session.
if (isset($_POST['email'])) {
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    // Check user is exist in the database
    $query    = "SELECT * FROM `users` WHERE email='$email'
                     AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['email'] = $email;
        // Redirect to user dashboard page
        $x = "SELECT AUTH FROM `users` WHERE email = '$email'";
        $res = mysqli_query($con,$x);
        $ro = $res->fetch_assoc();
        if($ro['AUTH']==0) {
            $_SESSION["AUTH"] = 0;
            header("Location: dashboard.php");
        }
        else if($ro['AUTH']==1) {
            $_SESSION["AUTH"] = 1;
            header("Location: root_dashboard.php");
        }
        else{
            echo "<div class='form'>
                  <h3>Something Went Wrong</h3><br/>
                  <p class='link'>If you think this is a problem contact your supervisor and login again <a href='login.php'>here</a></p>
                  </div>";
        }
    }
    else {
        echo "<div class='form'>
                  <h3>Incorrect email/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
    }
} else {
    ?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="email" placeholder="email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
    </form>

    <?php
}
?>
</body>
</html>
