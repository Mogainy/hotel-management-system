<?php
session_start();

if(
!isset($_SESSION['role'])
||
$_SESSION['role']!='admin'
){
header("Location: ../login.php");
exit;
}

require '../config/db.php';

$totalOrders = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders"
)
);

$todayOrders = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE DATE(created_at)=CURDATE()"
)
);

$revenue = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT SUM(total_amount) AS total
FROM orders"
)
);

$todayRevenue = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT SUM(total_amount) AS total
FROM orders
WHERE DATE(created_at)=CURDATE()"
)
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Hotel Analytics Dashboard</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
border:none;
border-radius:15px;
}

.card-header{
font-weight:bold;
}

.stat-card{
transition:0.3s;
}

.stat-card:hover{
transform:translateY(-5px);
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="mb-0">
📊 Hotel Analytics Dashboard
</h2>

<small class="text-muted">
Hotel Performance & Revenue Reports
</small>

</div>

<div>

<a
href="dashboard.php"
class="btn btn-secondary">

🏠 Dashboard

</a>

<a
href="qr_codes.php"
class="btn btn-primary">

📱 QR Codes

</a>

</div>

</div>

<div class="row">

<div class="col-md-3 mb-3">

<div class="card shadow stat-card">

<div class="card-body text-center">

<h5>Total Orders</h5>

<h1>

<?php echo $totalOrders; ?>

</h1>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow stat-card">

<div class="card-body text-center">

<h5>Orders Today</h5>

<h1>

<?php echo $todayOrders; ?>

</h1>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow stat-card">

<div class="card-body text-center">

<h5>Total Revenue</h5>

<h1>

KES <?php echo number_format($revenue['total'] ?? 0); ?>

</h1>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow stat-card">

<div class="card-body text-center">

<h5>Revenue Today</h5>

<h1>

KES <?php echo number_format($todayRevenue['total'] ?? 0); ?>

</h1>

</div>

</div>

</div>

</div>

<!-- MOST ORDERED ITEMS -->

<?php

$popular = mysqli_query(
$conn,
"SELECT
menu_items.item_name,
SUM(order_items.quantity) AS qty
FROM order_items
JOIN menu_items
ON menu_items.item_id=order_items.item_id
GROUP BY order_items.item_id
ORDER BY qty DESC
LIMIT 5"
);

?>

<div class="card shadow mt-4">

<div class="card-header bg-warning">

🏆 Most Ordered Items

</div>

<div class="card-body">

<table class="table table-striped">

<tr>

<th>Food Item</th>
<th>Total Orders</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($popular)){
?>

<tr>

<td>

<?php echo $row['item_name']; ?>

</td>

<td>

<?php echo $row['qty']; ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<!-- ORDERS BY LOCATION -->

<?php

$locationsReport = mysqli_query(
$conn,
"SELECT
locations.location_name,
COUNT(orders.order_id) AS total_orders,
SUM(orders.total_amount) AS revenue
FROM locations
LEFT JOIN orders
ON locations.location_id = orders.location_id
GROUP BY locations.location_id
ORDER BY total_orders DESC"
);

?>

<div class="card shadow mt-4">

<div class="card-header bg-primary text-white">

🏨 Orders By Location

</div>

<div class="card-body">

<table class="table table-striped table-hover">

<tr>

<th>Location</th>
<th>Total Orders</th>
<th>Revenue</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($locationsReport)){
?>

<tr>

<td>

<?php echo $row['location_name']; ?>

</td>

<td>

<?php echo $row['total_orders']; ?>

</td>

<td>

KES <?php echo number_format($row['revenue'] ?? 0); ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<!-- RECENT ORDERS -->

<?php

$recentOrders = mysqli_query(
$conn,
"SELECT
orders.*,
locations.location_name
FROM orders
JOIN locations
ON locations.location_id = orders.location_id
ORDER BY orders.order_id DESC
LIMIT 10"
);

?>

<div class="card shadow mt-4 mb-5">

<div class="card-header bg-success text-white">

📋 Recent Orders

</div>

<div class="card-body">

<table class="table table-hover">

<tr>

<th>Order #</th>
<th>Location</th>
<th>Status</th>
<th>Amount</th>

</tr>

<?php

while($order=mysqli_fetch_assoc($recentOrders)){

$statusColor = "secondary";

if($order['status']=="pending"){
$statusColor = "warning";
}

if($order['status']=="accepted"){
$statusColor = "primary";
}

if($order['status']=="preparing"){
$statusColor = "info";
}

if($order['status']=="ready"){
$statusColor = "success";
}

if($order['status']=="delivered"){
$statusColor = "dark";
}

?>

<tr>

<td>

#<?php echo $order['order_id']; ?>

</td>

<td>

<?php echo $order['location_name']; ?>

</td>

<td>

<span class="badge bg-<?php echo $statusColor; ?>">

<?php echo strtoupper($order['status']); ?>

</span>

</td>

<td>

KES <?php echo number_format($order['total_amount']); ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>