<?php
//include constants.php file here i have the connection to the database
include('../config/connection.php');

function redirect($location) {
    header("Location: $location");
    exit;
}

//get the id of admin to be deleted
$id = $_POST['id'];
$sql = "DELETE FROM adminaccount WHERE id=$id";
$res = mysqli_query($conn, $sql);
//redirect to  manageAdmin.php  with message check whether the query executed or not and display message
if($res==TRUE)
{
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";//i will see this message in home page manage admin
   // header('location:'.'manageAdmin.php');
    redirect('manageAdmin.php'); 
    
}
else
{
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later.</div>";//failure
   // header('location:'.'manageAdmin.php');  
    redirect('manageAdmin.php'); 
}

?>