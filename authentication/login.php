<?php
    session_start();
    require('../lib/Flash.php');
    require('../lib/Users.php');
    
    $bad = false;
    $data = array();
    $user = array();

    $validUser = Users::open( $user );

    if ( isset( $_POST['username'], $_POST['userpassword'] ) ) {
        $bad = true;
        if ( $_POST['username'] == 'biag' && $_POST['userpassword'] == '1234' ) {
            $_SESSION['loggedin'] = true;
            $_SESSION['superUser'] = true;
            $_SESSION['user'] = $_POST['username'];
        
            Flash::set_notice( 'Hello Biag, you are now logged in!');
            header('location: ../index.php');
            exit;
        }
        if ( $_POST['username'] != 'biag' ) {
            foreach ( $validUser as $foo ) {
                if ( ( $_POST['username'] == $foo->username ) && ( $_POST['userpassword'] == $foo->userpassword ) ) {
                    $_SESSION['superUser'] = false;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $_POST['username'];
               
                    Flash::set_notice( 'You are now logged in!');
                    header('location: ../index.php');
                    exit;
                }
            }
        }
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
        <h1>Biag's Store *LOGIN*</h1>
        <a href='../index.php'>HOME</a>
        <?php if ( $bad ) : ?>
            <div><p>The Username or password is not correct</p></div>
        <?php endif ?>
    </header> 
    <main>
        <div>
            <h2>Please Login:</h2>
            <form action='login.php' method='post'>
                <p> 
                    <label for 'username'>USERNAME</label> 
                    <input type ='text' name ='username' value ='' id='username'>
                </p> 
                <p>
                    <label for 'password'>PASSWORD</label> 
                    <input type = 'text' name = 'userpassword' value = '' id = 'password'> 
                </p>
                <p>
                    <input type = 'submit' value ='Login'> 
                </p>  
            </form>
        </div>      
    </main> 
    <footer>
        <?php
            if (isset($_SESSION['flash'])) {          // here for future development  
                echo '<div class="flash' . $_SESSION['flash']['type'] . '">';
                echo '<p>' . $_SESSION['flash']['message'] . '</p>';
                echo '</div';
                unset($_SESSION['flash']);
            } 
        ?> 
    </footer>     
</html>