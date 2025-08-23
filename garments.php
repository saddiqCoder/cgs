<!DOCTYPE html>
<html>
<head>
    <title>Garments - Garment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Garments Module</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="customers.php">Customers</a>
    <a href="measurements.php">Measurements</a>
    <a href="garments.php">Garments</a>
    <a href="orders.php">Orders</a>
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
