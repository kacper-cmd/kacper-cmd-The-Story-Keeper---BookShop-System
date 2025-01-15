<?php include('common-part-shop/menu.php'); ?>

<style>
    /* Internal styling  https://www.digitalocean.com/community/tutorials/how-to-style-common-form-elements-with-css https://blog.logrocket.com/how-to-style-forms-with-css-a-beginners-guide/ */
    .form-field {
    margin-bottom: 5px;
}
.form-field input {
    border: solid 2px #f0f0f0;
    border-radius: 3px;
    padding: 5px;
    margin-bottom: 5px;
    font-size: 14px;
    display: block;
}
/* https://developer.mozilla.org/en-US/docs/Web/HTML/Element/legend  */
/* @link https://www.dofactory.com/html/legend/style  */
legend {
  padding: 0.2px 0.5px;
  color: #0a3d62;
  font-size: 100%;
  margin-left: auto;
  margin-right: auto;
}
/* CSS js validation */
.form-field span{
margin-left: auto;
margin-right: auto;
color: red;  
}
#submit-error{
    color: red;  
}
.form-field span img{
    padding: 1px;
}
</style>
<?php

function redirect($location) {
    header("Location: $location");
    exit;
}

            if(isset($_POST['submit']))
            {
                $book = $_POST['book'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $totalPrice = $price * $quantity;
                $orderDate = date("Y-m-d h:i:sa");//https://www.w3schools.com/php/func_date_date.asp
                $orderStatus = "Ordered"; //orderStatus such as: Ordered, On Delivery, Delivered, Cancelled
                $clientName = $_POST['full-name'];//from form POSt ['']; $name-table-database
                $clientPhone = $_POST['tel'];
                $clientEmail = $_POST['email'];
                $clientAddress = $_POST['address'];                                                                                                                                                                    
    
                $sql2 = "INSERT INTO orderbooks SET
                    price = $price,
                    book = '$book',
                    quantity = $quantity,
                    totalPrice = $totalPrice,
                    orderDate = '$orderDate',
                    clientName = '$clientName',
                    clientPhone = '$clientPhone',
                    clientEmail = '$clientEmail',
                    clientAddress = '$clientAddress',
                    orderStatus = '$orderStatus'
                ";
               // test echo $sql2; die();
                $res2 = mysqli_query($conn, $sql2);
                if($res2==true)
                {
                    $_SESSION['order'] = "<div class='success text-center'>Your book Order place Successfully.</div>";
                  // echo "<script> window.location.href='http://localhost/bookshop/index.php';</script>";// https://stackoverflow.com/questions/8028957/how-to-fix-headers-already-sent-error-in-php
                    //header('location:'.'index.php');
                    redirect('index.php');
                    
                }
                else
                {
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order Book.</div>";
                   // header('location:'.'index.php');
                    //echo "<script> window.location.href='http://localhost/bookshop/index.php';</script>";
                    redirect('index.php');
                }
            }
            ?>
<?php
//input type hidden
if(isset($_POST['book_id']))
{
    $book_id = $_POST['book_id'];
    $sql = "SELECT * FROM book WHERE id=$book_id";
    $res = mysqli_query($conn, $sql);
    //count the rows to check if the book is available
    $count = mysqli_num_rows($res);
    if($count==1)
    {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['pictureBook'];
    }
    else
    {
        //no book available
       // header('location:'.'index.php');
        redirect('index.php');
    }
}
else
{
    //header('location:'.'index.php');
    redirect('index.php');
}
?>
    <section class="book-search" >
        <div class="container">
            <h2 class="text-center" style="color: #0a3d62">Fill this form to confirm and place your order.</h2>
            <!-- https://www.w3schools.com/jsref/event_onsubmit.asp -->
            <form action="" method="POST" class="order" id="order" onsubmit="return validateForm();"> <!-- onsubmit="return validateForm();" -->
            <!-- https://how2html.pl/fieldset-legend-html/     -->
            <fieldset>
                    <legend>Selected Book</legend>
                    <div class="book-menu-img">
                        <?php 
                            //check if image is available
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else
                            {
                                //display image
                                ?>
                                <img src="../bookshop/images/books/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
                    <div class="book-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="book" value="<?php echo $title; ?>">
                        <p class="book-price">$ <?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input style="width: 50px;"  type="number" name="quantity" min="1" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Fill the order details</legend>
                    <div class="form-field">
                        <div class="order-label">Full Name</div>
                        <input style="width: 200px;"  type="text" name="full-name" id="contact-name"  placeholder="Kacper Obrzut" class="input-responsive" required onkeyup="validateName()" >
                        <!-- https://www.w3schools.com/jsref/event_onkeyup.asp -->
                        <span id="name-error" ></span><!-- tag to show the error message to the users. from script.js  -->
                     </div>
                     <div class="form-field">
                    <div class="order-label">Phone Number</div>
                    <input style="width: 200px;"  type="tel" name="tel" id="contact-phone" placeholder="48655654123" class="input-responsive" required onkeyup="validatePhone()">
                    <span id="phone-error" ></span>
                    </div>
                    <div class="form-field">
                    <div class="order-label">Email</div>
                    <input style="width: 300px;"  type="email" name="email" placeholder="kmobrzut@student.wsb-nlu.edu.pl" class="input-responsive" required id="contact-email" onkeyup="validateEmail()">
                    <span id="email-error" ></span>
                    </div>
                    <div class="form-field">
                    <div class="order-label">Address</div>
                    <input type="text" name="address"  placeholder="Zielona 27, Nowy Sacz, Poland" id="contact-address" class="input-responsive" required onkeyup="validateAddress()">
                    <span id="address-error" ></span>
                    </div>

                    <div class="form-field">
                    <input style="width: 150px;"  type="reset" value="Clear" class="btn btn-reset">
                    <!-- https://www.w3schools.com/jsref/event_onclick.asp -->
                    <input style="width: 150px;"  type="submit" name="submit" value="Confirm Order" class="btn btn-primary" onclick="return validateForm()">
                    <span id="submit-error" ></span> 
                    </div>
                </fieldset>
            </form>
        </div>
    </section>

    <script src="js/script.js"></script>

    <?php include('common-part-shop/footer.php'); ?>