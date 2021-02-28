<!DOCTYPE html>

<?php
    require 'vendor/autoload.php';
    $m = new MongoDB\Client("mongodb://127.0.0.1");
    //select database
    $db = $m->mymarketplacedb;
?>

<html>

<head>

    <title>MyMarketPlace</title>
    <meta charset="utf-8">
    <!-- BootStrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jquery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--My external css -->
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <!-- My external Js -->
    <script src="./js/main.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body style="text-align:center;">
<!--   NavBar start   -->

<nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#">myMarketplace</a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link" >Admins</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logOutAndRedirect.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>


    <!--   NavBar end   -->


 <?php
    if(isset($_POST['deleteBtn'])){
?>

  <h3>Type partners Id</h3>
    <form method="post">
        <input type="text" name="id" placeholder="Type Id here"/>
        <input type="submit" name="delete" value="Submit" class="btn btn-danger">
    </form>

<?php } ?>

<?php
    if(isset($_POST['addBtn'])){
?>

<form method="post">
    <p>--> Product Name</p>
    <input type="text" name="name" placeholder="Type name here"/><br/><br/>

    <p>--> Photo Url</p>
    <input type="text" name="photo" placeholder="Type photo here"/><br/><br/>

    <input type="submit" name="add" value="Submit" class="btn btn-warning">
</form>

<?php } ?>

<?php
    if(isset($_POST['updateBtn'])){
?>

<h3>Type product Id</h3>
    <form method="post">
        <input type="text" name="id" placeholder="Type Id here"/>
        <input type="submit" name="update" value="Submit" class="btn btn-info">
    </form>

<?php } ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
        </div>
    </div>
</div>

<!-- Functions -->
<?php
    if(isset($_POST['delete'])){
        //select collection
        $collection = $db->partners;

        $Id = $_POST['id'];

    //echo $_POST['orderID'];

    $cursor = $collection ->deleteMany( array( '_id' => new MongoDB\BSON\ObjectID($Id) ) );

     echo "<b>Partner Deleted Successfully</b><hr/><a href='adminHome.php'>Go Back To Menu</a>";
    }
?>

<?php
    if(isset($_POST['add'])){
        //select collection
        $collection = $db->partners;

        $doc = array(
            "name" => $_POST['name'] ,
            "photo" =>  $_POST['photo'] ,
            "comments" => array() ,
        );
    
        $collection -> insertOne($doc);

     echo "<b>Partner Added Successfully</b><hr/><a href='adminHome.php'>Go Back To Menu</a>";
    }
?>

<?php
    if(isset($_POST['update']))
    {
        //select collection
        $collection = $db->partners;

    $cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($_POST['id']) ) );

                foreach($cursor as $product){
                    echo "<b>Partner's Name : ".$product['name']."</b><br/>";
                }
?>

<form method="post">
    <input type='text' name='query' placeHolder='$collection->updateOne(!!!TYPE QUERY HERE!!!)' style='width:70%'>
    <input type="submit" value="Submit Changes" name="submitChanges" class="btn btn-warning"/>
</form>
<?php } ?>

<?php
    if( isset($_POST['submitChanges']) )
    {
        //select collection
        $collection = $db->partners;

        if( isset($_POST['query']) )
        {
        $collection->updateOne($_POST['query']);
        
        echo "<b>Partner Updated Successfully</b><hr/><a href='adminHome.php'>Go Back To Menu</a>";
        }
    }
?>


</body>


</html>