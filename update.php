<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Update User</title>
    <link rel="stylesheet" href = "style1.css"/>
</head>
<a href="root_dashboard.php"><img src = "back.png" width="50" height="50"/></a>
<?php
include("root_auth.php");
require('db.php');
$id = $_GET['id'];
$q = "SELECT * FROM `users` WHERE id='$id'";
$res = mysqli_query($con,$q);
$x = $res->fetch_assoc();
if(isset($_REQUEST['button'])){
    $fname = stripcslashes($_REQUEST["fname"]);
    $fname = mysqli_real_escape_string($con, $fname);
    $lname = stripcslashes($_REQUEST["lname"]);
    $lname = mysqli_real_escape_string($con, $lname);
    $email = stripcslashes($_REQUEST["email"]);
    $email = mysqli_real_escape_string($con, $email);
    $auth = $_REQUEST['authority'];
    $fl = 0;
    $q = "SELECT * FROM `users` WHERE email = '$email'";
    $res =mysqli_query($con,$q);
    if($x['email']==$email  or mysqli_num_rows($res)==0) $fl=0;
    else $fl=1;
    if($auth == "root"){
        $a = 1;
    }
    else if($auth=="user"){
        $a=0;
    }
    if(!$fl) {
        $q = "UPDATE `users` SET fname='$fname', lname='$lname', email = '$email', AUTH='$a' WHERE id='$id'";
        $res = mysqli_query($con, $q);
        if ($res) {
            header("Location: root_dashboard.php");
        } else {
            echo "<div class='form'>
                     <h3>Something Went Wrong</h3><br/>
                    </div>";
        }
    }
    else{
        echo "<div class='form'>
                <h3>The email is already registered to an account try again <a href='update.php?id=$id'>here</a> or go back</h3></div>";
    }
}
else
{
?>
<form class="form2" action="" method="post">
    <h1 class="login-title">Update User</h1>
    <input type="text" class="login-input" name="fname" value = <?php echo $x['fname']?> required>
    <input type="text" class="login-input" name="lname" value = <?php echo $x['lname']?> required>
    <input type="text" class="login-input" name="email"  value = <?php echo $x['email']?> required>
    <select name="authority" style="position: center">
        <option value = "root" style = "text-align: center" <?php if($x['AUTH']==1) echo "selected"?>>administrator</option>
        <option value = "user" style = "text-align: center" <?php if($x['AUTH']==0) echo "selected"?>>employee</option>
    </select>
    <input type="submit" name="button" value="Update User" class="login-button">
</form>
<?php
}
?>
</body>
</html>
