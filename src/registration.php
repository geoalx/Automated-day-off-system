<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href = "style1.css"/>
</head>
<body>
<a href="root_dashboard.php"><img src = "back.png" width="50" height="50"/></a>
<?php
include("root_auth.php");
require('db.php');
$con = mysqli_connect("localhost","root","","loginsys");
if(isset($_REQUEST["email"])){
    $fname = stripcslashes($_REQUEST["fname"]);
    $fname = mysqli_real_escape_string($con, $fname);
    $lname = stripcslashes($_REQUEST["lname"]);
    $lname = mysqli_real_escape_string($con, $lname);
    $email = stripcslashes($_REQUEST["email"]);
    $email    = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $conpas = stripslashes($_REQUEST['conpass']);
    $auth = $_REQUEST['authority'];
    $fl = 0;
    $q = "SELECT * FROM `users` WHERE email = '$email'";
    $res =mysqli_query($con,$q);
    if(mysqli_num_rows($res)>0) $fl=1;
    if($conpas != $password){
        echo "<div class='form'>
                <h3>Passwords don't match try again <a href='registration.php'>here</a></h3></div>";
    }
    else if($fl){
        echo "<div class='form'>
                <h3>The email is already registered to an account try again <a href='registration.php'>here</a> or go back</h3></div>";
    }
    else{
        if($auth == "root") {
            $create_datetime = date("Y-m-d H:i:s");
            $query = "INSERT into `users` (fname, lname, password, email, create_datetime,AUTH)
                         VALUES ('$fname', '$lname', '" . md5($password) . "', '$email', '$create_datetime', 1)";
            $result = mysqli_query($con, $query);
        }
        else if($auth == "user"){
            $create_datetime = date("Y-m-d H:i:s");
            $query = "INSERT into `users` (fname, lname, password, email, create_datetime,AUTH)
                         VALUES ('$fname', '$lname', '" . md5($password) . "', '$email', '$create_datetime' ,0)";
            $result = mysqli_query($con, $query);
        }
        if($result){
            echo "<div class='form'>
                   <h3>You registered a new $auth.</h3><br/>
                   <p class='link'>Click here to <a href='root_dashboard.php'>go to dashboard</a></p>
                   </div>";
        }
         else{
            echo "<div class='form'>
                     <h3>Required fields are missing.</h3><br/>
                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                    </div>";
        }
    }
}
else{
?>
<form class="form2" action="" method="post">
    <h1 class="login-title">Registration</h1>
    <input type="text" class="login-input" name="fname" placeholder="First Name" required>
    <input type="text" class="login-input" name="lname" placeholder="Last Name" required>
    <input type="text" class="login-input" name="email" placeholder="Email Adress" required>
    <input type="password" class="login-input" name="password" placeholder="Password">
    <input type = "password" class = "login-input" name = "conpass" placeholder = "Confirm Password">
    <select name="authority" style="position: center">
        <option value = "root" style = "text-align: center">administrator</option>
        <option value = "user" style = "text-align: center">employee</option>
    </select>
    <input type="submit" name="submit" value="Register new user" class="login-button">
</form>
<?php
}
?>
</body>
</html>