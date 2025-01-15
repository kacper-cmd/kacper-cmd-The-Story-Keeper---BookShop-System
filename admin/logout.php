<?php 
//include constants.php file for site url
include('../config/connection.php');//session_start();

unset($_SESSION["user"]);
//if i want to delete cookie i need to set time to the past
//setcookie('member_login',$_POST['username'],time() -1);
//setcookie('member_password',$_POST['password'],time() -1);
//destroy session 
session_destroy();//unsets $_SESSION['user']
// redirect to login page
header('location:'.'login.php');//or  redirect("login.php");
?>