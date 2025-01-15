<?php include ('common-part-admin/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Book Categories</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add'])){
                 echo $_SESSION['add'];//display messge 
                  unset($_SESSION['add']);
                }
            if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
            if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

            if(isset($_SESSION['no-category-found'])){
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
            if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
        ?>
                 <br><br>
            <!-- Button to add catagery -->
            <a href="AddNewCategories.php" class="btn-primary"><img src="../images/add.png"/></img>Add New Book Category</a>
            <br><br>
            <br><br>

           <table class="tbl-full">
            <tr>
                <th>ID number</th>
                <th>Genre</th>
                <th>Picture of genre</th>
                <th>Is available ?</th>
                <th>Actions</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM bookcategory";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $idnumber=1;
            //check whether we have data in database
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];//get indivudual data
                    $genre = $row['genre'];//$row['genre'] - genre name columnn name in database
                    $image_name = $row['pictureGenre'];
                    $available = $row['available'];
                    ?>
                    <tr>
                        <td><?php echo $idnumber++; ?>.</td>
                        <td><?php echo $genre; ?></td>
                        <td>
                            <?php 
                            //check whether image name is available or not
                            if($image_name!=""){//diplay the image
                                ?>
                                <img src="../images/categories/<?php echo $image_name; ?>" width="100px">
                                
                                <?php
                            }else{
                                echo "<div class='error'>No book category photo</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $available; ?></td>
                        <td>
                        
                        <form  action="updateSelectedCategory.php" method="POST" class="input-side-by-side">
                            <label class="btn-secondary" >
                            Update Category
                             <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                             <input type="image"   src="../images/update.png" alt="Submit" height="15" width="15">
                            </label>
                        </form>
                        <form action="RemoveCategories.php" method="POST" class="input-side-by-side">
                             <label class="btn-danger">
                             Delete Category
                              <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                                <input type="hidden"  name="image_name"  value="<?php echo $image_name; ?>">
                              <input type="image"   src="../images/trash.png" alt="Submit" height="15" width="15">
                             </label>
                         </form>
                        </td>
                        
                    </tr>
                    <?php
                }
            }else{      
                //we do not have data in database  
                ?>
                <tr>
                    <td colspan="6"><div class="error">There is no category, please add it.</div></td>
                </tr>
                <?php
            }
            ?>                                                                              
           </table>
    </div>
</div>
<?php include ('common-part-admin/footer.php'); ?>