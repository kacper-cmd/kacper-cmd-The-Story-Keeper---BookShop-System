<?php include ('common-part-admin/menu.php'); ?>

<?php
function redirect($location) {
    header("Location: $location");
    exit;
}

     if(isset($_POST['id'])){
         //echo "updateselectedcategory page";
         $id =  $_POST['id'];
         $sql = "SELECT * FROM bookcategory WHERE id=$id";
         $res = mysqli_query($conn, $sql);
         //count the rows to check whether the id is valid or not
         $count = mysqli_num_rows($res);
         if($count==1){//only 1 id is valid
             $row = mysqli_fetch_assoc($res);//all data from our database save in a row
             $genre = $row['genre'];
             $current_image = $row['pictureGenre'];
             $available = $row['available'];
         }else{
             $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
           //  header('location:'.'manageCategories.php');
                redirect('manageCategories.php');
           
         }
     }else{
      //  header('location:'.'manageCategories.php');
       redirect('manageCategories.php');
     }
 ?>

<?php 
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $genre = mysqli_real_escape_string($conn, $_POST['genre']);
                $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                $available = mysqli_real_escape_string($conn, $_POST['available']);
                //update the new image if selected
                if(isset($_FILES['image']['name'])){
                    //get the image details set new image name
                    $image_name = $_FILES['image']['name'];
                    //check whether the image is available
                    if($image_name != ""){
                        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                        $image_name = "categories_".rand(000, 999).'.'.$ext;//rename the image
                        $source_path = $_FILES['image']['tmp_name'];//get the source path
                        $destination_path = "../images/categories/".$image_name;//get the destination path
                        $upload = move_uploaded_file($source_path, $destination_path);//Moves an uploaded file to a new location
                        if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ){
                            $_SESSION['upload'] = "<div class='error'>Please upload an image file.</div>";
                           //header('location:'.'manageCategories.php');
                         redirect('manageCategories.php');
                           
                        }
                        if($upload==false){
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                          //  header('location:'.'manageCategories.php');     
                            redirect('manageCategories.php');
                          
                            
                        }
                        //remove cuurent image if available
                        if($current_image != ""){
                            $remove_path = "../images/categories/".$current_image;
                            $remove = unlink($remove_path);//remove the image
                        //CHECK IF THE IMAGE IS REMOVED
                        if($remove==false){
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                           // header('location:'.'manageCategories.php');
                           redirect('manageCategories.php');
                        }
                        }
                    }else{
                        //image is not available set the image name as current image
                        $image_name = $current_image;
                    }
                }else{
                    //don't upload the image 
                    $image_name = $current_image;
                }
                //print_r($_FILES['image']);
                //die();
                $sql2 = "UPDATE bookcategory SET
                    genre = '$genre',
                    pictureGenre = '$image_name',
                    available = '$available'
                    WHERE id=$id
                ";
                $res2 = mysqli_query($conn, $sql2);
                if($res2==true){
                    $_SESSION['update'] = "<div class='success'>Category book updated successfully.</div>";
                   // header('location:'.'manageCategories.php');
                    redirect('manageCategories.php');
                 //   die();
                }else{
                    $_SESSION['update'] = "<div class='error'>Failed to update book category.</div>";
                    //header('location:'.'manageCategories.php');
                    redirect('manageCategories.php');
                  //  die();
                }
            }
        ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update book category</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Genre: </td>
                <td>
                    <input type="text" name="genre" value="<?php echo $genre; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if($current_image != ""){
                        //display the image
                        ?>
                        <img src="<?php echo "../images/categories/".$current_image; ?>" width="150px">
                        <?php
                    }else{
                        echo "<div class='error'>No book category image.</div>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image" accept=".png, .jpg, .gif, .jpeg">
                </td>
            </tr>
            <tr>
                <td>Available: </td>
                <td>
                    <input <?php if($available=="Yes"){echo "checked";} ?> type="radio" name="available" value="Yes">Yes

                    <input <?php if($available=="No"){echo "checked";} ?> type="radio" name="available" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

    </div>
</div>



<?php include ('common-part-admin/footer.php'); ?>