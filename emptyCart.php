<?php
  session_start();
  require('lib/Flash.php');
  unset( $_SESSION['cart'] );
  Flash::set_notice( 'Cart is empty! You cannot view an empty cart.');
  header('location: index.php');
  exit;
?>