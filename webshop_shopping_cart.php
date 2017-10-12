<?php
/**
 * Created by PhpStorm.
 * User: duncc
 * Date: 9/25/2017
 * Time: 8:42 AM
 */

if (isset($_SESSION["shopping_cart"])){
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if(!in_array($_GET["id"], $item_array_id)){
     $count = count($_SESSION["shopping_cart"]);
        $item_array = array (
            'item_id'           => $_GET["id"],
            'item_name'         => $_POST["hidden_name"],
            'item_price'        => $_POST["hidden_price"],
            'item_quantity'     => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][$count] = $item_array;
    }
    else{
        echo '<script>alert("Item Already Addwd")</script>';
        echo '<script>window.location="index.php"</script>';
    }
}
else{
    $item_array = array (
        'item_id'           => $_GET["id"],
        'item_name'         => $_POST["hidden_name"],
        'item_price'        => $_POST["hidden_price"],
        'item_quantity'     => $_POST["quantity"]
    );
    $_SESSION["shopping_cart"][0] = $item_array;
}