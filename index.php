<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Sam Hotel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
font-family:Arial,Helvetica,sans-serif;
}

.hero{

background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
url("assets/images/default_food.jpg");

background-size:cover;
background-position:center;

height:100vh;

display:flex;

align-items:center;

justify-content:center;

text-align:center;

color:white;

}

.hero h1{

font-size:60px;
font-weight:bold;

}

.section{

padding:80px 0;

}

.card{

transition:.3s;

}

.card:hover{

transform:translateY(-8px);

}

footer{

background:#212529;

color:white;

padding:30px;

}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand"
href="#">

🏨 Sam Hotel

</a>

<div>

<a
href="login.php"
class="btn btn-warning">

Staff Login

</a>

</div>

</div>

</nav>

<section class="hero">

<div>

<h1>

Welcome To Sam Hotel

</h1>

<p class="lead">

Luxury Dining Made Easy

</p>

<a
href="guest/menu.php?token=room101"
class="btn btn-warning btn-lg">

Order Now

</a>

</div>

</section>

<section class="section">

<div class="container">

<h2 class="text-center mb-5">

Why Choose Us

</h2>

<div class="row">

<div class="col-md-4">

<div class="card shadow text-center p-4">

<i class="fas fa-utensils fa-3x text-warning"></i>

<h4 class="mt-3">

Delicious Meals

</h4>

<p>

Fresh meals prepared by professional chefs.

</p>

</div>

</div>

<div class="col-md-4">

<div class="card shadow text-center p-4">

<i class="fas fa-qrcode fa-3x text-success"></i>

<h4 class="mt-3">

QR Ordering

</h4>

<p>

Scan, order and enjoy without waiting.

</p>

</div>

</div>

<div class="col-md-4">

<div class="card shadow text-center p-4">

<i class="fas fa-clock fa-3x text-primary"></i>

<h4 class="mt-3">

Fast Service

</h4>

<p>

Orders reach the kitchen instantly.

</p>

</div>

</div>

</div>

</div>

</section>

<section class="section bg-light">

<div class="container">

<h2 class="text-center mb-5">

Featured Meals

</h2>

<div class="row">

<div class="col-md-4">

<div class="card">

<img src="assets/images/burger.jpg" class="card-img-top">

<div class="card-body">

<h5>Classic Burger</h5>

<p>Ksh 650</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<img src="assets/images/apple_juice.jpg" class="card-img-top">

<div class="card-body">

<h5>Italian Pizza</h5>

<p>Ksh 1200</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<img src="assets/images/mango_juice.jpg" class="card-img-top">

<div class="card-body">

<h5>Fresh Juice</h5>

<p>Ksh 300</p>

</div>

</div>

</div>

</div>

</div>

</section>

<footer>

<div class="container text-center">

<h4>

Sam Hotel

</h4>

<p>

📍 Nairobi, Kenya

</p>

<p>

📞 +254 700 000 000

</p>

<p>

© 2026 Sam Hotel. All Rights Reserved.

</p>

</div>

</footer>

</body>

</html>