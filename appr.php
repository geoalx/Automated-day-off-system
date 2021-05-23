<html>
<head>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<?php
require ('db.php');
$id = $_GET['adid'];
$appr = $_GET['acc'];
$q = "UPDATE `adeia` SET ACP='$appr' WHERE ID = '$id'";
$res = mysqli_query($con,$q);
if($res){
    $q = "SELECT CL_ID,DT FROM `adeia` WHERE ID = '$id'";
    $res = mysqli_query($con,$q);
    $ni = $res->fetch_assoc();
    $nid = $ni['CL_ID'];
    $dat = $ni['DT'];
    $q = "SELECT email FROM `users` WHERE ID = '$nid'";
    $res = mysqli_query($con,$q);
    $email = $res->fetch_assoc();
    $email = $email['email'];
    $sub = "request responce";
    if($appr==1){
        $ap = "accepted";
    }
    else if($appr==-1){
        $ap = "rejected";
    }
    $body = "
    <html>
    <body>
    Dear employee, your supervisor has ". $ap ." your application
    submitted on $dat.
</body>
</html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: auto sent email";
    mail($email, $sub, $body, $headers);
    ?>
    <form class = "form">
        <h2>Application No. <?php echo $id ?> is <?php echo $ap ?></h2>
    </form>
    <?php
}
else{
    ?>
    <form class = "form" style = "color: #55a2ff; text-align: center">
        <h2 style = "color: #55a2ff; text-align: center">Something went wrong</h2>
    </form>
<?php
}
?>
</body>
</html>