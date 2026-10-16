<?php
session_start();

if(
!isset($_SESSION['role']) ||
$_SESSION['role']!='admin'
){
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';
include '../includes/header.php';

$ordersToday =
mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE DATE(created_at)=CURDATE()"
));

$pending =
mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE status='pending'"
));

$ready =
mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM orders
WHERE status='ready'"
));

$revenueQuery =
mysqli_query(
$conn,
"SELECT SUM(total_amount) total
FROM orders"
);

$revenue =
mysqli_fetch_assoc($revenueQuery);
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 sidebar">

<h4 class="text-white p-3">
🏨 Hotel PMS
</h4>

<a href="dashboard.php">
<i class="bi bi-speedometer2"></i>
 Dashboard
</a>
<a href="qr_codes.php">
<i class="bi bi-qr-code"></i>
 QR Codes
</a>
<a href="menu_items.php">
<i class="bi bi-cup-hot"></i>
 Menu
</a>

<a href="reports.php">
<i class="bi bi-graph-up"></i>
 Reports
</a>

<a href="../logout.php">
<i class="bi bi-box-arrow-right"></i>
 Logout
</a>

</div>

<div class="col-md-10 p-4">

<h2>
Welcome,
<?php echo $_SESSION['fullname']; ?>
</h2>

<div class="row mt-4">

<div class="col-md-3">
<div class="card card-shadow">
<div class="card-body">

<h5>Orders Today</h5>

<h2><?php echo $ordersToday; ?></h2>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card card-shadow">
<div class="card-body">

<h5>Revenue</h5>

<h2>
KES
<?php echo number_format($revenue['total'] ?? 0); ?>
</h2>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card card-shadow">
<div class="card-body">

<h5>Pending</h5>

<h2><?php echo $pending; ?></h2>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card card-shadow">
<div class="card-body">

<h5>Ready</h5>

<h2><?php echo $ready; ?></h2>

</div>
</div>
</div>

</div>

</div>

</div>

</div>

<?php include '../includes/footer.php'; ?>