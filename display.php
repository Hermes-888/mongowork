<?php
    /*
        https://docs.mongodb.com/php-library/current/tutorial/crud/
        
    */
    require 'dbconnect.php';
//var_dump($dbs);

    $dbname = 'jobs';//'test';//document
    $tbl = 'joblist';//'users';
    $collection = $connection->$dbname->$tbl;
    
    echo "<br><br>Count: ";
    echo $collection->count();
    echo '<br>';
    
    $cursor = $collection->find();
    foreach ( $cursor as $id => $value )
    {
        //echo " $id: ";
        //var_dump( $value );
        //echo "<br><br>";
        //echo json_encode($value);
        //echo $value->business .' : '. $value->title .' : '. $value->location;
        
        $ent = '<h3>'.$value->business.'</h3>';
        $ent .= $value->title .' : '. $value->location;
        echo $ent;
        echo '<br><br>';
    }
    
    
//    $document = $collection->findOne(['business' => 'Jolt']);// first one or where
//    echo '<br><br>encoded: '.json_encode($document);
    
    