<?php

require '../config/db.php';

$order_id = $_POST['order_id'];

mysqli_query(
    $conn,
    "UPDATE orders
    SET status='delivered'
    WHERE order_id='$order_id'"
);

header("Location: dashboard.php");
exit;