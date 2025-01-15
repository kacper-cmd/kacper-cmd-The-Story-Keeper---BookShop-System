<?php include ('common-part-admin/menu.php'); ?>

<?php 
function redirect($location) {
    header("Location: $location");
    exit;
}

     if(isset($_POST['id'])){
         $id = $_POST['id'];
         $sql = "SELECT * FROM orderbooks WHERE id=$id";
         $res = mysqli_query($conn, $sql);
         //count the rows to check whether the id is valid or not
         $count = mysqli_num_rows($res);
         if($count==1){
             $row = mysqli_fetch_assoc($res);
             $price = $row['price'];
             $book = $row['book'];
             $quantity = $row['quantity'];    
             $clientName = $row['clientName'];
             $clientPhone = $row['clientPhone'];
             $clientEmail = $row['clientEmail'];
             $clientAddress = $row['clientAddress'];
             $orderStatus = $row['orderStatus'];
         }else{
           //  header('location:'.'manageOrders.php');
           redirect('manageOrders.php');
         }
     }else{
         //header('location:'.'manageOrders.php');
         redirect('manageOrders.php');
     }
 ?>
<?php 
        if(isset($_POST['submit'])){
            $id =  $_POST['id'];
            $price =  $_POST['price'];
            $quantity = $_POST['quantity'];
            $totalPrice = $price * $quantity;
            $orderStatus = mysqli_real_escape_string($conn, $_POST['orderStatus']);
            $clientName = mysqli_real_escape_string($conn, $_POST['clientName']);
            $clientPhone = mysqli_real_escape_string($conn, $_POST['clientPhone']);
            $clientEmail = mysqli_real_escape_string($conn, $_POST['clientEmail']);
            $clientAddress = mysqli_real_escape_string($conn, $_POST['clientAddress']);

            $sql2 = "UPDATE orderbooks SET
                quantity = $quantity,
                totalPrice = $totalPrice,
                orderStatus = '$orderStatus',
                clientName = '$clientName',
                clientPhone = '$clientPhone',
                clientEmail = '$clientEmail',
                clientAddress = '$clientAddress'
                WHERE id=$id
            ";
            //echo $sql2;  die();
            $res2 = mysqli_query($conn, $sql2);
            if($res2==true){
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
               // header('location:'.'manageOrders.php');
                redirect('manageOrders.php');
            }else{
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
            // header('location:'.'manageOrders.php');
             redirect('manageOrders.php');
            }           
        }
        ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Book name: </td>
                    <td>
                        <b><?php echo $book; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <b><?php echo $price; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Quantity: </td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="orderStatus">
                            <option <?php if($orderStatus=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($orderStatus=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($orderStatus=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($orderStatus=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Client name: </td>
                    <td>
                        <input type="text" name="clientName" value="<?php echo $clientName; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Client Contact: </td>
                    <td>
                        <input type="text" name="clientPhone" value="<?php echo $clientPhone; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Client Email: </td>
                    <td>
                        <input type="text" name="clientEmail" value="<?php echo $clientEmail; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Client Address: </td>
                    <td>
                        <textarea name="clientAddress" cols="30" rows="5"><?php echo $clientAddress; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include ('common-part-admin/footer.php'); ?>