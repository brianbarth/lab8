<?php
    session_start();
    require('lib/Flash.php');
    $delID = $_GET['id'];
    $s = array_search( $delID, $_SESSION['cart']);
    if ( $s !== false ) {
       unset( $_SESSION['cart'][$s] );
    }
    Flash::set_notice( 'Item has been deleted!');
    header('location: shoppingCart.php');
    exit;
?>