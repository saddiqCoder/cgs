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
    <title>Garments - Garment System</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<header>
    <h1>Garments Module</h1>
</header>

<nav>
    <a href="dashboard.php">Home</a>
    <a href="measurements.php">Measurements</a>
    <a href="#">Garments</a>
    <a href="orders.php">Orders</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <h2>Add New Garment</h2>
    <form>
        <input type="text" placeholder="Garment Type">
        <input type="text" placeholder="Style">
        <select>
            <option>Fabric A</option>
            <option>Fabric B</option>
        </select>
        <button type="submit">Save Garment</button>
    </form>

    <h2>Garment List</h2>
    <table>
        <tr>
            <th>Garment ID</th>
            <th>Type</th>
            <th>Style</th>
            <th>Fabric</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Shirt</td>
            <td>Short Sleeve</td>
            <td>Fabric A</td>
        </tr>
    </table>
</div>
</body>
</html>
