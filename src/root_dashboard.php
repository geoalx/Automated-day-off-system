<?php
include("root_auth.php");
require("db.php");
$email = $_SESSION['email'];
$q = "SELECT fname,lname FROM `users` WHERE email = '$email'";
$res = mysqli_query($con,$q);
$temp = $res->fetch_assoc();
$fn = $temp['fname'];
$ln = $temp['lname'];
?>
<html>
<title>
   ADMIN DASHBOARD
</title>
<head>
    <link rel = "stylesheet" href="style2.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="DESIGN_FILES/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="DESIGN_FILES/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="DESIGN_FILES/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="DESIGN_FILES/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="DESIGN_FILES/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="DESIGN_FILES/css/util.css">
    <link rel="stylesheet" type="text/css" href="DESIGN_FILES/css/main.css">
</head>
<body>
<h1 style = "font-family: Arial;  color: #55a2ff; text-align: center">You are on administrator dashboard</h1>
<h1 style = "font-family: Arial;  color: #55a2ff; text-align: center">USER : <?php echo $fn . " " .$ln?></h1>
<form action="registration.php" style = "position: absolute;">
    <input type="submit" value="CREATE A USER" class = "mybutton" style="position: relative; width:100%; margin-left:70px">
</form>
<br/><br/>
<h3 style = "font-family: Arial;  color: #55a2ff; text-align: center;">REGISTERED USERS</h3>
<br/>
<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100" style = "position:absolute; top:200px">
            <div class="table100 ver5 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                        <tr class="row100 head">
                            <th class="cell100 column1">ID</th>
                            <th class="cell100 column2">First Name</th>
                            <th class="cell100 column3">Last Name</th>
                            <th class="cell100 column4">email</th>
                            <th class="cell100 column5">Authority</th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                        <?php
                        $q = "SELECT * FROM `users`";
                        $res = mysqli_query($con,$q);
                        while($row = mysqli_fetch_array($res)){
                            if($row['AUTH']==1){
                                $a = "<em style = \"color:red\">ADMIN</em>";
                            }
                            else if($row['AUTH']==0){
                                $a = "<em style = \"color:green\">EMPLOYEE</em>";
                            }
                            $link = "update.php?id=".$row['id'];
                            echo "<tr data-href = $link>
                                <td class = \"cell100 column1\">".$row['id']."</a></td>
                                <td class = \"cell100 column2\">".$row['fname']."</a></td>
                                <td clsss = \"cell100 column3\">".$row['lname']."</a></td>
                                <td class = \"cell100 column4\">".$row['email']."</a></td>
                                <td class = \"cell100 column5\">".$a."</a></td>
                                </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<form action="logout.php" style = "position: relative; margin-top: -25%; left:45%">
    <input type="submit" value="logout" class = "lobu" style = "text-align: center">
</form>
</body>
<!--===============================================================================================-->
<script src="DESIGN_FILES/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="DESIGN_FILES/vendor/bootstrap/js/popper.js"></script>
<script src="DESIGN_FILES/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="DESIGN_FILES/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="DESIGN_FILES/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function(){
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function(){
            ps.update();
        })
    });


</script>
<!--===============================================================================================-->
<script src="DESIGN_FILES/js/main.js"></script>
<script>
    document.addEventListener("DOMContentLoaded",()=>
    {
        const rows = document.querySelectorAll("tr[data-href]");
        rows.forEach(row=>
        {
            row.addEventListener("click",()=>
            {
                window.location.href = row.dataset.href;
            });
        });
    });
</script>
</html>