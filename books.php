<?php include('common-part-shop/menu.php'); ?>

<!-- SECTION DIV https://www.dotnettricks.com/learn/html/html5-layouts-techniques-example http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/html/html_layout.asp.html#gsc.tab=0 -->
<!-- my own class define in style.css here after space i have 2 classes book-search and text-center -->
    <section class="book-search text-center">
        <div class="container">
        <h2 class="text-center" style="color: #0a3d62">Find books that you want </h2>
            <form action="bookSearch.php" method="POST">
                <input type="search" name="search" placeholder="Type book title" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>

    <section class="book-menu">
        <div class="container">
            <h2 class="text-center" style="color: #0a3d62">BOOKS</h2>
            <?php 
            $sql = "SELECT * FROM book WHERE available='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);//https://www.w3schools.com/php/func_mysqli_num_rows.asp
            //check whether book is available counting rows
            if($count>0)
            {
                //we have book
                //https://www.w3schools.com/php/func_mysqli_fetch_assoc.asp
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $author	 = $row['author'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['pictureBook'];
                    ?>
                    <div class="book-menu-box">
                        <div class="book-menu-img">
                            <?php 
                                //check whether image is available or not
                                if($image_name=="")
                                {
                                    echo "<div class='error'>No image.</div>";
                                }
                                else
                                {
                                    //image available and display it
                                    ?>
                                    <img src="../bookshop/images/books/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="book-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="book-price $2.3"><?php echo $price; ?></p>
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
            }
            else
            {
                echo "<div class='error'>There is no book in my bookshop.</div>";
            }
            ?>
              <!-- https://www.w3schools.com/css/css_float_clear.asp    -->
  <!-- element should be next to any floating elements that precede it. because upper in css class book-menu-desc i have float: left; so here i should add my class css  CLEARFIX - clear: both;-->
            <div class="clearfix"></div>
        </div>
    </section>
<?php include('common-part-shop/footer.php'); ?>