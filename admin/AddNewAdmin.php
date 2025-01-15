<?php include ('common-part-admin/menu.php'); ?>

<?php
function redirect($location) {
    header("Location: $location");
    exit;
}

//i will process the value from form and save it in database
//if btn is clicked - check
if(isset($_POST['submit']))
{
    // get data
    $personalData = mysqli_real_escape_string($conn, $_POST['name']);//from form name attribute
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $plaintext_password = mysqli_real_escape_string($conn, $_POST['password']); //https://www.geeksforgeeks.org/how-to-encrypt-and-decrypt-passwords-using-php/
    $hash = password_hash($plaintext_password, 
          PASSWORD_DEFAULT);
    //SQL query to save the data into database
    //Create a SQL query to save data into database
    $sql = "INSERT INTO adminaccount SET
        PersonalData = '$personalData',
        login = '$login',
        password = '$hash'
    ";
//from constants.php connection
    //Execute the query and save in database
    $res = mysqli_query($conn, $sql) or die("Query failed");
     //check whether the query is executed data is  is inserted or not and display appropriate message
     if($res==TRUE)
     {
         $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";//SESSION is a global variable work in pages Create a session variable to display message
        // header("location:".'manageAdmin.php');//go to in my case this url: http://localhost/bookshop/admin/manageAdmin.php
        redirect('manageAdmin.php');
     }
     else
     {
         $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
         //header("location:".'AddNewAdmin.php');
            redirect('AddNewAdmin.php');
     }
}
 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add'])) //Checking whether the session is set or not
            {
                echo $_SESSION['add']; //Displaying the session message
                unset($_SESSION['add']); //Removing session message
            }
        ?>
        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="Name">
                    </td>
                </tr>
                <tr>
                    <td>Login: </td>
                    <td>
                        <input type="text" name="login" placeholder="Login">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include ('common-part-admin/footer.php'); ?>
