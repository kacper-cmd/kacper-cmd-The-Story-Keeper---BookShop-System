<?php include('common-part-shop/menu.php'); ?>

<?php
//prevent from direct access of this page by URL like http://localhost/bookshop/bookSearch.php without passing search keyword
 if(isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn,$_POST['search']);//prevention from sql injection
 }
 else{
    header("location:".'books.php');
     die();
 }
?>
<!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/section -->
    <section class="book-search text-center">
        <div class="container">
            <h2>Book search results <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
        </div>
    </section>

    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">BOOKS</h2>
            <?php
            //sql query to get books based on search keyword            
            $sql = "SELECT * FROM book WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            //check if books available
            if($count > 0){
                while($row=mysqli_fetch_array($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $author = $row['author'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['pictureBook'];
                    ?>
                    <div class="book-menu-box">
                        <div class="book-menu-img">
                            <?php
                                //check whether image is available or not
                                if($image_name==""){
                                    echo "<div class='error'>No image.</div>";
                                }else{
                                    //display image there are 2 class define in style.css  https://www.w3schools.com/css/css3_images.asp
                                    ?>
                                    <img src="../bookshop/images/books/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <div class="book-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="book-price"><?php echo $price; ?></p>
                                <p class="book-detail">
                                    <?php echo $author; ?>
                                </p>
                                <br>
                                <form action="order.php" method="POST">
                                    <label  class="btn-primary">
                                     Place Order
                                     <input type="hidden"  name="book_id"  value="<?php echo $id; ?>">
                                     <input type="image"   src="images/order.png" alt="Submit" height="15" width="15">
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                
            }else{
                echo "<div class='error'>There is no book found.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

<?php include('common-part-shop/footer.php'); ?>
























