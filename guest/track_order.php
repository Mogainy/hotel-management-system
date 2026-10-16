<?php
require '../config/db.php';

if(!isset($_GET['id'])){
    die("Order Not Found");
}

$order_id = $_GET['id'];

$orderQuery = mysqli_query(
    $conn,
    "SELECT * FROM orders WHERE order_id='$order_id'"
);

if(mysqli_num_rows($orderQuery) == 0){
    die("Order Not Found");
}

$order = mysqli_fetch_assoc($orderQuery);

$status = $order['status'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Track Order</title>

<meta http-equiv="refresh" content="5">

<style>

body{
    font-family:Arial;
    padding:20px;
}

.step{
    padding:15px;
    margin-bottom:10px;
    border-radius:8px;
}

.completed{
    background:lightgreen;
}

.pending{
    background:#eee;
}

</style>

</head>
<body>

<h1>Track Order #<?php echo $order_id; ?></h1>

<?php

function statusClass($current,$target){

    $statuses = [
        'pending'=>1,
        'accepted'=>2,
        'preparing'=>3,
        'ready'=>4,
        'delivered'=>5
    ];

    return $statuses[$current] >= $statuses[$target]
        ? 'completed'
        : 'pending';
}
?>

<div class="step <?php echo statusClass($status,'pending'); ?>">
Pending
</div>

<div class="step <?php echo statusClass($status,'accepted'); ?>">
Accepted
</div>

<div class="step <?php echo statusClass($status,'preparing'); ?>">
Preparing
</div>

<div class="step <?php echo statusClass($status,'ready'); ?>">
Ready
</div>

<div class="step <?php echo statusClass($status,'delivered'); ?>">
Delivered
</div>

<h3>
Current Status:
<?php echo strtoupper($status); ?>
</h3>

</body>
</html><?php

require '../config/db.php';

$order_id=$_GET['id'];

$order=mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE order_id='$order_id'"
)
);

$status=$order['status'];

$progress=20;

switch($status){

case 'accepted':
$progress=40;
break;

case 'preparing':
$progress=70;
break;

case 'ready':
$progress=90;
break;

case 'delivered':
$progress=100;
break;

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Track Order</title>

<meta http-equiv="refresh" content="5">

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2>

Order #<?php echo $order_id; ?>

</h2>

<p>

Current Status:

<strong>

<?php echo strtoupper($status); ?>

</strong>

</p>

<div class="progress"
style="height:30px;">

<div
class="progress-bar progress-bar-striped progress-bar-animated"
style="width:<?php echo $progress; ?>%">

<?php echo $progress; ?>%

</div>

</div>

<br>

<div class="row text-center">

<div class="col">
Pending
</div>

<div class="col">
Accepted
</div>

<div class="col">
Preparing
</div>

<div class="col">
Ready
</div>

<div class="col">
Delivered
</div>

</div>

</div>

</div>

</div>

</body>
</html>