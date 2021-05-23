<?php
session_start();
if(!isset($_SESSION["email"]) or $_SESSION['AUTH']==0){
    header("Location: login.php");
    exit();
}
