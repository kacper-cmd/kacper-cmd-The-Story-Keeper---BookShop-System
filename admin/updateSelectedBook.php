<?php include('common-part-admin/menu.php') ?>

<?php 
function redirect($location) {
    header("Location: $location");
    exit;
}

if(isset($_POST['id'])){
    $id =  $_POST['id'];//from this id we get all other details of selected book
    $sql2 = "SELECT * FROM book WHERE id=$id";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);//this row will get all values all details of selected book array
    $title = $row2['title'];
    $author = $row2['author'];
    $price = $row2['price'];
    $description = $row2['description'];
    $current_image = $row2['pictureBook'];
    $currentCategory = $row2['bookcategoryId'];
    $available = $row2['available'];
}
else{
    //header('location:'.'manageBooks.php');
    redirect('manageBooks.php');
}
?>

<?php
        if(isset($_POST['submit'])){
            $id =$_POST['id'];
            $title = mysqli_real_escape_string($conn, $_POST['title']);//secure from sql injection
            $author = mysqli_real_escape_string($conn, $_POST['author']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price =  $_POST['price'];
            $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $available = mysqli_real_escape_string($conn, $_POST['available']);
            //check if the image is selected
            //print_r($_FILES['image']);
            if(isset($_FILES['image']['name'])){
                //upload button is clicked
                $image_name = $_FILES['image']['name'];
                if($image_name!=""){
                   // $ext = explode('.', $image_name);
                   // $ext = end($ext);//or below version official
                   $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);//https://www.php.net/manual/en/function.pathinfo.php
                    //rename image
                    $image_name = "book_".rand(000, 999).'.'.$ext;//https://www.php.net/manual/en/function.rand.php
                    $source_path = $_FILES['image']['tmp_name'];//https://www.php.net/manual/en/features.file-upload.post-method.php
                    $destination_path = "../images/books/".$image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);//https://www.php.net/manual/en/function.move-uploaded-file.php
                    if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" )
                        {
                                $_SESSION['upload'] = "<div class='error'>Please upload only jpg, jpeg and png file.</div>";//https://meeraacademy.com/php-upload-only-image-using-file-upload/
                               // header('location:'.'AddNewBooks.php');                                                  
                                redirect('AddNewBooks.php');
                        }
                    if($upload==false){
                        $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                       // header('location:'.'AddNewBooks.php');        
                        redirect('AddNewBooks.php');
                        
                    }
                    //remove the current image if new image is uploaded and cuurent image exists
                    if($current_image!=""){
                        $remove_path = "../images/books/".$current_image;
                        $remove = unlink($remove_path);//https://www.php.net/manual/en/function.unlink.php
                        if($remove==false){//check if image is removed
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                           
                          //  header('location:'.'manageBooks.php');
                           redirect('manageBooks.php');
                        }
                    }
                }else{
                    $image_name = $current_image;//default image when image is not selected
                }
            }else{
                $image_name = $current_image;//default image when button is not clicked
            }
            $sql3 = "UPDATE book SET
                title = '$title',
                author = '$author',
                price = $price,
                description = '$description',
                pictureBook = '$image_name',
                bookcategoryId = $category,
                available = '$available'
                WHERE id=$id
            ";
            $res3 = mysqli_query($conn, $sql3);
            if($res3==true){
                $_SESSION['update'] = "<div class='success'>Books Updated Successfully.</div>";
               // header('location:'.'manageBooks.php');
               redirect('manageBooks.php');
                //if this warningt occurs error Warning: Cannot modify header information - headers already sent by
                //echo "<script> window.location.href='manageBooks.php';</script>";
                
                  
            }else{
                $_SESSION['update'] = "<div class='error'>Failed to update books.</div>";
               // header('location:'.'manageBooks.php');
               redirect('manageBooks.php');
               
                
            } 
        }
        ?>

<div class="main-content">
    <div class="wrappper">
        <h1>Update Book</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                <td>Author: </td>
                 <td>
                        <input type="text" name="author" value="<?php echo $author; ?>">
                 </td>
                 </tr>
                 <tr>
                 <td>Price: </td>
                <td>
                        <input type="number" name="price" min="1" value="<?php echo $price; ?>">
                 </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if($current_image!=""){
                            //display the image
                            ?>
                            <img src="../images/books/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }else{
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image" accept=".png, .jpg, .gif, .jpeg">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                            $sql = "SELECT * FROM bookcategory WHERE available='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            //if count is greater than zero, we have categories else we don't have categories
                            if($count>0){//we have categories
                                while($row=mysqli_fetch_assoc($res)){
                                    $categoryGenre = $row['genre'];
                                    $categoryId = $row['id'];
                                   ?>
                                      <option <?php if($currentCategory==$categoryId){echo "selected";} ?> value="<?php echo $categoryId; ?>"><?php echo $categoryGenre; ?></option>
                                   <?php
                                }
                            }else{
                               echo "<option value='0'>No book category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                     <td>Is available ?: </td>
                     <td>
                         <input <?php if($available=="Yes"){echo "checked";} ?> type="radio" name="available" value="Yes"> Yes
                          <input <?php if($available=="No"){echo "checked";} ?> type="radio" name="available" value="No"> No
                     </td>
                 </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Book" class="btn-secondary">
                        </td>
                    </tr>
            </table>
        </form>
    </div>
</div>


<?php include('common-part-admin/footer.php') ?>