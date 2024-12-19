<?php
session_start();
// fetch_lighthouses.php
$servername = "zainabsproject";  // Update with your server info
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "lighthouse_enthusiasts_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, "", $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get lighthouse data


$sql = "SELECT name, location, coordinates, year_built, height, description FROM lighthouses";
$result = $conn->query($sql);

$lighthouses = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lighthouses[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($lighthouses);
?>


