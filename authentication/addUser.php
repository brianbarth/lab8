<?php
    session_start();
    require('../lib/Users.php');
    require('../lib/Flash.php');

    $user = array();

    if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

        Flash::set_notice("New user created!");

        $user = Users::open( $_POST );

        Users::append( $user );
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
    <h1>Biag's Store *Admin*</h1>
    <a class="home" href="../index.php">Home</a>
</header>
<main> 
    <div>
        <h1>Add an authorized user</h1>
        <form action="addUser.php" method="post">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" value="" id="username">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="userpassword" value="" id="userpassword">
            </p>
            <p>
                <input type="submit" value="Add">
            </p>
        </form>
    </div>
</main>
<footer>
    <?php   
        if (isset($_SESSION['flash'])) {      //  renders flash message 
            echo '<div class="flash' . $_SESSION['flash']['type'] . '">';
            echo '<p>' . $_SESSION['flash']['message'] . '</p>';
            echo '</div';
            unset($_SESSION['flash']);
        } 
    ?> 
</footer>
</html>