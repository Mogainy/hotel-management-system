<?php

require '../config/db.php';

$order_id = $_POST['order_id'];
$status = $_POST['status'];

mysqli_query(
    $conn,
    "UPDATE orders
    SET status='$status'
    WHERE order_id='$order_id'"
);

header("Location: dashboard.php");
exit;