<?php

require 'vendor/autoload.php';
$m = new MongoDB\Client("mongodb://127.0.0.1");
//select database
$db = $m->mymarketplacedb;

//select collection
$collection = $db->getInTouchMessages;

if( isset($_POST['email']) )
	{
    $email = $_POST['email'];
    }
    
    $doc = array(
        "newsletterMember" => $email ,
    );
    
    $collection -> insertOne($doc);
    
    header("Location: frontPage.html");



?>