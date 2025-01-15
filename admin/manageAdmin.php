<?php include('common-part-admin/menu.php');?>
<style>
    .input-side-by-side {
    width: 25%; 
    display: inline-block;
    margin: 0 auto;/* https://developer.mozilla.org/en-US/docs/Web/CSS/margin */
  }
</style>


     <div class="main-content">
         <div class="wrapper">
            <h1 class="text-center">Manage Admin</h1>
            <br>
            <?php
                if(isset($_SESSION['add']))//sprawdz czy jest ustawiona zmienna sesyjna add
                {
                    echo $_SESSION['add'];//wyswietl zmienna sesyjna add//display one time only then remove it
                    unset($_SESSION['add']);//usun zmienna sesyjna add
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>
            <br> <br><br>
            <!-- Button to add admin -->
            <a href="AddNewAdmin.php" class="btn-primary"><img src="../images/add.png"/></img>Add Admin</a>
            <br><br>
            <br><br>
           <table class="tbl-full">
            <tr>
                <th>ID number</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
                //create sql query to get all admin
                $sql = "SELECT * FROM adminaccount";
                $res = mysqli_query($conn, $sql);
                //check whether the query is executed
                if($res==TRUE)
                {
                    //count rows to check whether we have data in database or not//if data are insereted we have many rows  in database
                    $count = mysqli_num_rows($res);//function to get all the rows in database//get number of rows in database
                    $idnumber=1;//create a variable and assign the value//beacuse when record will be deleted it destroy counting from database (autoincrement)
                    //check the num of rows
                    if($count>0)
                    {
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res))//get all the rows from database and store in rows
                        {
                            $id = $rows['id'];//column name in database
                            $PersonalData = $rows['PersonalData'];
                            $login = $rows['login'];
                            ?>
                            <tr>
                                <td><?php echo $idnumber++; ?>.</td>
                                <td><?php echo $PersonalData; ?></td>
                                <td><?php echo $login; ?></td>
                                <td>
                              
                              
                                 <form action="updateAdminPassword.php" method="POST" class="input-side-by-side">
                                    <label  class="btn-primary">
                                    Change Password
                                     <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                                     <!-- https://www.w3schools.com/tags/att_input_type_image.asp -->
                                     <input type="image"  src="../images/password.png" alt="Submit" height="15" width="15">
                                    </label>
                                  </form>
                                  <form action="updateSelectedAdmin.php" method="POST" class="input-side-by-side">
                                        <label  class="btn-secondary">
                                        Update Admin
                                         <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                                         <input type="image"   src="../images/update.png" alt="Submit" height="15" width="15">
                                        </label>
                                    </form>
                                    <form action="RemoveAdmin.php" method="POST" class="input-side-by-side">
                                         <label  class="btn-danger">
                                         Remove Admin
                                          <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                                          <input type="image"   src="../images/trash.png" alt="Submit" height="15" width="15">
                                         </label>
                                     </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            ?>
           </table>   
        </div>
     </div>

<?php include('common-part-admin/footer.php'); ?>