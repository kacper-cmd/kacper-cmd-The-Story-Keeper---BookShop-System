<?php include('common-part-admin/menu.php'); ?>

     <div class="main-content">
         <div class="wrapper">
            <h1 class="text-center">ADMIN PANEL SUMMARY</h1>
            <br><br>
            <?php
             if(isset($_SESSION['login']))
                {
                     echo $_SESSION['login'];
                      unset($_SESSION['login']);
                 }
            ?>
            <br><br>
            <div class="text-center">
                 <?php 
                 $sql3 = "SELECT * FROM orderbooks WHERE DATE(orderDate) = CURDATE()";
                //https://stackoverflow.com/questions/12551883/how-to-get-todays-yesterdays-data-from-mysql-database
                 $res3 = mysqli_query($conn, $sql3);
                 $count3 = mysqli_num_rows($res3);//count the number of rows - number of orders
                 date_default_timezone_get();//see what timezone the server is currently in via: https://www.php.net/manual/en/function.date-default-timezone-get.php
                 $date = date('d-m-Y');
                 ?>
             <h2>Today <?php echo $date ?> was placed
             <?php echo $count3; ?> orders</h2>
                <br>
            </div>  
            <div class="text-center">
                
                <?php
                //get the total revenue agregate function
                $sql4 = "SELECT SUM(totalPrice) AS totalPrice FROM orderbooks WHERE orderStatus='Delivered'";
                $res4 = mysqli_query($conn, $sql4);
                $row4 = mysqli_fetch_assoc($res4);// link https://www.php.net/manual/en/mysqli-result.fetch-assoc.php- fetch a result row as an associative array
                $total_revenue = $row4['totalPrice'];
                ?>
                <h2>
                Our bookshop generated a total of  
                $ <?php echo $total_revenue; ?> in revenue from the delivered orders</h2>
            </div> 
            <!-- https://www.w3schools.com/css/css_float_clear.asp    CLEARFIX - clear: both; -->
            <!-- element should be next to any floating elements that precede it.  -->
            <div class="clearfix"></div>       
        </div>
     </div>

<?php include('common-part-admin/footer.php');?>





