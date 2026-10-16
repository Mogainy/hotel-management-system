<?php
session_start();
require '../config/db.php';

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

<form action="update_status.php" method="POST">

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