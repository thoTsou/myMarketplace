<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>

    <title>MyMarketPlace</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootStrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jquery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!--My external css -->
    <link rel="stylesheet" type="text/css" href="./css/productDetails.css">
    <!-- My external Js -->
    <script src="./js/main.js"></script>

    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }

        /*--- fonts awesome ---*/


        .fa-facebook {
            background: #3B5998;
            color: white;
            padding: 10px;
            font-size: 30px;
            width: 50px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 20px;
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
            padding: 10px;
            font-size: 30px;
            width: 50px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 20px;
        }

        .fa-instagram {
            background: white;
            color: red;
            padding: 10px;
            font-size: 30px;
            width: 50px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 20px;
        }

        .fa1 {
            padding: 5px;
            font-size: 25px;
            width: 50px;
        }

        /*--- footer ---*/
        .page-footer {
            background-color: #222;
            color: #ccc;
            padding: 60px 0 30px;
        }

        .footer-copyright {
            color: #666;
            padding: 40px 0;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <script>
                $(document).ready(function(){
                $("#i1").click(function(){
                    //alert('clicked');
                    $("#menu1").css("display", "inline");
                });
                });
    </script>

</head>

<body>
    <!--   NavBar start   -->

    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="frontPage.html">myMarketplace</a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php if( isset($_SESSION['username']) ){ ?>
                    <a class="nav-link">User:
                        <?php echo $_SESSION['username']; ?>
                    </a>
                    <?php }else{ $_SESSION['username'] = 'guest'; ?>
                    <a class="nav-link" disabled>Guest
                    </a>
                    <?php } ?>
                </li>
                <?php if( $_SESSION['username'] !== 'guest' ){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="logOutAndRedirect.php">Log Out</a>
                </li>
                <?php } ?>
                <?php if( $_SESSION['username'] !== 'guest' ){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="userOrdersHistory.php">History</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="shoppingCartCopy.php">My Cart<i class="fa fa-shopping-cart"
                            style="font-size:200%"></i></a>
                </li>

            </ul>
        </div>
    </nav>


    <!--   NavBar end   -->
    <div style="text-align:center;margin-top:1%">
        <a href="marketPlaceProducts.php" class="btn btn-success">Back To Products</a>
    </div>

    <!--   product card start   -->

    <div class="container">
        <?php 
                         require 'vendor/autoload.php';
                        $m = new MongoDB\Client("mongodb://127.0.0.1");
                        //select database
                        $db = $m->mymarketplacedb;
                        
                        //select collection
                        $collection = $db->products;

                        $productId = $_POST['productId'];
                        //echo gettype($productId).'<br/>';
                        //echo $productId[strlen($productId)-3];

                        $id='';
                        for ($x = 9; $x <=strlen($productId)-3 ; $x++) {
                            $id = $id.$productId[$x];
                        }
                        
                        $productId = $id;

                        $cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($productId) ) );

                        foreach($cursor as $product){
                            //$rating=$product['rating']; 
                            $rating = 0;
                            $reviews = 0;
                            $sum=0;
                            foreach($product['comments'] as $comment){
                                $reviews++;
                                $sum = $sum + $comment['rating'];
                            }
                            $rating = (int)($sum/$reviews);
                            $collection ->updateOne( array( '_id' => new MongoDB\BSON\ObjectID($productId)) , array('$set'=>array("rating"=>$rating)) );
                            
?>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img id="image"
                                    src="<?php echo $product['photo']; ?>" style="height:40% ; width:40%" /></div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">

                        </ul>

                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">Product:
                            <?php echo $product['name']; ?>
                        </h3>
                        <div class="rating">
                            <div class="stars">
                                <?php for ($count = 0; $count < $rating; $count++) {  ?>
                                <span class="fa fa-star checked"></span>
                                <?php } ?>
                            </div>
                            <span class="review-no">number of reviews :
                                <?php echo $reviews; ?>
                            </span>
                        </div>
                        <p class="product-description">
                            <?php echo $product['smallDescr']; ?>
                        </p>
                        <h4 class="price">Check below for the best price !<span>
                            </span></h4>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <!--   product card end   -->

    <!-- tabs section start -->
    <br>

    <div class="container">
        <h2>Availability and Comments</h2>
        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" style="color:blue">Availability</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#menu1" style="color:blue" id='i1'>Check Comments</a>
            </li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
                <?php 
    $cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($productId) ) );
    foreach($cursor as $product){
                foreach($product['availability'] as $shop){

    ?>
                <h3>
                    <u><?php echo $shop['partnerName'] ?></u>
                </h3><!-- Availability -->
                <p> Availability :
                    <?php echo $shop['yes/no'] ?>
                </p>
                <p> Price :
                    <?php echo $shop['price'] ?> €
                </p>
                <form method="post" action="sessionCart.php"> <button type="submit" class="btn btn-info">Add to
                        cart</button><input type="hidden" name="pID" value="<?php echo $product['_id']; ?>" /> <input
                        type="hidden" name="pPrice" value="<?php echo $shop['price']; ?>" /> </form><br />
                <hr />
            </div>
            <?php }} ?>
            <div id="menu1" class="container tab-pane fade" style="display:none" ><br>

                <!-- Comments -->
                <h4>Insert your comment</h4>
                <form method="post" action="saveComment.php">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Your comment</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter comment" name="comment">
                    </div>
                    <div class="form-group" ng-app="myApp" ng-controller="myCtrl">
                        <label for="exampleInputPassword1">Rating</label>
                        (1-5 stars)
                        <input type="number" name="rating" min="1" max="5" ng-model="stars"
                            ng-change="myFunc()" /><br />

                        <span>{{rating}}</span>

                        <script>
                            var app = angular.module("myApp", []);
                            app.controller("myCtrl", function ($scope) {
                                $scope.rating = 0;

                                $scope.myFunc = function () {

                                    if ($scope.stars === 1) {
                                        $scope.rating = '★';
                                    } else if ($scope.stars === 2) {
                                        $scope.rating = '★★';
                                    } else if ($scope.stars === 3) {
                                        $scope.rating = '★★★';
                                    } else if ($scope.stars === 4) {
                                        $scope.rating = '★★★★';
                                    } else if ($scope.stars === 5) {
                                        $scope.rating = '★★★★★';
                                    }
                                };

                            });
                        </script>

                    </div>

                    <input type="hidden" value="<?php echo $productId; ?>" name="productID" />
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

                <hr />
                <h4>All comments</h4>
                <?php 
    $cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($productId) ) );
    foreach($cursor as $product){
                foreach($product['comments'] as $comment){

    ?>
                <p>User :
                    <?php echo $comment['username'] ?>
                </p>
                <p>
                    <?php echo $comment['comment'];  ?>
                </p>
                <p>Rating :
                    <?php for ($count = 0; $count < $comment['rating']; $count++) {  ?>
                    <span class="fa fa-star checked"></span>
                    <?php } ?>
                </p>
                <hr />
                <?php }} ?>
            </div>
        </div>

    </div>

    <!-- tabs section end -->


    <!-- footer start  -->
    <footer class="page-footer" id="footer" style="padding-top: 15px;padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Find Us On Social !</h6>
                    <p>Facebook -> <a href="#" class="fa fa-facebook fa1"></a></p>
                    <p>Instagram -> <a href="#" class="fa fa-instagram fa1"></a></p>
                    <p>Twitter -> <a href="#" class="fa fa-twitter fa1"></a></p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Contact</h6>
                    <p>Piraeus
                        <br />tsoufis.thodoris@gmail.com
                        <br />210ΧΧΧΧΧΧΧ
                        <br />69ΧΧΧΧΧΧΧΧ
                    </p>
                </div>
            </div>
            <div class="footer-copyright text-center">© 2020 Copyright: ΤΣΟΥΦΗΣ ΘΟΔΩΡΗΣ</div>
        </div>
    </footer>

    <!-- footer end -->
</body>


</html>