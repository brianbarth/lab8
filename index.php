<?php
    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');
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
        <a href='new.php'>NEW</a>
        <a href='login.php'>Login</a>
        <a href='logout.php'>Logout</a>
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
                    <td><span><a href='delete.php?id=<?php echo $product->id; ?>'>DELETE</a></span></td>
                    <td><span><a href='edit.php?id=<?php echo $product->id; ?>'>EDIT</a></span></td>        
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

<!--<a href='delete.php'>DELETE</a>
<a href='edit.php'>EDIT</a>-->


<!--<td><span><a href='delete.php?id=' . $product['id']>DELETE</a></span></td>
<td><span><a href='edit.php'>EDIT</a></span></td>-->    