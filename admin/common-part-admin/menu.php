<?php include('../config/connection.php'); ?>
<?php include('login-check.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Bookshop</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body style="background-color:#dcdde1;">
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php"><img src="../images/home1.png"/></image>Home</a></li>
                <li><a href="manageAdmin.php"><img src="../images/admin.png"/></image>Admin</a></li>
                <li><a href="manageCategories.php"><img src="../images/category1.png"/></image>Categories/ Book genres</a></li>
                <li><a href="manageBooks.php"><img src="../images/book1.png"/></image>Books</a></li>
                <li><a href="manageOrders.php"><img src="../images/order.png"/></image>Order</a></li>
                <li><a href="logout.php"><img src="../images/logout.png"/></image>Logout</a></li>
            </ul>
        </div>
        
    </div>
    