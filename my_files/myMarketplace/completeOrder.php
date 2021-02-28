<?php
session_start();
?>

<?php

    //$prQuantities = array()

    //echo $_POST['productsCount'];

    $counter = $_POST['productsCount'];
    $prQuantities = array();

    for ($x = 0; $x < $counter ; $x++) {

        $quantity = $_POST['pQuantity'.$x] ;
        array_push( $prQuantities , $quantity );
        //echo $quantity;
        
    }

    //session
    $_SESSION['productsInCart'] = $prQuantities 

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
    <link rel="stylesheet" type="text/css" href="./css/completeOrder.css">
    <!-- My external Js -->
    <script src="./js/main.js"></script>

    <!-- fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- Font Awesome Icon Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @media (min-width: 575.98px) {

        #butt{
            margin-left:45%;   
        }

        .foo1{
            margin-left:20%;
        }

            }

            @media (max-width: 575.98px) {

            #butt{
                margin-left:30%;   
            }

            .foo{
                margin-left:8%;
            }

            .foo1{
                    margin-left:0%;
                }


            }

            .fa1 {
            padding: 5px;
            font-size: 25px;
            width: 50px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 20px;
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

        /*--- navigation bar ---*/
        
        .navbar {
            background:#6ab446;
        }
        
        .nav-link,
        .navbar-brand {
            color: #fff;
            cursor: pointer;
        }
        
        .nav-link {
            margin-right: 2em !important;
        }
        
        .nav-link:hover {
            color: #000;
        }
        
        .navbar-collapse {
            justify-content: flex-end;
        }

        /*--- navigation bar ---*/

        .page-footer {
        background-color: #222;
        color: #ccc;
        padding: 10000% 0 30px;
        }

        .footer-copyright {
        color: #666;
        padding: 40px 0;
        }

        body{
            margin:0px;
        }
    </style>


</head>

<body style="text-align: center;">

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

    <div class="container">
        <h3>Order Details</h3>
        <table class="table table-striped" style="text-align: left;">
            <tbody>
                <tr >
                    <td colspan="1">
                        <form class="well form-horizontal" method="post" action="saveOrder.php" id="myForm" >
                            <fieldset >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Full Name</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-user"></i></span><input id="fullName"
                                                name="fullName" placeholder="Full Name" class="form-control"
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Address</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input id="addressLine1"
                                                name="addressLine1" placeholder="Address Line 1" class="form-control"
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">City</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input id="city"
                                                name="city" placeholder="City" class="form-control" required="true"
                                                value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Region</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input id="state"
                                                name="state" placeholder="State/Province/Region" class="form-control"
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Postal Code/ZIP</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input id="postcode"
                                                name="postcode" placeholder="Postal Code/ZIP" class="form-control"
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope"></i></span><input id="email"
                                                name="email" placeholder="Email" class="form-control" required="true"
                                                value="" type="email"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Phone Number</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-earphone"></i></span><input
                                                id="phoneNumber" name="phoneNumber" placeholder="Phone Number"
                                                class="form-control" required="true" value="" type="text"></div>
                                    </div>
                                </div>
                               
                                </form>
                                <hr/>
                                <!-- payments start  -->
                                <div class="form-group" >
                                    <label class="col-md-4 control-label" style="font-size:200%">Please choose Payment method</label>
                                    <div class="col-md-8 inputGroupContainer">
                                    <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a> </li>
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                           
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " >
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" > <input type="number" placeholder="YY" name="" class="form-control" > </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text"  class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <button type="button" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                           
                        </div>
                    </div> <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3">
                        <h6 class="pb-2">Select your paypal account type</h6>
                        <div class="form-group "> <label class="radio-inline"> <input type="radio" name="optradio" checked> Domestic </label> <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">International </label></div>
                        <p> <button type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Log into my Paypal</button> </p>
                        <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                    </div> <!-- End -->
                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <div class="form-group "> <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label> <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>ΕΘΝΙΚΗ</option>
                                <option>ΠΕΙΡΑΙΩΣ</option>
                                <option>ALPHA BANK</option>
                            </select> </div>
                        <div class="form-group">
                            <p> <button type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Proceed Pyment</button> </p>
                        </div>
                        <p class="text-muted">Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                    </div> <!-- End -->
                    <!-- End -->
                </div>
            </div>
        </div>
                                    </div>
                                </div>
                                <!-- payments end  --><hr/><br/>
                            </fieldset>
                            <button type="submit" class="btn btn-success" id="butt" form="myForm" >Submit Order</button>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- footer start  -->
    <footer class="page-footer" style="padding-top: 15px;padding-bottom: 0px;margin-left:-20%">
        <div class="container foo">
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
            <div class="footer-copyright text-center foo1" >© 2020 Copyright: ΤΣΟΥΦΗΣ ΘΟΔΩΡΗΣ</div>
        </div>
    </footer>

    <!-- footer end -->
</body>


</html>