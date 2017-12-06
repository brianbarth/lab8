<?php
    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');

    if ( ! $_SESSION['cart'] ) {
        $_SESSION['cart'] = array();
    }
    
    $info = array();
    $passedID = $_GET['id'];
    $products = NewProduct::open( $info );
    
    if ( $passedID ) {
        array_push($_SESSION['cart'], $passedID );
    }

    $name = $products[$passedID]->name;

    Flash::set_notice( $name . ' has been added to cart!');
    header( 'location: index.php?id=' . $_GET['id'] );
    exit;
?>