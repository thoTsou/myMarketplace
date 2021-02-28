<?php
session_start();
?>

<?php 

    require 'vendor/autoload.php';
    $m = new MongoDB\Client("mongodb://127.0.0.1");
    //select database
    $db = $m->mymarketplacedb;

    //select collection
    $collection = $db->users;
    
    //check user credentials
	$password = 0;
	$email = 0;
	
	if(isset($_POST['password'])  && isset($_POST['email']))
	{
	$password = $_POST['password'];
	$email = $_POST['email'];
	}
	
	
	if( $email=='admin@admin' && $password=='admin' )
	{
		header("Location: adminHome.php");
	}
    
    $cursor = $collection ->find();
    $userFound = false;

    foreach($cursor as $doc){
        if($doc['email'] == $email){
            $userFound = true;
            $userEmail = $doc['email'];
            $userPassword = $doc['password'];
            $user = $doc['username'];
        }
    }
	
		
		if($userFound == false ){  //user with this email does not exist
			echo "<br>";
			echo "User with given email does not exist.Please go back and try again";
			echo "<br><br>";
			echo "<a href='loginPage.html'>=>Try Again</a>";
		}else if($password != $userPassword && $userFound == true ) //if user exists check his/her password
		{
			echo "<br>";
			echo "Wrong Password.Please try again";
			echo "<br><br>";
			echo "<a href='loginPage.html'>=>Try Again</a>";
		}else
		{
			$_SESSION["username"] = $user;
			$_SESSION["userEmail"] = $userEmail; 
			header("Location: categories.php");
		
		}
			
		
?>