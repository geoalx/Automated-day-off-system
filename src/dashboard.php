<?php
include("auth_session.php");
require("db.php");
$email = $_SESSION['email'];
$q = "SELECT fname,lname FROM `users` WHERE email = '$email'";
$res = mysqli_query($con,$q);
$temp = $res->fetch_assoc();
$fn = $temp['fname'];
$ln = $temp['lname'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style2.css" />
</head>
<body>
<h1>USER: <?php echo $fn . " " .$ln; ?></h1>
<p style = "text-align: center">You are now on your dashboard page. If you want to make a new request please click the button "submit request"</p>
    <div class = "tab">
        <form action="new_req.php">
            <input type="submit" value="submit request" class="mybutton"/>
        </form>
        <h1 style = "text-align: center">Previous requests</h1>
        <table width = 80% style = "margin-left: 80px">
            <tr>
                <th>Date Submitted</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Days Requested</th>
                <th>Status</th>
            </tr>
        <?php
        $email = $_SESSION['email'];
        $q = "SELECT id FROM `users` WHERE email = '$email'";
        $res = mysqli_query($con,$q);
        $x = $res->fetch_assoc();
        $id = $x['id'];
        $q = "SELECT * FROM `adeia` WHERE CL_ID = '$id' ORDER BY DT DESC";
        $res = mysqli_query($con,$q);
        while($row = mysqli_fetch_array($res)){
            $f = (strtotime($row['E_DATE'])-strtotime($row['ST_DATE']))/60/60/24;
            if($row['ACP'] == 0){
                $acp = "PENDING";
                $color = "orange";
            }
            else if($row['ACP'] == 1){
                $acp = "ACCEPTED";
                $color = "green";
            }
            else if($row['ACP'] == -1){
                $acp = "DENIED";
                $color = "red";
            }
            echo "<tr>
                    <th>".$row['DT']."</th>
                    <th>".$row['ST_DATE']."</th>
                    <th>".$row['E_DATE']."</th>
                    <th>".$f."</th>
                    <th style='color: $color'>".$acp."</th>
                   </tr>";
        }
        ?>
        </table>
        <br><br>
        <br><br>
        <form action = "logout.php">
            <input type="submit" class = "lobu" value = "Logout"/>
        </form>
    </div>
</body>
</html>