
<?php

    //echo 'enter';

    $cookieValue = json_decode($_COOKIE['cart'], true);

    $counter=0;
    foreach($cookieValue as $product){

        if ( $product['id'] == $_POST['pIdToDelete']){
            echo $product['price'];
            array_splice($cookieValue, $counter, 1);
        }
        $counter++;
    }

    setcookie('cart' , json_encode($cookieValue) , time()+86400);

    header("Location: shoppingCartCopy.php");

?>