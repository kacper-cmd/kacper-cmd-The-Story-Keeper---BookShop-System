<?php include('common-part-admin/menu.php'); ?>
<?php
function redirect($location) {
    header("Location: $location");
    exit;//exit();
}
function display_upload_message($message) {
    $_SESSION['upload'] = "<div class='error'>$message</div>";
}
         if(isset($_POST['submit'])){
                $genre = mysqli_real_escape_string($conn, $_POST['genre']);
                //for radio input, we need to check if the button is selected
                if(isset($_POST['available'])){
                    $available =  mysqli_real_escape_string($conn, $_POST['available']);//if button selected get value from form
                }else{
                    $available = "No";
                }
                //print_r($_FILES['image']);
                if(isset($_FILES['image']['name'])){//name property image array name=>value
                    $image_name = $_FILES['image']['name'];//z input type name image
                    if($image_name!=""){
                        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);//www.php.net/manual/en/function.pathinfo.php
                        $image_name = "bookcategory_".rand(000, 999).'.'.$ext;//e.g bookcategory_434.png random number 000-999
                        $source_path = $_FILES['image']['tmp_name'];//from array $_FILES['image'] i got [tmp_name] => C:\xampp\tmp\ //www.php.net/manual/en/features.file-upload.post-method.php
                        $destination_path = "../images/categories/".$image_name;//uploade photo to folder
                        $upload = move_uploaded_file($source_path, $destination_path);//www.php.net/manual/en/function.move-uploaded-file.php
                        //check whether the image is uploaded or not and if the image is not uploaded then we will stop the process and redirect with error message
                        if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
                           // $_SESSION['upload'] = "<div class='error'>Only JPG, JPEG, PNG & GIF files are allowed.</div>";
                           display_upload_message("Only JPG, JPEG, PNG & GIF files are allowed.");
                            //header('location:'."AddNewCategories.php");
                           redirect("AddNewCategories.php");
                           
                        }
                        if($upload==FALSE){
                           
                            //$_SESSION['upload'] = "<div class='error'>Failed to upload category image.</div>"; //set upload message
                            display_upload_message("Failed to upload category image.");
                           // header('location:'."AddNewCategories.php");
                            redirect("AddNewCategories.php");
                        }
                    }
                }
                else{
                    //dont upload image and set the image_name value as blank
                    $image_name = "";
                }
                //SQL Query to save the data into database
                $sql = "INSERT INTO bookcategory SET
                    genre = '$genre',
                    pictureGenre = '$image_name',
                    available = '$available'
                ";
                $res = mysqli_query($conn, $sql) or die("Query failed");
                //4. Check whether the (Query is executed and data  inserted) and display  message
                if($res==TRUE){
                    //echo "data in database";
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";//Create a session variable success to display message
                   // header("location:"."manageCategories.php");
                    redirect("manageCategories.php");
                }else{
                    //echo "data not present in database";
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";//error message on red color in class css defined
                   // header("location:"."manageCategories.php");
                    redirect("manageCategories.php");
                }
         }
        ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//display messge 
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
       <!--     enctype="multipart/form-data" to photos upload   -->
       <form action="" method="POST" enctype="multipart/form-data">
              <table class="tbl-30">
                <tr>
                     <td>Genre: </td>
                     <td>
                          <input type="text" name="genre" placeholder="Book genre">
                     </td>
                </tr>
                <tr>
                        <td>Genre/Category picture: </td>
                        <td>
                            <input type="file" name="image" accept=".png, .jpg, .gif, .jpeg" >
                            
                        </td>
                </tr>
                <tr>
                     <td>Is available ? </td>
                     <td>
                          <input type="radio" name="available" value="Yes">Yes
                          <input type="radio" name="available" value="No">No
                     </td>
                </tr>
                <tr>
                     <td colspan="2">
                          <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                     </td>
                </tr>
              </table>
       </form>
    </div>
</div>

<?php include('common-part-admin/footer.php'); ?>