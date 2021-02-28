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
    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .fa1 {
        padding: 5px;
        font-size: 25px;
        width: 50px;
        }
    </style>

</head>

<body ng>

    <!--   NavBar start   -->

    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="frontPage.html">myMarketplace</a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#footer">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="loginPage.html">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Shop As Guest</a>
                </li>
            </ul>
        </div>
    </nav>


    <!--   NavBar end   -->

    <h2 style="text-align:center">Our Partners</h2>
    <?php 
    
    require 'vendor/autoload.php';
    $m = new MongoDB\Client("mongodb://127.0.0.1");
    //select database
    $db = $m->mymarketplacedb;

    //select collection
    $collection = $db->partners;

    $cursor = $collection ->find();

    foreach($cursor as $partner){
    
    ?>
    <div class="card" style="width: 50%;margin-left:25%;">
        <img class="card-img-top" src="<?php echo $partner['photo'] ?>" alt="Card image cap" style="width:30%;height:30%;border-color:grey;border-style:solid;margin-left:5%">
        <div class="card-body">
            <h5 class="card-title"><?php echo $partner['name'] ?></h5>
            <p class="card-text">Leave your comment...</p>
            <!-- form -->
            <form method="post" action="saveComment2.php">

                <div class="form-group">
                    <label for="exampleInputEmail1">Your comment</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter comment" name="comment">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter username" name="username">
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

                <input type="hidden" value="<?php echo $partner['_id']; ?>" name="partnerId" />
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            <!-- form -->
        </div>
    </div>
    <hr/>
    <?php } ?>

    <!-- footer start  -->
    <footer class="page-footer" id="footer" style="padding-top: 15px;padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Find Us On Social !</h6>
                    <p>Facebook -> <a href="#" class="fa fa-facebook fa1" id="fa"></a></p>
                    <p>Instagram -> <a href="#" class="fa fa-instagram fa1" id="fa"></a></p>
                    <p>Twitter -> <a href="#" class="fa fa-twitter fa1" id="fa"></a></p>
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