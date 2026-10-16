<?php
session_start();
require '../config/db.php';

if(empty($_SESSION['cart'])){
    die("Cart Empty");
}

$token = $_POST['token'];

$locationQuery = mysqli_query(
    $conn,
    "SELECT * FROM locations WHERE qr_token='$token'"
);

$location = mysqli_fetch_assoc($locationQuery);

$location_id = $location['location_id'];

$total = 0;

foreach($_SESSION['cart'] as $item_id=>$qty){

    $itemQuery = mysqli_query(
        $conn,
        "SELECT * FROM menu_items WHERE item_id='$item_id'"
    );

    $item = mysqli_fetch_assoc($itemQuery);

    $total += ($item['price'] * $qty);
}

mysqli_query(
    $conn,
    "INSERT INTO orders
    (location_id,total_amount,status)
    VALUES
    ('$location_id','$total','pending')"
);

$order_id = mysqli_insert_id($conn);

foreach($_SESSION['cart'] as $item_id=>$qty){

    $itemQuery = mysqli_query(
        $conn,
        "SELECT * FROM menu_items WHERE item_id='$item_id'"
    );

    $item = mysqli_fetch_assoc($itemQuery);

    mysqli_query(
        $conn,
        "INSERT INTO order_items
        (order_id,item_id,quantity,price)
        VALUES
        (
        '$order_id',
        '$item_id',
        '$qty',
        '{$item['price']}'
        )"
    );
}

unset($_SESSION['cart']);

header("Location: order_success.php?id=".$order_id);
exit;
?>