<?php
    session_start();
    require('lib/NewProducts.php');
    require('lib/Flash.php');
   
    $info = NewProduct::find( $_GET['id'] );

    if (! $info) {                     //is there a product? creates error message and redirects
        Flash::set_alert("The product could not be found");
        header ("location: index.php");
        exit;
    }
    
    if ( sizeof($errors) == 0 ) {
        $id = $info->id;
        $itemname = $info->itemname;
        $description = $info->description;
        $price = $info->price;                   
    }   
       
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        
        $errors = NewProduct::validate($_POST); //validation

        if ( sizeof($errors) === 0) {  
            $info->update($_POST); // update function to write new data to db       
            Flash::set_notice("The Product was updated!");         
            header( "location: index.php?id=" . $info->id ); // redirects after writing 
            exit;
            
        } else {
            echo "<div class='container text-center'>";
            echo "<div class='alert alert-danger'role='alert'>";
            foreach ($errors as $foo) {         // validation-- prints error messages
                echo $foo . "</br>";
            }
            echo "</div>";
            echo "</div>";

            $itemname = isset($_POST['itemname']) ? $_POST['itemname'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="style/mystyles.css" type="text/css">
</head>
<header>
    <div class="container">
        <div class="jumbotron text-center">
        <h1>Biag's Store</h1>
        </div>
    </div>
    <div class="container">
        <div id="nav" class="container well-sm text-right" style="background-color: #e3f2fd;">
            <a href='index.php'>HOME</a>
        </div>
    </div>
</header> 
<main>
    <div class="container">
        <h2>Update Product</h2>
    </div>
    <div class="container">
        <form action="edit.php?id=<?php echo $info->id ?>" method='post'>
        <?php   if ( isset( $errors['itemname'])) {
                        echo "<div class='form-group id='eb'>";
                    } else {
                        echo "<div class='form-group'>";
                    }
        ?>ITEM: <input class="form-control" type='text' name='itemname' id='itemname' value="<?php echo $itemname ?>"></p>
        <?php   if ( isset( $errors['description'])) {
                        echo "<div class='form-group id='eb'>";
                    } else {
                        echo "<div class='form-group'>";
                    }
        ?>DESCRIPTION: <input class="form-control" type='text' name='description' id='description' value="<?php echo $description ?>"></p>
        <?php   if ( isset( $errors['price'])) {
                        echo "<div class='form-group id='eb'>";
                    } else {
                        echo "<div class='form-group'>";
                    }
        ?>PRICE: <input class="form-control" type='text' name='price' id='price' value="<?php echo $price ?>"> </p>
            <button class="btn btn-primary" type='submit'>Update</button>
        </form>
    </div>
</main>
<footer>
</footer> 
</html>