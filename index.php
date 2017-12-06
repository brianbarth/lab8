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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index_Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="style/mystyles.css" type="text/css">
</head>
<body>
    <header>
    <div class="container">
        <div class="jumbotron text-center">
        <h1>Biag's Store</h1>
            <div class="col-sm-12 text-right">
                <?php if ( $_SESSION['loggedin'] == true ) : ?>
                    <p><h6>Logged in as: <?php echo $_SESSION['user']?></h6></p>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">           
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

            <?php if ( sizeof($_SESSION['cart'] ) > 0 ) : ?>
                <?php if ( ! $_SESSION['loggedin'] ) : ?>
                    <a href='shoppingCart.php'>View Cart</a>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>                                                     
    </header> 
    <main>
        <div class="container text-center">
            <h2>Available Products</h2>
            <hr  style="background-color: black; height: 2px;">
        </div>
        <div class="container">
            <table class="table table-striped">
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
                        <td><?php echo '$ ' . number_format($product->price, 2); ?></td>

                        <?php if ( $_SESSION['loggedin'] ) : ?>
                        <td><span><a class="btn btn-primary btn-sm" href='delete.php?id=<?php echo $product->id; ?>'>DEL</a></span></td>
                        <td><span><a class="btn btn-primary btn-sm" href='edit.php?id=<?php echo $product->id; ?>'>EDIT</a></span></td>
                        <?php endif ?>

                        <?php if ( ! $_SESSION['loggedin'] ) : ?> 
                        <td><span><a class="btn btn-primary btn-sm" href ='addToCart.php?id=<?php echo $product->id; ?>'>ADD</a></span></td>
                        <?php endif ?>
                    </tr>
                    <?php endforeach ?>
                <?php } ?>
            </table>
        </div>          
    </main>
    <footer>
    <?php if ($_SESSION['flash']['type'] == 'alert' ) : ?>
        <div class='container'>
        <div class='alert alert-danger text-center'role='alert'>
    <?php endif ?>
    <?php if ($_SESSION['flash']['type'] == 'notice' ) : ?>
        <div class='container'>
        <div class='alert alert-success text-center' role='alert'> 
    <?php endif ?>
        <?php
            if (isset($_SESSION['flash'])) {             
                echo '<div class="flash' . $_SESSION['flash']['type'] . '">';
                echo '<p>' . $_SESSION['flash']['message'] . '</p>';
                echo '</div';
                unset($_SESSION['flash']);
            } 
        ?>
        </div>
        </div>
    </footer>
</body>
</html>
