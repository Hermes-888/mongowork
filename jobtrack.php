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
    
    $collection = $connection->$dbname->$tbl;
    
    try {
        if (isset($_POST['toggle'])) {
            // Insert this new document into the collection
            $collection->insertOne($entry);
            //echo json_encode($entry);
            echo "insert one";
        } else {
            //find by _id 
            // http://php.net/manual/en/class.mongodb-bson-objectid.php
            
// https://stackoverflow.com/questions/34474248/mongodb-php7-update-document-by-id
//collection->updateOne(['_id' => new \MongoDB\BSON\ObjectID('567eba6ea0b67b21dc004687')], ['$set' => ['some_property' => 'some_value']]);
            $document = $collection->updateOne(
                ["_id" => new MongoDB\BSON\ObjectID($_POST['oid'])],
                ['$set' => $entry]
            );// not returned
            
            $document = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($_POST['oid'])]);
            echo "saved ". json_encode($document);
        }

    } catch(MongoDB\Driver\Exception\BulkWriteException $e) {
        echo json_encode($e->getWriteResult()->getWriteErrors()[0]->getMessage());
    }

?>