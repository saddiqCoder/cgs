<!DOCTYPE html>
<html>
<head>
    <title>Measurements - Garment System</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<header>
    <h1>Measurements Module</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="customers.php">Customers</a>
    <a href="measurements.php">Measurements</a>
    <a href="garments.php">Garments</a>
    <a href="orders.php">Orders</a>
</nav>

<div class="container">
    <h2>Add Measurement</h2>
    <form>
        <input type="text" placeholder="Customer ID">
        <input type="text" placeholder="Chest Size">
        <input type="text" placeholder="Waist Size">
        <input type="text" placeholder="Length">
        <button type="submit">Save Measurement</button>
    </form>

    <h2>Measurement Records</h2>
    <table>
        <tr>
            <th>Measurement ID</th>
            <th>Customer ID</th>
            <th>Chest</th>
            <th>Waist</th>
            <th>Length</th>
        </tr>
        <tr>
            <td>1</td>
            <td>1</td>
            <td>38</td>
            <td>32</td>
            <td>40</td>
        </tr>
    </table>
</div>
</body>
</html>
