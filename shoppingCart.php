<?php
    session_start();
    require('lib/NewProducts.php');

    $info = array();

    $products = NewProduct::open( $info );
    
    if ( $_GET['id'] ) {
    array_push($_SESSION['cart'], $_GET['id'] );
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <header>
        <h1>Biag's Store</h1> 
        <a href='index.php'>HOME</a>
    </header>
    <main>
        <h2>Shopping Cart</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
            </tr>
                <?php if ( $_SESSION['cart'] ) : ?>
                <?php foreach ( $_SESSION['cart'] as $id => $value ) : ?> <!-- iterates through items in cart -->
                <tr>               
                    <td><?php echo $products[$value]->itemname ?></td>
                    <td><?php echo $products[$value]->price ?></td>

                    <?php if ( $products[$value]->itemname ) : ?>
                    <td><span><a href='deleteCartItem.php?id=<?php echo $products[$value]->id; ?>'>DELETE</a></span></td>
                    <?php endif ?>
                       
                </tr>
                <?php endforeach ?>
            <?php endif ?>
        </table>
    </main>
    <footer> 
    </footer> 
</html>