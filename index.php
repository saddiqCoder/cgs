<?php
ob_start();
session_start(); 
include_once "helper_functions/loader.php";

// Connect to garment system database
$con = connect_to_db('localhost', 'root', '', 'garment_system');

// If already logged in, go to customer dashboard
if (isset($_SESSION['customeruser'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Garment Customization System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="bg-dark text-light py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Garment Customization System</h1>
        <p class="lead">Design your garment, choose your fabric, and order online</p>
        <div class="mt-4">
            <a href="#" class="btn btn-warning me-2">Browse Garments</a>
            <a href="#" class="btn btn-light me-2">Customize & Order</a>
            <a href="login.php" class="btn btn-outline-light me-2">Login</a>
            <a href="register.php" class="btn btn-outline-warning me-2">Register</a>
            <a href="admin/admin.php" class="btn btn-danger">Admin</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container text-center">
        <h2>Why Choose Us?</h2>
        <p>We make garment customization simple, affordable, and stylish.</p>
        <div class="row mt-4">
            <div class="col-md-4">
                <h4>🎨 Custom Designs</h4>
                <p>Create garments that match your unique style and preferences.</p>
            </div>
            <div class="col-md-4">
                <h4>👕 Quality Fabrics</h4>
                <p>Select from a wide range of high-quality fabrics, colors, and patterns.</p>
            </div>
            <div class="col-md-4">
                <h4>🚚 Fast Delivery</h4>
                <p>Enjoy quick tailoring and reliable delivery right to your doorstep.</p>
            </div>
        </div>
    </div>
</section>


<footer class="bg-dark text-center py-3 mt-5">
    <p class="mb-0">&copy; <?php echo date("Y"); ?> Garment Customization System. All rights reserved.</p>
</footer>

</body>
</html>
