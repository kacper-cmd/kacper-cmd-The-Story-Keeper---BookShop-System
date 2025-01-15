<?php include ('common-part-admin/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Orders</h1>
            <br><br>
            <br><br>
            <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <br><br>
           <table class="tbl-full">
            <tr>
                <th>ID number</th>
                <th>Book</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM orderbooks ORDER BY id DESC";//display first the latest order (DESC) 
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $idnumber=1;
                if($count > 0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $price = $row['price'];
                        $book = $row['book'];
                        $quantity = $row['quantity'];
                        $totalPrice = $row['totalPrice'];
                        $orderDate = $row['orderDate'];
                        $clientName = $row['clientName'];
                        $clientPhone = $row['clientPhone'];
                        $clientEmail = $row['clientEmail'];
                        $clientAddress = $row['clientAddress'];
                        $orderStatus = $row['orderStatus'];
                        ?>   
                                <tr>
                                    <td><?php echo $idnumber++; ?>.</td>
                                    <td><?php echo $book; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $totalPrice; ?></td>
                                    <td><?php echo $orderDate; ?></td>
                                    <td>
                                        <?php
                                        //orderStatus such as Order, On Delivery, Delivered, Cancelled 
                                        if($orderStatus=="Ordered"){
                                            echo "<label>$orderStatus</label>";
                                        }elseif($orderStatus=="On Delivery"){
                                            echo "<label style='color: orange;'>$orderStatus</label>";
                                        }elseif($orderStatus=="Delivered"){
                                            echo "<label style='color: green;'>$orderStatus</label>";
                                        }elseif($orderStatus=="Cancelled"){
                                            echo "<label style='color: red;'>$orderStatus</label>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $clientName; ?></td>
                                    <td><?php echo $clientPhone; ?></td>
                                    <td><?php echo $clientEmail; ?></td>
                                    <td><?php echo $clientAddress; ?></td>
                                    <td>
                                        
                                        <form action="updateSelectedOrder.php" method="POST">
                                             <label class="btn-secondary">
                                             Update Order
                                              <input type="hidden"  name="id"  value="<?php echo $id; ?>">
                                              <input type="image"   src="../images/update.png" alt="Submit" height="15" width="15">
                                             </label>
                                         </form>
                                    </td>
                                </tr>
                                <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="12"><div class="error">There is no book ordered.</div></td>
                    </tr>
                    <?php
                }
            ?>
           </table>
    </div>
</div>
<?php include ('common-part-admin/footer.php'); ?>