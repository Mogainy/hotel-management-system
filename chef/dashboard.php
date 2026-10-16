<?php
session_start();

if(
!isset($_SESSION['role'])
||
$_SESSION['role'] != 'chef'
){
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';
?>

<!DOCTYPE html>
<html>
<head>

<title>Kitchen Dashboard</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

<div class="container-fluid">

<span class="navbar-brand">
👨‍🍳 Kitchen Dashboard
</span>

<a href="../logout.php"
class="btn btn-danger">
Logout
</a>

</div>

</nav>

<<div class="container mt-4">
<?php

$pending = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE status='pending'"
)
);

$preparing = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE status='preparing'"
)
);

$ready = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE status='ready'"
)
);

?>

<div class="row mb-4">

<div class="col-md-4">

<div class="card text-center shadow">

<div class="card-body">

<h5>Pending</h5>

<h2><?php echo $pending; ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card text-center shadow">

<div class="card-body">

<h5>Preparing</h5>

<h2><?php echo $preparing; ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card text-center shadow">

<div class="card-body">

<h5>Ready</h5>

<h2><?php echo $ready; ?></h2>

</div>

</div>

</div>

</div>
<div class="row" id="orders-container">

</div>

</div>

<?php

$orders = mysqli_query(
$conn,
"SELECT
orders.*,
locations.location_name
FROM orders
JOIN locations
ON orders.location_id=locations.location_id
WHERE status!='delivered'
ORDER BY order_id DESC"
);

while($order=mysqli_fetch_assoc($orders)){

$border='warning';

if($order['status']=='accepted'){
    $border='primary';
}

if($order['status']=='preparing'){
    $border='info';
}

if($order['status']=='ready'){
    $border='success';
}

?>

<div class="col-md-6 mb-4">

<div class="card border-<?php echo $border; ?> shadow">

<div class="card-header">

<div class="d-flex justify-content-between">

<h5>
🍽 Order #<?php echo $order['order_id']; ?>
</h5>

<span class="badge bg-<?php echo $border; ?>">
<?php echo strtoupper($order['status']); ?>
</span>

</div>

</div>

<div class="card-body">

<p>
<b>Location:</b>
<?php echo $order['location_name']; ?>
</p>

<hr>

<?php

$items=mysqli_query(
$conn,
"SELECT
order_items.*,
menu_items.item_name
FROM order_items
JOIN menu_items
ON order_items.item_id=menu_items.item_id
WHERE order_id='{$order['order_id']}'"
);

while($item=mysqli_fetch_assoc($items)){

echo "<p>• ".$item['quantity']." x ".$item['item_name']."</p>";

}

?>

<form
action="update_status.php"
method="POST">

<input
type="hidden"
name="order_id"
value="<?php echo $order['order_id']; ?>">

<div class="d-flex gap-2">

<button
class="btn btn-success"
name="status"
value="accepted">
Accept
</button>

<button
class="btn btn-warning"
name="status"
value="preparing">
Preparing
</button>

<button
class="btn btn-primary"
name="status"
value="ready">
Ready
</button>

</div>

</form>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<script>
setInterval(function(){

    location.reload();

},5000);
</script>

<script>

function loadOrders(){

fetch('orders_ajax.php')

.then(response => response.text())

.then(data => {

document.getElementById(
'orders-container'
).innerHTML = data;

});

}

loadOrders();

setInterval(loadOrders,3000);

</script>
</body>
</html>