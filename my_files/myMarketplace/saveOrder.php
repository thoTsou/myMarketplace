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

    $fullName = $_POST['fullName'];
    $address = $_POST['addressLine1'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];

    echo $_SESSION['productsInCart'][0];

    $productsOfOrder = array();

    $PRODUCTS = json_decode($_COOKIE['cart'], true);

    $counter=0;

    for ($x = 0; $x < count($PRODUCTS) ; $x++) {
        array_push( $productsOfOrder , array( "productId" => $PRODUCTS[$x]['id'] , "price" =>  $PRODUCTS[$x]['price']  ,"quantity" => $_SESSION['productsInCart'][$counter] ) );
        $counter++;
    }

    $doc = array(
        "fullName" => $fullName ,
        "address" => $address ,
        "city" => $city ,
        "region" => $state ,
        "postcode" => $postcode ,
        "email" => $email ,
        "phoneNumber" => $phoneNumber ,
        "products" => $productsOfOrder ,
        "date" => new \MongoDB\BSON\UTCDateTime(time()*1000) ,
    );

    $collection -> insertOne($doc);

    $_SESSION = array();
	session_destroy();

    header("Location: frontPage.html");

?>