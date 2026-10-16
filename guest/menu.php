<?php
session_start();
require '../config/db.php';

if(!isset($_GET['token'])){
    die("Invalid QR Code");
}

$token = mysqli_real_escape_string($conn,$_GET['token']);

$locationQuery = mysqli_query(
    $conn,
    "SELECT * FROM locations WHERE qr_token='$token'"
);

if(mysqli_num_rows($locationQuery)==0){
    die("Location Not Found");
}

$location = mysqli_fetch_assoc($locationQuery);

$count = 0;

if(isset($_SESSION['cart'])){
    $count = array_sum($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Hotel Menu</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
background:#f4f6f9;
}

.hero{
background:linear-gradient(
135deg,
#1d3557,
#457b9d
);
color:white;
}
.food-card{
    transition:0.3s;
}

.food-card:hover{
    transform:translateY(-5px);
}

.food-img{
    height:220px;
    object-fit:cover;
}

.price{
    color:green;
    font-weight:bold;
    font-size:22px;
}

</style>

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

<div class="container-fluid">

<span class="navbar-brand">

🏨 Boutique Hotel

</span>
<div class="container-fluid bg-dark text-white py-5 mb-4">

<div class="container text-center">

<h1 class="display-5">
🍽 Room Service & Poolside Dining
</h1>

<p class="lead">

Welcome,
<b><?php echo $location['location_name']; ?></b>

</p>

<p>

Order directly from your phone and track your meal in real time.

</p>

<a
href="cart.php?token=<?php echo $token; ?>"
class="btn btn-warning me-2">

🛒 View Cart

</a>

<a
href="track_order.php?token=<?php echo $token; ?>"
class="btn btn-outline-light">

📍 Track Order

</a>

</div>

</div>
<a
href="cart.php?token=<?php echo $token; ?>"
class="btn btn-warning">

<i class="bi bi-cart-fill"></i>

Cart

<span class="badge bg-dark">

<?php echo $count; ?>

</span>

</a>

</div>

</nav>

<div class="container mt-4">

<div class="text-center mb-4">

<h2>

Welcome,
<?php echo $location['location_name']; ?>

</h2>

<p class="text-muted">

Browse our menu and place your order.

</p>

</div>
<div class="card shadow-sm mb-4">

<div class="card-body">

<form method="GET">

<input
type="hidden"
name="token"
value="<?php echo $token; ?>">

<input
type="text"
name="search"
class="form-control"
placeholder="🔍 Search food or drink...">

</form>

</div>

</div>
<div class="row">

<?php

$search = "";

if(isset($_GET['search'])){
$search = mysqli_real_escape_string(
$conn,
$_GET['search']
);
}

$items = mysqli_query(
$conn,
"SELECT * FROM menu_items
WHERE status='available'
AND (
item_name LIKE '%$search%'
OR description LIKE '%$search%'
)"
);

while($row=mysqli_fetch_assoc($items)){

?>

<div class="col-md-4 mb-4">

<div class="card food-card shadow h-100">

<?php

$image =
!empty($row['image'])
?
"../assets/images/".$row['image']
:
"../assets/images/default_food.jpg";

?>

<img
src="<?php echo $image; ?>"
class="card-img-top food-img">

<div class="card-body">

<h5 class="card-title">

<?php echo $row['item_name']; ?>

</h5>

<p class="card-text">

<?php echo $row['description']; ?>
<div class="mb-2">

<span class="badge bg-success">

Available

</span>

</div>
</p>

<div class="price">

KES <?php echo number_format($row['price']); ?>

</div>

</div>

<div class="card-footer bg-white border-0">

<form
action="add_to_cart.php"
method="POST">

<input
type="hidden"
name="item_id"
value="<?php echo $row['item_id']; ?>">

<input
type="hidden"
name="token"
value="<?php echo $token; ?>">

<button
type="submit"
class="btn btn-success w-100">

<i class="bi bi-cart-plus"></i>

Add To Cart

</button>

</form>

</div>

</div>

</div>

<?php } ?>

</div>

</div>
<a
href="cart.php?token=<?php echo $token; ?>"
class="btn btn-warning btn-lg shadow"
style="
position:fixed;
bottom:20px;
right:20px;
z-index:999;
border-radius:50px;
">

🛒 <?php echo $count; ?>

</a>
</body>
</html>