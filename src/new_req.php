<html>
<title>
    new request
</title>
<head>
    <link rel = "stylesheet" href="style1.css"/>
</head>
<body>
<a href="dashboard.php"><img src = "back.png" width="50" height="50"/></a>
<?php
include("auth_session.php");
require ('db.php');
$email = $_SESSION['email'];
$q1 = "SELECT id,fname,lname FROM `users` WHERE email= '$email'";
$res = mysqli_query($con,$q1);
$x = $res->fetch_assoc();
$fn = $x['fname'];
$ln = $x['lname'];
$fla = 1;
if(isset($_POST["set"])) {
    $sdate = $_REQUEST['start_date'];
    $edate = $_REQUEST['end_date'];
    $rea = $_REQUEST['reason'];
    $f = $x['id'];
    $dt = date("Y-m-d H:i:s");

    if ($sdate > $edate) {
        echo "<div class='form'>
<h3>start date cannot be later than end date</h3>
<br>
<p>Click <a href='new_req.php'>here</a>to try again or <a href='dashboard.php' >return to dashboard</a> </p>
</div>";
        $fla = 0;
    }
    if ($fla) {
        $query = "INSERT INTO `adeia` (ST_DATE,E_DATE,REA,DT,CL_ID)
            VALUES ('$sdate','$edate','$rea','$dt','$f')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
<h3>Date set successful and waiting for evaluation</h3>
<br>
<p>Click <a href='dashboard.php'>here</a> to return to dashboard</p>
</div>";
            $dir = "http://localhost/phpmyadmin/tes"; //replace it with your hosting address if needed
            $q = "SELECT ID FROM `adeia` WHERE DT = '$dt'";
            $res = mysqli_query($con, $q);
            $x = $res->fetch_assoc();
            $x = $x['ID'];
            $to = "ageorge884@gmail.com";
            $sub = "Confirmation email";
            $body = "<html><body><p>Dear supervisor, employee $fn $ln requested for some time off, starting on
        $sdate and ending on $edate, stating the reason:
        $rea
        Click on one of the below links to approve or reject the application:
        <a href=" . "$dir/appr.php?adid=$x&acc=1" . ">APPROVE</a> - <a href = " . "$dir/appr.php?adid=$x&acc=-1" . ">REJECT</a></p></body></html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: auto sent email";
            mail($to, $sub, $body, $headers);
        } else {
            echo "<div class='form'>
<h3>Something went wrong</h3>
<br>
<p>Click <a href='new_req.php.php'> here</a> to try again or <a href='dashboard.php' >return to dashboard</a> </p>
</div>";
        }
    }
}
else{
?>
<h1 style="text-align: center">NEW REQUEST FORM</h1>
<h2 style = "text-align: center">User: <?php echo $fn." ".$ln ?> </h2>
<br>
<h3 style="text-align: center">PICK AN AVAILABLE DATE</h3>
<br>
<form method="post" class = "form" style = "text-align: center; margin: 50px auto">
    <h3 style = "font-size: 80%">Start Date</h3>
    <input type = "date" style="margin:  auto" name ="start_date">
    <br><br>
    <h3 style = "font-size: 80%">End Date</h3>
    <input type = "date" style = "margin:  auto" name = "end_date" >
    <br><br>
    <h3 style = "font-size: 80%">Reason</h3>
    <input type = "text" style = "margin: auto" name = "reason" placeholder="Reason">
    <br><br>
    <input type = "submit" name ="set" value = "set date" class = "login-button">
</form>
<?php
}
?>
</body>
</html>
