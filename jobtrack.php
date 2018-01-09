<?php
    /*
        create inputs for jobTitle, busName, location, webAddr, pay, date, other
        
        submit btn adds post data to db
    */
    require 'dbconnect.php';// $connection
/*   if (!$dbs) {
        echo 'No Connection';
        die();
    }
*/
    $dbname = 'jobs';//'test';//  database
    $tbl = 'joblist';//'users';// collection
//echo json_encode($_POST['webAddr']);// Response:  "http:\/\/getslingshot.com\/developer\/"
//Response:  {"jobTitle":"Website Designer","busName":"Slingshot","location":"none","webAddr":"","pay":"","date":"2018-01-08","other":""}

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
        //echo json_encode($entry);
        echo "completed";

    } catch(MongoDB\Driver\Exception\BulkWriteException $e) {
        echo json_encode($e->getWriteResult()->getWriteErrors()[0]->getMessage());
    }

?>