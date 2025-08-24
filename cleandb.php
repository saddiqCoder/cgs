<?php
// ==== DATABASE CONFIG ====
$host = "localhost";       // Your DB host
$user = "root";            // Your DB username
$pass = "";                // Your DB password
$dbname = "loan_db"; // Your DB name

// ==== TABLES TO KEEP (don't truncate) ====
$keep_tables = [
    "users",  // example table to keep
    "loan_plan",
    "loan_types" // another example
];

// ==== CONNECT TO DATABASE ====
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Disable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Get all table names
$result = $conn->query("SHOW TABLES");
if ($result) {
    while ($row = $result->fetch_array()) {
        $table = $row[0];
        
        // Skip tables in $keep_tables list
        if (!in_array($table, $keep_tables)) {
            $conn->query("TRUNCATE TABLE `$table`");
            echo "Truncated: $table<br>";
        } else {
            echo "Skipped: $table<br>";
        }
    }
} else {
    echo "Error fetching tables: " . $conn->error;
}

// Re-enable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

$conn->close();

echo "<br>✅ All tables truncated except kept ones.";
?>
