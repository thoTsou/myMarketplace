<?php
session_start();
?>
<!-- set best price for every product -->
<?php

require 'vendor/autoload.php';
$m = new MongoDB\Client("mongodb://127.0.0.1");
//select database
$db = $m->mymarketplacedb;

//select collection
$collection = $db->products;

$cursor = $collection->find();

        foreach($cursor as $product){
            foreach($product['availability'] as $partner){
                //echo $available['price'];
                if($partner['price'] < $product['price'])
                {
                    $collection->updateOne( array("name"=>$product['name']) , array('$set'=>array("price"=>$partner['price'])));
                }
            }
        }
    ?>
<!-- which products to display -->
<?php
                
                $cursor = $collection->find();

                $products = array();

                if(isset( $_POST['category'] ) ){
                $_SESSION['category'] = $_POST['category'];
                }

                foreach($cursor as $doc){
                    if($doc['category'] == $_SESSION['category'])
                    {
                    array_push($products,$doc);
                    //echo($doc['name']);
                    }
                }
                
        ?>

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
    <link rel="stylesheet" type="text/css" href="./css/products.css">
    <!-- My external Js -->
    <script src="./js/main.js"></script>

    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
        .fa {
        padding: 0px;
        font-size: 17px;
        width: 25px;
        text-align: center;
        text-decoration: none;
        margin: 2px 2px;
        border-radius: 20px;
        }

        .fa1 {
        padding: 5px;
        font-size: 25px;
        width: 50px;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fa-facebook {
        background: #3B5998;
        color: white;
        }

        .fa-twitter {
        background: #55ACEE;
        color: white;
        }

        .fa-instagram {
        background: white;
        color: red;
        }

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
    <!-- Angularjs -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body ng-app="myApp" ng-controller="namesCtrl" >
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
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shoppingCartCopy.php">My Cart<i class="fa fa-shopping-cart" style="font-size:200%"></i></a>
                </li>
                <li class="nav-item">
                <input class="form-control mr-sm-2" type="search" placeholder="Find Product" aria-label="Search" ng-model="searchProduct" />
                </li>
            </ul>
        </div>
    </nav>


    <!--   NavBar end   -->

        <!--   angular search   -->
        <script>
        angular.module('myApp', []).controller('namesCtrl', function($scope)
        {
            $scope.products = <?php echo json_encode($products); ?>;
        });
    </script>
    <!--   angular search   -->
    

    <!-- Products List -->
    <div class="container py-5">
        <div class="row text-center text-white mb-5">
            <div class="col-lg-7 mx-auto">
                <h1 class="display-4" style="color:black;">Products</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- List group-->
                <ul class="list-group shadow">
                    <!-- list group item-->
                    
                    <li class="list-group-item" ng-repeat="x in products | filter:{name:searchProduct}">

                        <!-- Custom content-->
                        <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                            <div class="media-body order-2 order-lg-1">
                                <h5 class="mt-0 font-weight-bold mb-2">{{x.name}}</h5>
                                <p class="font-italic text-muted mb-0 small">{{x.smallDescr}}</p>
                                <div class="d-flex align-items-center justify-content-between mt-1">
                                    <ul class="list-inline small">
                                        
                                        <li class="list-inline-item m-0" ng-repeat="y in [].constructor(x.rating) track by $index">
                                            <i class="fa fa-star text-success"></i>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div><img src="{{x.photo}}" alt="Generic placeholder image" width="100"
                                class="ml-lg-5 order-1 order-lg-2">
                        </div>

                        <div style="margin-top:-3%;margin-bottom:2%;">
                            <b><u>Best Price Available : {{x.price}} €</u></b>
                        </div>
                        
                        <form method="post" action="productDetails.php"><button type="submit" class="btn btn-success">Product Details</button> 
                            <input type="hidden" name="productId" value="{{x._id}}" />
                        </form> <!-- End -->
                        
                    </li> <!-- End -->

                    
                </ul> <!-- End -->
            </div>
        </div>
    </div>

    <!-- footer start  -->
    <footer class="page-footer" id="footer" style="padding-top: 15px;padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Find Us On Social !</h6>
                    <p>Facebook -> <a href="#" class="fa fa-facebook fa1" ></a></p>
                    <p>Instagram -> <a href="#" class="fa fa-instagram fa1" ></a></p>
                    <p>Twitter -> <a href="#" class="fa fa-twitter fa1" ></a></p>
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