<?php
session_start();
$profile = $_SESSION['username'];
if($profile == true){

session_unset();
session_destroy();
header('location:http://localhost/wtproj/pages/login.php');
}
else{
    header('location:http://localhost/wtproj/pages/home.php');
}
?>