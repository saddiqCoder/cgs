<?php
ob_start();
session_start();
error_reporting(E_ALL);
include_once "helper_functions/loader.php";
$con = connect_to_db('localhost','root','','garment_system');

if (!isset($_SESSION['customerID'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Garment System - Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<header>
    <h1>Mr Hizzy Garment Store</h1>
</header>

<nav>
    <a href="measurements.php">Measurements</a>
    <a href="garments.php">Garments</a>
    <a href="orders.php">Orders</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <h2>Hi <?php echo $_SESSION['customerID']['fname'];?> &#129303; Welcome to our Garment Store</h2>
    <p>Select a module from the navigation above to manage records.</p>
</div>
</body>
</html>
