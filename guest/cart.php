<?php
session_start();
require '../config/db.php';

if(!isset($_GET['token'])){
    die("Invalid Access");
}

$token = $_GET['token'];
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>

<title>Your Cart</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

<div class="container-fluid">

<a
href="menu.php?token=<?php echo $token; ?>"
class="navbar-brand">

🏨 Boutique Hotel

</a>

</div>

</nav>

<div class="container mt-4">

<h2>Your Cart</h2>

<?php

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
?>

<div class="alert alert-warning">

Your cart is empty.

</div>

<a
href="menu.php?token=<?php echo $token; ?>"
class="btn btn-primary">

Back To Menu

</a>

<?php
exit;
}
?>

<div class="card shadow">

<div class="card-body">

<table class="table">

<tr>
<th>Item</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>

<?php

foreach($_SESSION['cart'] as $item_id=>$qty){

$item=mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM menu_items
WHERE item_id='$item_id'"
)
);

$subtotal=$item['price']*$qty;

$total += $subtotal;
?>

<tr>

<td><?php echo $item['item_name']; ?></td>

<td>KES <?php echo $item['price']; ?></td>

<td><?php echo $qty; ?></td>

<td>KES <?php echo $subtotal; ?></td>

</tr>

<?php } ?>

</table>

<hr>

<h3 class="text-success">

Grand Total:
KES <?php echo number_format($total); ?>

</h3>

<form
action="place_order.php"
method="POST">

<input
type="hidden"
name="token"
value="<?php echo $token; ?>">

<button
class="btn btn-success btn-lg">

Place Order

</button>

</form>

</div>

</div>

</div>

</body>
</html>