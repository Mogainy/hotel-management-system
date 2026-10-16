<?php

$order_id = $_GET['id'];

?>

<!DOCTYPE html>
<html>
<head>

<title>Order Successful</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow text-center">

<div class="card-body">

<h1 class="text-success">

✅ Order Received

</h1>

<p>

Your order has been sent to the kitchen.

</p>

<h3>

Order Number:
#<?php echo $order_id; ?>

</h3>

<br>

<a
href="track_order.php?id=<?php echo $order_id; ?>"
class="btn btn-primary">

Track Order

</a>

</div>

</div>

</div>

</body>
</html>