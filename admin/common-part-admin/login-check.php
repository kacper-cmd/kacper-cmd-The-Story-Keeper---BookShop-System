<?php
//authorization - access control
//check whether the user is logged in or not
//manage other side
if(!isset($_SESSION['user'])){//session is set only if logged is successful//if user sesision is not set 
    //user not logged in
    $_SESSION['no-login-message'] = "<div class='error text-center'>In order to access Admin Managment System, first you have to login in.</div>";
    //redirect to login page
    header('location:'.'login.php');
}
?>