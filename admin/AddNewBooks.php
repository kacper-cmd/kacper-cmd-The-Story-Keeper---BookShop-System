<?php include ('common-part-admin/menu.php'); ?>
<?php
    function redirect($location) {
        header("Location: $location");
        exit;
    }

            //check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                //get form data
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $author = mysqli_real_escape_string($conn, $_POST['author']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);

                //check whether radio button for available are checked or not
                if(isset($_POST['available'])){
                    //get the value from form
                    $available = $_POST['available'];
                }else{
                    //set the default value
                    $available = "No";
                }
                //upload the image 
                //check if select image button is clicked and upload the image
                if(isset($_FILES['image']['name'])){//name='image' //_FILES arrays <input type="file" name="image" >
                    $image_name = $_FILES['image']['name'];//stores the original filename from the user
                    //check whether the image is selected upload the image only if the image is selected
                    if($image_name!=""){
                        
                        //get the extension of our image (jpg, png, gif, etc) e.g "book.jpg"
                        // get the extension without the image name source https://devdojo.com/tnylea/php-getting-the-filename-and-the-extension-from-a-string
                         $extemp = explode('.', $image_name);
                       $ext = end($extemp);//book | jpg -last part of dot 
                      // $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);//alternative way from documentation https://www.php.net/manual/en/function.pathinfo.php
                        //rename the image
                       //create new name for image with random number 
                        $image_name = "book_".rand(000, 999).'.'.$ext; //e.g. book_834.jpg
                      //source https://stackoverflow.com/questions/28473218/how-to-explode-a-file-extension-from-a-filename-that-is-in-an-array
                        $source_path = $_FILES['image']['tmp_name'];//source path is the current location of the image, because $_FILES["file"]["tmp_name"] //stores the name of the temporary file server's temp folder https://stackoverflow.com/questions/37008227/what-is-the-difference-between-name-and-tmp-name
                        $destination_path = "../images/books/".$image_name;//i create book folder in images 
                        $upload = move_uploaded_file($source_path, $destination_path);//from source to destination path
                        if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
                            $_SESSION['upload'] = "<div class='error'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
                           // header('location:'."AddNewBooks.php");
                            //echo "<script> window.location.href='http://localhost/bookshop/admin/AddNewBooks.php';</script>";//if previous doesnt work
                            redirect("AddNewBooks.php");
                            
                        }
                            //check whether the image is uploaded and if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false){
                            $_SESSION['upload'] = "<div class='error'>Failed to upload book image.</div>";
                            // header('location:'."AddNewBooks.php");
                            redirect("AddNewBooks.php");
                             
                        }
                    }
                }else{
                    //don't upload image and set the image_name value as blank
                    $image_name = "";
                }
                //insert into database 
                //for numeric value we don't need to add quotes but for string value we need to add quotes ' '
                $sql2 = "INSERT INTO book SET
                    title = '$title',
                    author = '$author',
                    price = $price,
                    description = '$description',
                    pictureBook = '$image_name',
                    bookcategoryId = $category,
                    available = '$available'
                ";
                //execute the query  For other successful queries mysqli_query() will return TRUE. Returns FALSE on failure. @link https://php.net/manual/en/mysqli.query.php
                $res2 = mysqli_query($conn, $sql2) or die("Query failed.");
                //redirect with message to manageBooks.php
                if($res2==true){
                    //echo "book added";
                    $_SESSION['add'] = "<div class='success'>Book added successfully.</div>";
                  // header('location:'."manageBooks.php");//redirect to manageBooks.php
                    redirect("manageBooks.php");
                   
                }else{
                    //echo "Failed to add book";
                    $_SESSION['add'] = "<div class='error'>Failed to add book.</div>";
                  //  header('location:'."AddNewBooks.php");
                    redirect("AddNewBooks.php");
                   
                }
            }
        ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Books</h1>
        <br><br>
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];//display message
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Book title">
                    </td>
                </tr>
                <tr>
                    <td>Author(s): </td>
                     <td>
                        <textarea name="author" cols="30" rows="5" placeholder="author name"></textarea>
                     </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                         <input type="number" min="1" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="write sth about the book"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Book picture: </td>
                    <td>
                        <input type="file" name="image" accept=".png, .jpg, .gif, .jpeg" >
                    </td>
                </tr>
                <tr>
                    <td>Book category: </td>
                    <td>
                        <select name="category">
                            <?php 
                            //get only all available! categories from database
                                $sql = "SELECT * FROM bookcategory WHERE available='Yes'";//active base on this option we will display book, if add nowont be display 
                                $res = mysqli_query($conn, $sql);
                                //count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);
                                //if count is greater than zero, we have categories else we don't have categories
                                if($count>0){
                                    //we have categories , while loop to get categories from database and display on option 
                                    while($row=mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $genre = $row['genre'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $genre; ?></option>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <option value="0">There is no book category found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Is available ?: </td>
                    <td>
                        <input type="radio" name="available" value="Yes">Yes
                        <input type="radio" name="available" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Book" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include ('common-part-admin/footer.php'); ?>