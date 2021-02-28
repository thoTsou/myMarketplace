<?php
session_start();
?>

<?php

//unset($_SESSION['cart']);

require 'vendor/autoload.php';
$m = new MongoDB\Client("mongodb://127.0.0.1");
//select database
 $db = $m->mymarketplacedb;
                        
 //select collection
$collection = $db->products;

$productId = $_POST['pID'];

$cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($productId) ) );

foreach($cursor as $product){
    //session
    if( !isset($_SESSION['cart'] ) )
    {
        $_SESSION['cart'] = array();
        array_push($_SESSION['cart'], array( "id" => $productId , "price" => $_POST['pPrice'] ) );
    } else {
        array_push($_SESSION['cart'], array( "id" => $productId , "price" => $_POST['pPrice'] ) );
    }

    //cookie
    if( !isset($_COOKIE['cart'] ) )
    {
        $cookieValue = array();
        array_push( $cookieValue , array( "id" => $productId , "price" => $_POST['pPrice'] ) );
        setcookie('cart' , json_encode($cookieValue) , time()+86400);
    } else {
        $cookieValue = json_decode($_COOKIE['cart'], true);
        array_push( $cookieValue , array( "id" => $productId , "price" => $_POST['pPrice'] ) );
        setcookie('cart' , json_encode($cookieValue) , time()+86400);
    }
}

//echo '<br/>'.count($_SESSION['cart']);

header("Location: marketPlaceProducts.php");

?>