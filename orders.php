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
    <a href="index.php">Home</a>
    <a href="customers.php">Customers</a>
    <a href="measurements.php">Measurements</a>
    <a href="garments.php">Garments</a>
    <a href="orders.php">Orders</a>
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
