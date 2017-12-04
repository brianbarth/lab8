<?php
    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');

    $products = array();
    $hotID = $_GET['id'];
    
    if ( ! isset ($_GET['id'])) {
        Flash::set_alert("The product could not be found");
        header ('location: index.php');
        exit;
    } else {
        Flash::set_notice("The product was deleted!");
    }
    $info = NewProduct::open($products); // opens product data (no particular reason)
      
    NewProduct::remove($hotID);  // removes the product from the database by using the $_GET['id']
?>