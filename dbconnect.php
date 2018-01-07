<?php
    /*
        http://php.net/manual/en/mongodb.tutorial.library.php
        
        DB connection
        start MongoDB with terminal first.
    cd mongodb/server/3.6/bin/mongod.exe --bind_ip_all
    
// Specifying the username and password in the connection URI (preferred)
$m = new MongoDB\Client("mongodb://${username}:${password}@localhost");

// Specifying the username and password via the options array (alternative)
$m = new MongoDB\Client("mongodb://localhost", array("username" => $username, "password" => $password));
    */

    //https://secure.php.net/manual/en/mongodb.tutorial.library.php
    // This path should point to Composer's autoloader
    require '../../../vendor/autoload.php';// verified

    $dbhost = 'localhost';// 127.0.0.1:27017
    $connection = new MongoDB\Client("mongodb://localhost:27017");
    //$connection = new MongoDB\Client("mongodb://".$dbhost);

try
{
    $dbs = $connection->listDatabases();
}
catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e)
{
    // PHP cannot find a MongoDB server using the MongoDB connection string specified
    var_dump($e);
    die();
}
