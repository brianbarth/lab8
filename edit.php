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
            Flash::set_notice("The Book was updated!");         
            header( "location: index.php?id=" . $info->id ); // redirects after writing 
            exit;
            
        } else {
            foreach ($errors as $foo) {         // validation-- prints error messages
                echo "<div class='errorBox'>" . "<p class='errorPrint'>" . $foo . "</br>" . "</p></div";
            }
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
</head>
<header>
    <h1>Biag's Store</h1>
    <a href='index.php'>HOME</a>
</header> 
<main>
    <h2>Update Product</h2>
    <form action="edit.php?id=<?php echo $info->id ?>" method='post'>
        <p>ITEM: <input type='text' name='itemname' id='itemname' value="<?php echo $itemname ?>"></p>
        <p>DESCRIPTION: <input type='text' name='description' id='description' value="<?php echo $description ?>"></p>
        <p>PRICE: <input type='text' name='price' id='price' value="<?php echo $price ?>"> </p>
        <input type='submit' value='Update'> 
    </form>
</main>
<footer>
</footer> 
</html>