<!DOCTYPE html>
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
    <script>
        $(document).ready(function () {

            $("#button1").click(function () {
            $("#div1").fadeToggle("slow");
            });


            $("#button2").click(function () {
            $("#div2").fadeToggle("slow");
            });

        });
    </script>

</head>

<body style="text-align:center">
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

        require 'vendor/autoload.php';
        $m = new MongoDB\Client("mongodb://127.0.0.1");
        //select database
        $db = $m->mymarketplacedb;

        //select collection
        $collection = $db->users;

        $cursor = $collection ->find( );

        $usersCount=0;
        foreach($cursor as $user){
            $usersCount++;
        }

        $collection = $db->partners;

        $cursor = $collection ->find( );

        $partnersCount=0;
        foreach($cursor as $user){
            $partnersCount++;
        }

        $collection = $db->products;

        $cursor = $collection ->find( );

        $productsCount=0;
        foreach($cursor as $user){
            $productsCount++;
        }
    
    ?>
    <div class="container" style="margin-top:2%">
        <div class="row justify-content-center">
            <div class="col-4">
                <div style="border-color:black;border-style:dotted">
                    <h3 style="text-align:center;margin-top:3%;">Number Of Users: <?php echo $usersCount; ?> </h3><hr/>
                    <h3 style="text-align:center">Number Of Partners: <?php echo $partnersCount; ?> </h3><hr/>
                    <h3 style="text-align:center">Number Of Products: <?php echo $productsCount; ?> </h3>
                </div>
            </div>
        </div>
    </div>

    <hr/>

    
    <h2>Manage Products</h2>
    <button id="button1">Click to See Options</button><br>
    <div id="div1" style="background-color:grey;display:none;color:black">
    <br/>
        <form method="post" action="manageProducts.php" > <button type="submit" class="btn btn-success" name="addBtn">Add Product</button> </form>
        <br/>
        <form method="post" action="manageProducts.php"> <button type="submit" class="btn btn-info" name="updateBtn">Update Product</button> </form>
        <br/>
        <form method="post" action="manageProducts.php"> <button type="submit" class="btn btn-danger" name="deleteBtn">Delete Product</button> </form>
        <br/>
    </div>

    <h2>Manage Partners</h2>
    <button id="button2">Click to See Options</button><br>
    <div id="div2" style="background-color:grey;display:none;color:black;">
    <br/>
        <form method="post" action="managePartners.php" > <button type="submit" class="btn btn-success" name="addBtn">Add Partner</button> </form>
        <br/>
        <form method="post" action="managePartners.php"> <button type="submit" class="btn btn-info" name="updateBtn">Update Partner</button> </form>
        <br/>
        <form method="post" action="managePartners.php"> <button type="submit" class="btn btn-danger" name="deleteBtn">Delete Partner</button> </form>
        <br/>
    </div>

</body>


</html>