<?php session_start(); ?>

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

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .fa1 {
            padding: 5px;
            font-size: 25px;
            width: 50px;
        }
    </style>

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
            </ul>
        </div>
    </nav>

    <!--   NavBar end   -->

    <!-- Categories -->
    <div class="container" style="margin-top:5%">
        <div class="row justify-content-around">
            <div class="col-lg-5 col-md-3 col-sm-12">
                <div class="card" style="width: 21rem;">
                    <img class="card-img-top" src="./pics/mobile.png" alt="Card image cap" style="width:21%;height:21%;margin-left:38%"> 
                    <div class="card-body">
                        <h5 class="card-title">Mobile Phones</h5>
                        <p class="card-text">Search through a variety of mobile phones</p>
                        <form method="post" action="marketPlaceProducts.php">
                            <input type="submit" class="btn btn-success" value="See Products">
                            <input type="hidden" name="category" value="mobilePhone" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-3 col-sm-12">
                <div class="card" style="width: 21rem;">
                    <img class="card-img-top" src="./pics/laptop.jpg" alt="Card image cap" style="width:50%;height:50%;margin-left:25%">
                    <div class="card-body">
                        <h5 class="card-title">Laptops</h5>
                        <p class="card-text">Find the one that fits your needs</p>
                        <form method="post" action="marketPlaceProducts.php">
                            <input type="submit" class="btn btn-success" value="See Products">
                            <input type="hidden" name="category" value="laptop" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer start  -->
    <footer class="page-footer" id="footer" style="padding-top: 15px;padding-bottom: 0px;margin-top:9%">
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