<?php
session_start();
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
  <link rel="stylesheet" type="text/css" href="./css/nav.css">
  <!-- My external Js -->
  <script src="./js/main.js"></script>

  <!-- Font Awesome Icon Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
		
		#fa {
        padding: 5px;
        font-size: 25px;
        width: 50px;
        text-align: center;
        text-decoration: none;
        margin: 2px 2px;
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
					<a class="nav-link">User:
						<?php echo $_SESSION['username']; ?>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logOutAndRedirect.php">Log Out</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="shoppingCartCopy.php">My Cart<i class="fa fa-shopping-cart"
							style="font-size:200%"></i></a>
				</li>
			</ul>
		</div>
	</nav>

	<!--   NavBar end   -->

  <h2 style="text-align:center;margin-top:1%;">Orders History for user: <u><?php echo $_SESSION['username']; ?></u></h2>
  <div style="text-align:center;margin-bottom:5%">
    <a class="btn btn-success" href="marketPlaceProducts.php">Continue Shopping</a>
  </div>
 
 <!-- order -->
  <?php
      require 'vendor/autoload.php';
      $m = new MongoDB\Client("mongodb://127.0.0.1");
      //select database
       $db = $m->mymarketplacedb;
                              
       //select collection
      $collection = $db->orders;
      
      $userEmail = $_SESSION['userEmail'];
      
      $cursor = $collection ->find( array( 'email' => $userEmail ) );

      
      if($cursor != null){
        
      foreach($cursor as $order){
        
  ?>

  <div class="card" style="width:60%;margin-left:21%;">
    <h5 class="card-header"><?php echo $order['date']->toDateTime()->format('Y-m-d H:i:s') ?></h5>
    <div class="card-body">
      <h5 class="card-title">Products:</h5>
      <hr/>
      <?php foreach($order['products'] as $product){ ?>
      <p class="card-text">Product ID : <?php echo $product['productId']; ?></p>
      <p class="card-text">Product Name : <?php 
      $coll = $db->products;
      
      $cursor2 = $coll ->find( array( '_id' => new MongoDB\BSON\ObjectID($product['productId']) ) );


      foreach($cursor2 as $pr){
      echo $pr['name']; 
      }
      
      ?></p>
      <p class="card-text">Quantity : <?php echo $product['quantity']; ?></p>
      <hr/>
      <?php } ?>
      <form method="post" action="deleteOrder.php"><button class="btn btn-danger">Delete Order</button><input type="hidden" name="orderID" value="<?php echo $order['_id']; ?>" /></form> **WITHIN 24 HOURS
    </div>
  </div>
  <hr/>
  <!-- order -->
  <?php } } ?>

  <!-- footer start  -->
  <footer class="page-footer" id="footer" style="margin-top:10%;padding-top: 15px;padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Find Us On Social !</h6>
                    <p>Facebook -> <a href="#" class="fa fa-facebook" id="fa"></a></p>
                    <p>Instagram -> <a href="#" class="fa fa-instagram" id="fa"></a></p>
                    <p>Twitter -> <a href="#" class="fa fa-twitter" id="fa"></a></p>
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