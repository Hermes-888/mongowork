<?php
    /*
        https://docs.mongodb.com/php-library/current/tutorial/crud/
        retrieve all documents in collection
    */
    require 'dbconnect.php';
    //var_dump($dbs);

    $dbname = 'jobs';//'test';//document
    $tbl = 'joblist';//'users';
    $collection = $connection->$dbname->$tbl;
    $cursor = $collection->find();// all

    /*
        put the documents in a new array
    */
    $entry = array();
    foreach ( $cursor as $id => $value )
    {
        //echo " $id: ";
        //var_dump( $value );
        //echo "<br><br>";
        //echo json_encode($value);
        //echo $value->business .' : '. $value->title .' : '. $value->location;
        
        //$ent = '<h3>'.$value->business.'</h3>';
        //$ent .= $value->title .' : '. $value->location;
        //echo $ent . '<br><br>';
        array_push($entry, $value);
    }
    
    // Sort the array of objects by location
     usort($entry, "sortByLocation");
     // Define the custom sort function
     function sortByLocation($a, $b) {
          return $a['location']>$b['location'];
     }
    echo json_encode($entry);
?>