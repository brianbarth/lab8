<?php
    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');

    $info = array();

    $products = NewProduct::open( $info );
    
    if ( $_GET['id'] ) {
    array_push($_SESSION['cart'], $_GET['id'] );
    }

    foreach ( $_SESSION['cart'] as $id => $value ) {
        $_SESSION['total'] += number_format($products[$value]->price, 2);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="style/mystyles.css" type="text/css">
</head>
    <header>
    <div class="container">
        <div class="jumbotron text-center">
            <h1>Biag's Store</h1>
            <div class="col-sm-12 text-right">
                <?php if ( $_SESSION['cart'] ) : ?>
                    <p><h6>Total of cart: <?php echo "$" . number_format($_SESSION['total'], 2)?></h6></p>
                    <?php unset($_SESSION['total']); ?>
                <?php endif ?>
            </div>
        </div> 
    </div>
    <div class="container">
        <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">
            <div class="row">
                <div class="col text-left">               
                    <a href="emptyCart.php">EMPTY CART</a>
                </div>
                <div class="col">
                    <a href='index.php'>HOME</a>             
                </div>
            </div>
        </div>
    </div>
    </header>
    <main>
        <div class="container text-center">
            <h2>Shopping Cart</h2>
            <hr  style="background-color: black; height: 2px;">
        </div>
        <div class="container">
            <table class="table table-striped">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
                    <?php if ( $_SESSION['cart'] ) : ?>
                    <?php foreach ( $_SESSION['cart'] as $id => $value ) : ?> <!-- iterates through items in cart -->
                    <tr>               
                        <td><?php echo $products[$value]->itemname ?></td>
                        <td><?php echo '$ ' . number_format($products[$value]->price, 2); ?></td>

                        <?php if ( $products[$value]->itemname ) : ?>
                        <td><span><a class="btn btn-primary btn-sm" href='deleteCartItem.php?id=<?php echo $products[$value]->id; ?>'>DELETE</a></span></td>
                        <?php endif ?>
                        
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </div>
    </main>
    <footer>
        <?php if ($_SESSION['flash']['type'] == 'alert' ) : ?>
            <div class="container text-center">
            <div class='alert alert-danger'role='alert'>
        <?php endif ?>
        <?php if ($_SESSION['flash']['type'] == 'notice' ) : ?>
            <div class="container text-center">
            <div class='alert alert-success' role='alert'> 
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
</html>