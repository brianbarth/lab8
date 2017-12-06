<?php 

 class NewProduct {

    private static $db = null;

    private static function init_db() {
        if ( self::$db == null ) {
            self::$db = new PDO( "mysql:host=localhost:3306;dbname=php","biag","1234" );
            self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
        }
    } // end of init_db()

    public function __construct($data = null) {
        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->price = $data['price'];
        }
    } // end of construct()

    public function open($info) {
        self::init_db();

        $result = self::$db->query('select * from products'); 
    
        while ( $record = $result->fetch() ) {
           
            $itemInfo = new NewProduct(array( 'id'=>$record[0], 'name'=>$record[1], 'description'=>$record[2], 'price'=>$record[3] ));

            $info[$itemInfo->id] = $itemInfo;
        }                      

        return $info;  
    }  // end of open()

    public function remove( $hotID ) {   
        self::init_db();

        $stment = self::$db->prepare(' delete from products where id=:id' );
        $stment->execute( array('id' => $hotID ) );
     
        header ('location: index.php');
        exit;
         
    }  // end of remove()

    public function update( $data ) {
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        
        self::init_db();
        
        $stment = self::$db->prepare( 'update products set name=:name, description=:description, price=:price where id=:id'  );
        $stment->execute( array( 'id' => $this->id, 'name' => $this->name, 'description' => $this->description, 'price' => $this->price ) );

    } // end of update()

    public function find( $hotID ) {
        self::init_db();
        $result = self::$db->query("select * from products where id=$hotID");
        $record = $result->fetch();
        $info = new NewProduct(array( 'id'=>$record[0], 'name'=>$record[1], 'description'=>$record[2], 'price'=>$record[3] ));
       
        return $info;
    } // end of find()

    public function validate($data) {

        $errors = array();
        
        if (empty($data['name'])) {
            $errors['name'] = "Item cannot be left blank!";
        }
        if (empty($data['description'])) {
            $errors['description'] = "Description cannot be left blank!";
        }
        if (empty($data['price'])) {
            $errors['price'] = "Price cannot be left blank!";
        } else if (! is_numeric($data['price'])) {
            $errors['number'] = "Price must only be numeric!";
        }
        
        return $errors;

    }   //end of validate()

    public function append( $info ) {   //function for new product creation
        self::init_db();

        $stment = self::$db->prepare( 'insert into products (name, description, price) values (:name, :description, :price)' ); // framework for sql statement
        $stment->execute( array( 'name' => $_POST['name'], 'description' => $_POST['description'], 'price' => $_POST['price'] ) );
        $lastID = self::$db->lastInsertId();

        header( "location: index.php?id=" . $lastID );
        exit;

    }  //end of append function

 } // end of NewProduct class
?>