<?php

    require 'vendor/autoload.php';
    $m = new MongoDB\Client("mongodb://127.0.0.1");
    //select database
    $db = $m->mymarketplacedb;

    //select collection
    $collection = $db->users;

    if(isset($_POST['password'])  && isset($_POST['email']) && isset($_POST['username'])&& isset($_POST['fullName'])  )
	{
	$password = $_POST['password'];
    $email = $_POST['email'];
    $username = $_POST['username'];
	$fullName = $_POST['fullName'];
    }
    
    $doc = array(
        "username" => $username ,
        "email" => $email ,
        "password" => $password ,
        "fullName" => $fullName ,
    );
    
    $collection -> insertOne($doc);
    
    header("Location: frontPage.html");


?>