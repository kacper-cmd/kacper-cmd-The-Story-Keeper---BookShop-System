<?php include('common-part-shop/menu.php'); ?>
<?php 
// Check whether category id from categories.php pass by url ?category_id= GET is passed  a href link
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $sql = "SELECT genre FROM bookcategory WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_genre = $row['genre'];
}else{
    // Category id is not passed in the url redirect to home page index.php
    header('location:'."index.php");
    die();
}
?>

    <section class="book-search text-center">
        <div class="container">
            <h2>Found books for word <a href="#" class="text-blue">"<?php echo $category_genre; ?>"</a></h2>
        </div>
    </section>

    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">BOOKS</h2>
            <?php
            // Get the books based on selected category id 
            $sql2 = "SELECT * FROM book WHERE available='Yes' AND bookcategoryId=$category_id";//category id is passed from index.php from url ?category_id= GET
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            // Check if book available
            if($count2 > 0){
                while($row2=mysqli_fetch_assoc($res2)){//Fetch a result row as an associative array
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $author	 = $row2['author'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['pictureBook'];
                    ?>
                    <div class="book-menu-box">
                        <div class="book-menu-img">
                            <?php 
                                // Check if image is available
                                if($image_name==""){
                                    echo "<div class='error'>There is not image found.</div>";
                                }else{
                                    // display image
                                    ?>
                                    <img src="../bookshop/images/books/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="book-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="book-price">$<?php echo $price; ?></p>
                            <p class="book-detail">
                                <?php echo $author; ?>
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <form action="order.php" method="POST">
                                <label  class="btn btn-primary">
                                 Place Order
                                 <input type="hidden"  name="book_id"  value="<?php echo $id; ?>">
                                 <input type="image"   src="images/order.png" alt="Submit" height="15" width="15">
                                </label>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }else{
                echo "<div class='error'>There is not book found.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

<?php include('common-part-shop/footer.php'); ?>