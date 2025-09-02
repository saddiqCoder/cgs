<?php
ob_start();
session_start();
error_reporting(E_ALL);
include_once "helper_functions/loader.php";
$conn = connect_to_db('localhost','root','','garment_system');

if (!isset($_SESSION['customerID'])){
    header("Location: login.php");
}

// Fetch sizes
$sql = "SELECT * FROM body_measurements";
$result = $conn->query($sql);

// Store results
$sizes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sizes[] = $row;
    }
}

?>

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
    <a href="dashboard.php">Home</a>
    <a href="#">Measurements</a>
    <a href="garments.php">Garments</a>
    <a href="orders.php">Orders</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <h2>Select Body Type</h2>
    <form>
        <!-- Chest -->
      <div class="col-md-6">
        <label for="chest" class="form-label">Chest</label>
        <select id="chest" name="chest" class="form-select">
          <?php foreach($sizes as $s): ?>
            <option value="<?= $s['chest']; ?>"><?= $s['size']; ?> (<?= $s['chest']; ?> in)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Waist -->
      <div class="col-md-6">
        <label for="waist" class="form-label">Waist</label>
        <select id="waist" name="waist" class="form-select">
          <?php foreach($sizes as $s): ?>
            <option value="<?= $s['waist']; ?>"><?= $s['size']; ?> (<?= $s['waist']; ?> in)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Hip -->
      <div class="col-md-6">
        <label for="hip" class="form-label">Hip</label>
        <select id="hip" name="hip" class="form-select">
          <?php foreach($sizes as $s): ?>
            <option value="<?= $s['hip']; ?>"><?= $s['size']; ?> (<?= $s['hip']; ?> in)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Shoulder -->
      <div class="col-md-6">
        <label for="shoulder" class="form-label">Shoulder</label>
        <select id="shoulder" name="shoulder" class="form-select">
          <?php foreach($sizes as $s): ?>
            <option value="<?= $s['shoulder']; ?>"><?= $s['size']; ?> (<?= $s['shoulder']; ?> in)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Sleeve -->
      <div class="col-md-6">
        <label for="sleeve" class="form-label">Sleeve Length</label>
        <select id="sleeve" name="sleeve" class="form-select">
          <?php foreach($sizes as $s): ?>
            <option value="<?= $s['sleeve_length']; ?>"><?= $s['size']; ?> (<?= $s['sleeve_length']; ?> in)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Trouser -->
      <div class="col-md-6">
        <label for="trouser" class="form-label">Trouser Length</label>
        <select id="trouser" name="trouser" class="form-select">
          <?php foreach($sizes as $s): ?>
            <option value="<?= $s['trouser_length']; ?>"><?= $s['size']; ?> (<?= $s['trouser_length']; ?> in)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Gown -->
      <div class="col-md-6">
        <label for="gown" class="form-label">Gown Length</label>
        <select id="gown" name="gown" class="form-select">
          <?php foreach($sizes as $s): ?>
            <option value="<?= $s['gown_length']; ?>"><?= $s['size']; ?> (<?= $s['gown_length']; ?> in)</option>
          <?php endforeach; ?>
        </select>
      </div>
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
