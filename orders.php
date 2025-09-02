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
    <title>Orders - Garment System</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<header>
    <h1>Orders Module</h1>
</header>

<nav>
    <a href="dashboard.php">Home</a>
    <a href="measurements.php">Measurements</a>
    <a href="garments.php">Garments</a>
    <a href="#">Orders</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <h2>Place New Order</h2>
    <form>
        <input type="text" placeholder="Customer ID">
        <input type="text" placeholder="Garment ID">
        <select>
            <option>Pending</option>
            <option>In Progress</option>
            <option>Completed</option>
        </select>
        <button type="submit">Save Order</button>
    </form>

    <h2>Order List</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer ID</th>
            <th>Garment ID</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>In Progress</td>
        </tr>
    </table>
</div>
</body>
</html>
