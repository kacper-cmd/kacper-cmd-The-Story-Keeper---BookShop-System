<?php include ('common-part-admin/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Books</h1>
        <br><br>
            <!-- link to add book -->
            <a href="AddNewBooks.php" class="btn-primary"><img src="../images/add.png"/></img>Add Book</a>
            <br><br>
            <br><br>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];//display messge
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['unauthorize'])){
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
           <table class="tbl-full">
            <tr>
                <th>ID number</th>
                <th>Author(s)</th>
                <th>Title</th>
                <th>Price</th>
                <th>Book picture</th>
                <th>Description</th>
                <th>Is available ?</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM book";
            $res = mysqli_query($conn, $sql);
            //count rows to check if we have book
            $count = mysqli_num_rows($res);
            $idnumber=1;
            if($count>0){
                //we have book in database greater than 0
                while($row=mysqli_fetch_assoc($res)){
                    //get the values from columns from database (associative array)
                    $id = $row['id'];
                    $author = $row['author'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['pictureBook'];
                    $available = $row['available'];
                    ?>
                    <tr>
                        <td><?php echo $idnumber++; ?>.</td>
                        <td><?php echo $author; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                            <?php
                                if($image_name!=""){
                                    //we have image and we can display it
                                    ?>
                                    <img src="../images/books/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                }else{
                                    //wo dont have image
                                    echo "<div class='error'>No book photo.</div>";
                                }
                            ?>
                        </td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $available; ?></td>
                        <td>
                        <form action="updateSelectedBook.php" method="POST">
                             <label class="btn-secondary">
                             Update Book
                              <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                              <input type="image"   src="../images/update.png"  height="15" width="15">
                             </label>
                         </form>
                         <form action="RemoveBooks.php" method="POST">
                             <label class="btn-danger">
                             Delete Book
                              <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                              <input type="hidden"  name="image_name"  value="<?php echo $image_name; ?>">
                              <input type="image"   src="../images/trash.png"  height="15" width="15">
                             </label>
                         </form>
                        </td>
                    </tr>
                    <?php
                }
            }else{
                //book not added in database
                echo "<tr><td colspan='7' class='error'> There is no Book, please add it.</td></tr>";
            }
            ?>
           </table>
    </div>
</div>
<?php include ('common-part-admin/footer.php'); ?>