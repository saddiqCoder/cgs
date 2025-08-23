<!DOCTYPE html>
<html>
<head>
    <title>Customers - Garment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Customers Module</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="customers.php">Customers</a>
    <a href="measurements.php">Measurements</a>
    <a href="garments.php">Garments</a>
    <a href="orders.php">Orders</a>
</nav>

<div class="container">
    <h2>Add New Customer</h2>
    <form>
        <input type="text" placeholder="Customer Name">
        <input type="text" placeholder="Phone Number">
        <input type="email" placeholder="Email">
        <button type="submit">Save Customer</button>
    </form>

    <h2>Customer List</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Abdullahi Musa</td>
            <td>08012345678</td>
            <td>abdullahi@example.com</td>
        </tr>
    </table>
</div>
</body>
</html>
