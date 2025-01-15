<?php  include('common-part-shop/menu.php'); ?>

    <section class="categories">
        <div class="container">
            <h2 class="text-center" style="color: #0a3d62">See book categories: </h2>
            <?php
            //display all the categories that are available status
            $sql = "SELECT * FROM bookcategory WHERE available='Yes'";
            $res = mysqli_query($conn, $sql);
            //Count Rows to Check whether we have categories or not
            $count = mysqli_num_rows($res);
            //If count is greater than zero, we have categories else we don't have categories
            if($count > 0){//we have categories
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $genre = $row['genre'];
                    $image_name = $row['pictureGenre'];
                    ?>
                    <!-- link to book with this category_id passed through URL adn i get it with $_GET  -->
                    <!-- https://www.plus2net.com/php_tutorial/variables2.php PASSING DATA THROUGH URL  WITH A HREF LINK TO ANOTHER SITE -->
                    <a href="../bookshop/categoriesBooks.php?category_id=<?php echo $id; ?>">
                     <!-- styling css define in style.css https://developer.mozilla.org/en-US/docs/Web/CSS/border-radius  -->
                    <div class="box-3 float-container">
                        <?php
                             //check if image is available
                             if($image_name==""){
                                 echo "<div class='error'>There is no image found.</div>";
                             }else{
                            //display image
                            ?>
                            <img src="../bookshop/images/categories/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $genre; ?></h3>
                    </div>
                    </a>
                    <?php
                }
            }else{
                echo "<div class='error'>There is no book category found.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

       <?php  include('common-part-shop/footer.php'); ?>   
   