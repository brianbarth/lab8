<?php

    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');
    require('lib/Authentication.php');

    $products = NewProduct::open($info);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index_Page</title>
</head>
<body>
    <header>

        <h1>Biag's Store</h1>

        <?php if ( $_SESSION['loggedin'] == true ) : ?>        
            <a href='new.php'>New</a>
        <?php endif ?>

        <?php if ( $_SESSION['loggedin'] == true && $_SESSION['superUser'] == true ) : ?>
            <a href='authentication/addUser.php'>USERS</a>
        <?php endif ?>

        <?php if ( ! $_SESSION['loggedin'] == true) : ?>
            <a href='authentication/login.php'>Login</a>
        <?php else : ?>
            <a href='authentication/logout.php'>Logout</a>
        <?php endif ?>

        <?php if ( sizeof($_SESSION['cart'] ) > 1 ) : ?>
            <a href='shoppingCart.php'>View Cart</a>
        <?php endif ?>

        <?php if ( $_SESSION['loggedin'] == true ) : ?>
            <p><h4>Logged in as: <?php echo $_SESSION['user']?></h4></p>
        <?php endif ?>

    </header>
    <main>
        <h2>View Products</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <?php if ( sizeof($products) > 0 ) { ?>
                <?php foreach ($products as $product) : ?> <!-- iterates through products array -->
                <tr>               
                    <td><?php echo $product->itemname ?></td>
                    <td><?php echo $product->description ?></td>
                    <td><?php echo $product->price ?></td>

                    <?php if ( $_SESSION['loggedin'] ) : ?>
                    <td><span><a href='delete.php?id=<?php echo $product->id; ?>'>DELETE</a></span></td>
                    <td><span><a href='edit.php?id=<?php echo $product->id; ?>'>EDIT</a></span></td>
                    <?php endif ?>

                    <?php if ( ! $_SESSION['loggedin'] ) : ?> 
                    <td><span><a href ='addToCart.php?id=<?php echo $product->id; ?>'>ADD TO CART</a></span></td>
                    <?php endif ?>

                </tr>
                <?php endforeach ?>
            <?php } ?>
        </table>
    </main>
    <footer>
        <?php
            if (isset($_SESSION['flash'])) {
                echo '<div class="flash' . $_SESSION['flash']['type'] . '">';
                echo '<p>' . $_SESSION['flash']['message'] . '</p>';
                echo '</div';
                unset($_SESSION['flash']);
            } 
        ?>
    </footer>
</body>
</html>
