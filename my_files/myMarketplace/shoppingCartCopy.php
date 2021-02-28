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
	<link rel="stylesheet" type="text/css" href="./css/shopingCart.css">
	<!-- My external Js -->
	<script src="./js/cart.js"></script>

	<!-- Font Awesome Icon Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.checked {
			color: orange;
		}
	</style>
	<style>
		/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		/* Firefox */
		input[type=number] {
			-moz-appearance: textfield;
		}

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
	<script>
		function deleteFromCart(id){
			//alert(id);

			var input = document.createElement("input");

			input.setAttribute("type", "hidden");

			input.setAttribute("name", "pIdToDelete");

			input.setAttribute("value", id );

			//append to form element that you want .
			document.getElementById("deleteForm").appendChild(input);

			document.getElementById('deleteForm').submit();
		}
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
			</ul>
		</div>
	</nav>

	<!--   NavBar end   -->

		

	<!-- shopping cart start -->

	<div class="container">
		<div class="card shopping-cart">
			<div class="card-header bg-dark text-light">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				My Cart
				<a href="marketPlaceProducts.php" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
				<div class="clearfix"></div>
			</div>
			<div class="card-body">
				<form method="post" action="completeOrder.php">
					<?php 
				
				require 'vendor/autoload.php';
				$m = new MongoDB\Client("mongodb://127.0.0.1");
				//select database
				$db = $m->mymarketplacedb;
				
				//select collection
				$collection = $db->products;

				$total = 0;
				$count = 0;

				//echo count($_SESSION['cart']);
				//echo $_SESSION['cart'][0]['id'];
				//echo $_SESSION['cart'][0]['price'];

				if(isset($_COOKIE['cart'])){

				$productsInCart = json_decode($_COOKIE['cart'], true);
				//echo $_SESSION['cart'][0]['id']."<br/>";
				//echo $productsInCart[0]['price'];
				

				for ($x = 0; $x < count($productsInCart) ; $x++) {
					$id = $productsInCart[$x]['id'];
					//echo $id;
					$price =  $productsInCart[$x]['price'];
					//echo $price;
					$cursor = $collection ->find( array( '_id' => new MongoDB\BSON\ObjectID($id) ) );
					foreach($cursor as $product){
				
				?>
					<!-- PRODUCT -->
					<div class="row">
						<div class="col-12 col-sm-12 col-md-2 text-center">
							<img class="img-responsive" src="<?php echo $product['photo']; ?>" alt="prewiew" width="120"
								height="120">
						</div>
						<div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
							<h4 class="product-name"><strong>
									<?php echo $product['name']; ?>
								</strong></h4>
							<h4>
								<small>
									<?php echo $product['smallDescr']; ?>
								</small>
							</h4>
						</div>
						<div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
							<div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
								<h6><strong>
										<?php echo $price; ?>€ <span class="text-muted">x</span>
									</strong></h6>
							</div>
							<div class="col-4 col-sm-4 col-md-4">
								<div class="quantity">
									<input type="button" value="+" class="plus"
										onclick="changeTotal(<?php echo $price; ?>,this.value,<?php echo $count; ?>)">
									<input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
										size="4" id="<?php echo 'pQuantity'.$count; ?>" name="<?php echo 'pQuantity'.$count; ?>">
									<input type="button" value="-" class="minus"
										onclick="changeTotal(<?php echo $price; ?>,this.value,<?php echo $count; ?>)">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12" style="margin-top:15%">
								<button type="button" name="deleteBtn" class="btn btn-danger" onclick="deleteFromCart('<?php echo $id; ?>')">Remove From Cart</button>
							</div>
						</div>
					</div>
					<hr>
					<?php $total = $total + $price; $count++; } } }?>
					<!-- END PRODUCT -->
			</div>


			<div class="card-footer">
				<div class="pull-right" style="margin: 10px">
					<div class="pull-right" style="margin: 5px">
						Total price: <b><span id="cartTotal">
								<?php echo $total; ?>
							</span> €</b>
					</div><br />
					<input type="submit" class="btn btn-success pull-right" value="Checkout" />
					<input type="hidden" name="productsCount" value="<?php echo $count; ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- shopping cart end -->
	
	<!--hidden form for delete product in cart-->
	<div style="display:none">
		<form method="post" action="deleteFromCart.php" id="deleteForm">
		</form>
	</div>
	<!--hidden form for delete product in cart-->

	<!-- footer start  -->
    <footer class="page-footer" id="footer" style="margin-top:20%;padding-top: 15px;padding-bottom: 0px;">
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