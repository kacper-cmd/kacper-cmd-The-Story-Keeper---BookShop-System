<?php include('config/connection.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshop</title>
    <!-- Link CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Link JS file -->
    <script src="js/index.js"></script>
</head>

<body style="background-color:#dcdde1;">
<!-- hex COLOR FROM  https://flatuicolors.com/palette/gb -->
<!--ICONS FROM  https://icons8.com/icons/ -->
    <section class="navbar">
        <div class="container">
            <div class="background">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <!-- css class called img-responsive defined in style.css  -->
                    <img src="images/Logo.png" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li style="text-align:center;">
                    <h2 style="color: #0a3d62">BOOKSHOP - "The Story Keeper"</h2>
                    </li>
                    <li>
                        <a href="index.php"><img src="images/home.gif" width="30" height="30"/></image>Home</a>
                    </li>
                    <li>
                        <a href="categories.php"><img src="images/categories.png" width="30" height="30"/></image>Book categories</a>
                    </li>
                    <li>
                        <a href="books.php"><img src="images/book.png" width="30" height="30"/></image>Books</a>
                    </li>
                    <li>
                        <a href="comments.php"><img src="images/comments.png" width="30" height="30"/></image>Comments section</a>
                    </li>
                </ul>
            </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>