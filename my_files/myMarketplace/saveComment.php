<?php
session_start();
?>

<?php

    require 'vendor/autoload.php';
    $m = new MongoDB\Client("mongodb://127.0.0.1");
    //select database
    $db = $m->mymarketplacedb;

    //select collection
    $collection = $db->products;

    $productId = $_POST['productID'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    $cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($productId) ) );


    $comm = array(
        "comment" => $comment,
        "rating" => $rating,
        "username" => $username ,
    );

    $newCommentsArray = array();

    foreach($cursor as $product){
        foreach($product['comments'] as $comment){
            //echo $comment['comment'];
            //echo $comment['username'];
            $x = array(
                "comment" => $comment['comment'],
                "rating" => $comment['rating'],
                "username" => $comment['username'],
            );
            array_push($newCommentsArray , $x);
        }
        
    }

    array_push($newCommentsArray , $comm);

    $collection -> updateOne( array( '_id' => new MongoDB\BSON\ObjectID($productId) )  , array('$set'=> array("comments" => $newCommentsArray) ) )  ;

    echo "done";
    //echo $newCommentsArray[1]['comment'];
    header("Location: marketPlaceProducts.php");

?>