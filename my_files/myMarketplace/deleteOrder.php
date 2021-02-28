<?php
session_start();
?>

<?php

    require 'vendor/autoload.php';
    $m = new MongoDB\Client("mongodb://127.0.0.1");
    //select database
    $db = $m->mymarketplacedb;

    //select collection
    $collection = $db->orders;

    $orderID = $_POST['orderID'];

    //test
    $presentTime = new \MongoDB\BSON\UTCDateTime(time()*1000) ;
    $presentTime = $presentTime ->toDateTime();

    $cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($orderID) ) );

    foreach($cursor as $ORDER){
        $ORDERdate = $ORDER['date'];
        $ORDERdate = $ORDERdate ->toDateTime();
        
        $interval = $ORDERdate->diff($presentTime);

        $differnceInDays = $interval->format('%a');

        //echo $differnceInDays;

        if($differnceInDays == 0){
            //echo 'true';
            $collection ->deleteMany( array( '_id' => new MongoDB\BSON\ObjectID($orderID) ) );
            header("Location: userOrdersHistory.php");
        }else{
            echo '<b>You can <u>not</u> delete this order</b><br/><a href="userOrdersHistory.php">Go Back To History</a>';
        }
    }
    //test

    //$cursor = $collection ->deleteMany( array( '_id' => new MongoDB\BSON\ObjectID($orderID) ) );


    

?>