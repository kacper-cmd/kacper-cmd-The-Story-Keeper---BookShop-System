<?php include ('common-part-admin/menu.php'); ?>

<?php
function redirect($location) {
    header("Location: $location");
    exit;
}

if(isset($_POST['submit'])){
    //echo "submit clicked";
    $id = $_POST['id'];
    $current_password = mysqli_real_escape_string($conn,$_POST['current_password']);
    $new_password=  $_POST['new_password'];
    $confirm_password= $_POST['confirm_password'];
    //check if the user with ID exists or not
      $sql = "SELECT * FROM adminaccount WHERE id=$id";
      $res = mysqli_query($conn, $sql);
      $verify = false;
      while ($row = mysqli_fetch_assoc($res)) {
        $hash = $row['password'];
        $verify = password_verify($current_password, $hash);
      }
if($res==true && $verify==true)
    {
        $count = mysqli_num_rows($res);
        if($count==1)//only 1 use with id and password match
        {
            //echo "we have user";
            if($new_password==$confirm_password)
            {
                $new_password_hash =  password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $sql2 = "UPDATE adminaccount SET
                    password='$new_password_hash'
                    WHERE id=$id
                ";
                $res2 = mysqli_query($conn, $sql2);
                if($res2==true)//is query ok
                {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";//wyswietla sie na stronie manageAdmin.php
                   // header('location:'.'manageAdmin.php');
                    redirect('manageAdmin.php');
                }
                else
                {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                   // header('location:'.'manageAdmin.php');
                    redirect('manageAdmin.php');
                }
            }
            else
            {
                $_SESSION['pwd-not-match'] = "<div class='error'>New password (with confirm password) did not match.</div>";
                //header('location:'.'manageAdmin.php');
                redirect('manageAdmin.php');
            }
        }
        else
        {
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
          //  header('location:'.'manageAdmin.php');
            redirect('manageAdmin.php');
        }
    }
    else
        {
            $_SESSION['change-pwd'] = "<div class='error'>Current password is invalid.</div>";
          //  header('location:'.'manageAdmin.php');
            redirect('manageAdmin.php');
        }
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php 
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include ('common-part-admin/footer.php'); ?>