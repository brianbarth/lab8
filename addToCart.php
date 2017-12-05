<?php
    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');

    $info = array();
    $passedID = $_GET['id'];
    $products = NewProduct::open( $info );
    //var_dump($products);
    if ( $passedID ) {
        array_push($_SESSION['cart'], $passedID );
    }

    $name = $products[$passedID]->itemname;

    Flash::set_notice( $name . ' has been added to cart!');
    header( 'location: index.php?id=' . $_GET['id'] );
    exit;
?>