<?php
    session_start();
    $delID = $_GET['id'];
    $s = array_search( $delID, $_SESSION['cart']);
    if ( $s !== false ) {
       unset( $_SESSION['cart'][$s] );
    }
    //echo $delID;
    //echo $s;
    //echo 'fuck you!';
    header('location: shoppingCart.php');
    exit;
?>