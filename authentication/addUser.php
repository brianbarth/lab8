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
        <h2>Add an authorized user</h2>
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
    <div> 
        <h2>List of approved users</h2>
        <table>
            <tr>
                <th>User</th>
            </tr>            
            <?php $user = Users::open($_POST); ?>   <!-- populates user table -->
            <?php foreach ($user as $foo) : ?>
                <tr>
                <?php echo "<td>" . $foo->username . "</td>"; ?>                                            
                <td><span><a href="deleteUser.php?id=<?php echo $foo->id ?>">DEL</a></span></td>
                </tr>                       
            <?php endforeach ?>            
        </table>
        </div>
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