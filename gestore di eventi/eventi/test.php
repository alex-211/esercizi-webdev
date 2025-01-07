<?php
$servername = "34.17.71.245";
$username = "php";
$password = "f=v;RoiHHkVSvl/(";
$database = "event-planner";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!<br>";

// Execute query
$wholeDB = $conn->query("SELECT * FROM users");

// Fetch and display results
if ($wholeDB) {
    while ($row = $wholeDB->fetch_assoc()) {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

$conn->close();
?>
