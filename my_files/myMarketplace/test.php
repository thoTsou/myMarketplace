<?php
        require 'vendor/autoload.php';
        $m = new MongoDB\Client("mongodb://127.0.0.1");
        //select database
        $db = $m->mymarketplacedb;
                        
        //select collection
        $collection = $db->products;

        $cursor = $collection ->find();

        foreach($cursor as $product){
            echo $product["name"];
        }
        echo "done";
?>