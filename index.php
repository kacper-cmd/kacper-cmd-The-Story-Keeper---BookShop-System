<?php include('common-part-shop/menu.php'); ?>

    <section class="book-search text-center">
        <div class="container">
        <h2 class="text-center" style="color: #0a3d62">Book search</h2>
            <form action="../bookshop/bookSearch.php" method="POST">
                <input type="search" name="search" placeholder="Type book that you want" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    
    <?php 
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];//displaying session message about order placed or not
        unset($_SESSION['order']);
    }
    ?>

    <section class="book-menu">
        <div class="container">
            <h2 class="text-center" style="color: #0a3d62">Welcome to my BOOKSHOP - "The Story Keeper".</h2>
            <h3 class="text-center" style="color: #0a3d62">You can here find really interesting books and buy them at low prices.</h3><br>
            <h3 class="text-center" style="color: #0a3d62">I invite you to shop.</h3>
        </div>
    </section>

<?php include('common-part-shop/footer.php'); ?>