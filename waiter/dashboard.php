<?php
session_start();

if(
!isset($_SESSION['role'])
||
$_SESSION['role'] != 'waiter'
){
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

$readyOrders = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE status='ready'"
)
);

$deliveredOrders = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE status='delivered'"
)
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Waiter Dashboard</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.navbar{
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.stat-card{
    border:none;
    border-radius:15px;
    transition:0.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.order-card{
    border:none;
    border-radius:15px;
    overflow:hidden;
    transition:0.3s;
}

.order-card:hover{
    transform:translateY(-3px);
}

.badge-ready{
    font-size:14px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container-fluid">

<span class="navbar-brand fw-bold">
🚚 Waiter Dashboard
</span>

<a
href="../logout.php"
class="btn btn-danger">

Logout

</a>

</div>

</nav>

<div class="container mt-4">

<div class="row mb-4">

<div class="col-md-6 mb-3">

<div class="card stat-card shadow">

<div class="card-body text-center">

<h5 class="text-muted">

Ready Orders

</h5>

<h1 class="text-success">

<?php echo $readyOrders; ?>

</h1>

</div>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="card stat-card shadow">

<div class="card-body text-center">

<h5 class="text-muted">

Delivered Orders

</h5>

<h1 class="text-primary">

<?php echo $deliveredOrders; ?>

</h1>

</div>

</div>

</div>

</div>

<h3 class="mb-4">
🍽 Orders Ready For Delivery
</h3>

<?php

$orders = mysqli_query(
$conn,
"SELECT
orders.*,
locations.location_name
FROM orders
JOIN locations
ON locations.location_id = orders.location_id
WHERE status='ready'
ORDER BY order_id DESC"
);

if(mysqli_num_rows($orders) == 0){
?>

<div class="alert alert-warning">

No orders ready for delivery.

</div>

<?php
}

while($order=mysqli_fetch_assoc($orders)){
?>

<div class="card order-card shadow mb-4">

<div class="card-header bg-success text-white">

<div class="d-flex justify-content-between align-items-center">

<h5 class="mb-0">

🚚 Order #<?php echo $order['order_id']; ?>

</h5>

<span class="badge bg-light text-success badge-ready">

READY

</span>

</div>

</div>

<div class="card-body">

<div class="alert alert-light border">

<b>Delivery Location:</b>

<?php echo $order['location_name']; ?>

</div>

<?php

$items = mysqli_query(
$conn,
"SELECT
order_items.*,
menu_items.item_name
FROM order_items
JOIN menu_items
ON order_items.item_id = menu_items.item_id
WHERE order_id='{$order['order_id']}'"
);

?>

<h6 class="mb-3">

Ordered Items

</h6>

<ul class="list-group mb-3">

<?php
while($item=mysqli_fetch_assoc($items)){
?>

<li class="list-group-item">

<?php echo $item['quantity']; ?>

x

<?php echo $item['item_name']; ?>

</li>

<?php } ?>

</ul>

<form
action="deliver.php"
method="POST">

<input
type="hidden"
name="order_id"
value="<?php echo $order['order_id']; ?>">

<button
type="submit"
class="btn btn-primary w-100">

✅ Mark As Delivered

</button>

</form>

</div>

</div>

<?php } ?>

</div>

<footer class="text-center mt-5 mb-3 text-muted">

Boutique Hotel Ordering System

</footer>

<script>

setInterval(function(){

location.reload();

},5000);

</script>

</body>
</html>