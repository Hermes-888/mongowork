<?php
    /*
    https://github.com/mongodb/mongo-php-library
    installed with composer require mongodb/mongodb
    
    I cannot access the DB with php or Compass, unless I manually run mongod in the console first
    
    http://php.net/manual/en/mongo.tutorial.connecting.php
    //$connection = new MongoClient(); // connects to localhost:27017
    //$connection = new MongoClient( "mongodb://example.com" ); // connect to a remote host (default port: 27017)

    https://www.mongodb.com/blog/post/mongodb-for-the-php-mind-part-1
    
    Installed MongoDB Community 3.6 with .msi in C:/xampp/
    Finally got mongo to show up in phpinfo. using driver: php_mongodb-1.3.4-7.0-ts-vc14-x86
    https://learnedia.com/install-mongodb-configure-php-xampp-windows/
    
    Fatal error: Uncaught MongoDB\Driver\Exception\ConnectionTimeoutException: No suitable servers found (`serverSelectionTryOnce` set): [connection refused calling ismaster on 'localhost:27017'] in C:\xampp\vendor\mongodb\mongodb\src\Collection.php:793
    Stack trace: #0 C:\xampp\vendor\mongodb\mongodb\src\Collection.php(793): MongoDB\Driver\Manager->selectServer(Object(MongoDB\Driver\ReadPreference)) #1 C:\xampp\htdocs\work\mongdemo\mongconnect.php(41): MongoDB\Collection->insertOne(Array) #2 {main} thrown in C:\xampp\vendor\mongodb\mongodb\src\Collection.php on line 793
    
    start MongoDB with terminal first.
    */

    //https://secure.php.net/manual/en/mongodb.tutorial.library.php
    // This path should point to Composer's autoloader
    require '../../../vendor/autoload.php';// verified
    $connection = new MongoDB\Client("mongodb://localhost:27017");
// or require 'dbconnect.php';

    $dbname = 'test';
    $db = $connection->$dbname;//document
    $collection = $db->users;//  collection
    // or, directly selecting a document and collection:
    //$collection = $connection->dbname->users;
    $user = array(
        'first_name' => 'MongoDB',
        'last_name' => 'Fan',
        'tags' => array('developer','user')
    );
    // Insert this new document into the users collection
    $collection->insertOne($user);
    
    
    //the driver automatically pushes the generated _id to the given document. After saving, you can directly access the created _id:
    var_dump($users['_id']);// id is the primary key
    
    echo "<br><br>";
    $document = $collection->findOne();
    var_dump( $document );
    
    echo "<br><br>Count: ";
    echo $collection->count();
    
    $cursor = $collection->find();
    foreach ( $cursor as $id => $value )
    {
        echo " $id: ";
        var_dump( $value );
    }
    
    /*
        https://docs.mongodb.com/manual/reference/sql-comparison/
        SELECT id, user_id, status FROM people
            SAME AS
        db.people.find(
            { },
            { user_id: 1, status: 1 }
        )

        $query = array( 'i' => 71 );
        $cursor = $collection->find( $query );

        while ( $cursor->hasNext() )
        {
            var_dump( $cursor->getNext() );
        }
    */

