<?php
    /*
        create inputs for jobTitle, busName, location, webAddr, pay, date, other info 
        
        submit btn addspost data to db
    */
    require 'dbconnect.php';// $connection
/*   if (!$dbs) {
        echo 'No Connection';
        die();
    }
*/
    $dbname = 'jobs';//'test';//  database
    $tbl = 'joblist';//'users';// collection
    
//var_dump($_POST);
    $entry = array(
        'business' => $_POST["busName"],
        'title' => $_POST["jobTitle"],
        'location' => $_POST["location"],
        'url' => $_POST["webAddr"],
        'date' => $_POST["date"],
        'pay' => $_POST["pay"],
        'other' => $_POST["other"]
    );// document

    //$connection = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $connection->$dbname->$tbl;
    //$collection = (new MongoDB\Client)->$dbname->$tbl;// navigation topology was destroyed
    // Insert this new document into the collection
    //$collection->insertOne($entry);

    try {
        $collection->insertOne($entry);
    } catch(MongoDB\Driver\Exception\BulkWriteException $e) {
        var_dump($e->getWriteResult()->getWriteErrors()[0]->getMessage());
        die();
    }

//echo json_encode($entry);
    //return json_encode($entry);
//    return "entry completed: ".$collection->count();
    echo "completed";
//die();
?>