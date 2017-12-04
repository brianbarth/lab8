<?php
    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');

    $errors = array();
    $info = array();

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
      
        //validation
        $errors = NewProduct::validate($_POST); //object call for validation
        
        if (count($errors) == 0) {

            Flash::set_notice("New book created!"); 
          
            $info = NewProduct::open($info); //open and loads book data 
             
            NewProduct::append( $info ); //object call to append new data to file

        } else {
            foreach ( $errors as $mssg ) {
                echo "<div class='errorBox'>" . "<p class='errorPrint'>" . $mssg . "</br>" . "</p></div>";
            }
        } //end of loop that prints $errors array
    } // end of $_POST control statement

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Biag's Store</h1> 
        <a href='index.php'>HOME</a>    
    </header> 
    <main>
        <h2>Add Product</h2>
        <form action='new.php' method='post'>
            <p>ITEM: <input type='text' name='itemname' id='itemname' value=''></p>
            <p>DESCRIPTION: <input type='text' name='description' id='description' value=''></p>
            <p>PRICE: <input type='text' name='price' id='price' value=''> </p>
            <input type='submit' value='Add'> 
        </form>
    </main> 
    <footer> 
    </footer>
</body>
</html>