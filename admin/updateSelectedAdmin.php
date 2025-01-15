<?php include('common-part-admin/menu.php'); ?>

<?php 
function redirect($location) {
    header("Location: $location");
    exit;
}

    if(isset($_POST['submit'])){
        //echo 'submit clicked';
        $id = $_POST['id'];
        $PersonalData = mysqli_real_escape_string($conn, $_POST['PersonalData']);//https://www.php.net/manual/en/mysqli.real-escape-string.php// avoid sql injection attack by escaping special characters in a string for use in an SQL statement
        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $sql = "UPDATE adminaccount SET PersonalData = '$PersonalData', login = '$login' WHERE id=$id";//PersonalData column from database; '$from form value'
        $res = mysqli_query($conn, $sql);
        if($res==TRUE){
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
          // header('location:'.'manageAdmin.php');
            redirect('manageAdmin.php');
        }
        else{
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            //header('location:'.'manageAdmin.php');
            redirect('manageAdmin.php');           
        }
    }
?>
<?php  
          if(isset($_POST['id'])){
          $id = $_POST['id'];
          $sql = "SELECT * FROM adminaccount WHERE id=$id";
          $res = mysqli_query($conn, $sql);
          if($res==TRUE)
          {
              $count = mysqli_num_rows($res); // Function to get all the rows in database
              if($count==1)//1 signle id of 1 admin current
              {
                  // echo "we have admin";
                  $row = mysqli_fetch_assoc($res);//Fetch a result row as an associative array//get all the data from database
                  $PersonalData = $row['PersonalData'];//column name in our database table
                  $login = $row['login'];
              }
              else
              {
                 // header('location:'.'manageAdmin.php');
                    redirect('manageAdmin.php');
                  
              }
          }
      }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="PersonalData" value="<?php echo $PersonalData; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Login: </td>
                    <td>
                        <input type="text" name="login" value="<?php echo $login; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('common-part-admin/footer.php');?>