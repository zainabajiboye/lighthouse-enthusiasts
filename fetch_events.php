<?php
// fetch_events.php
$servername = "zainabsproject";  // Update with your server info
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "lighthouse_enthusiasts_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get event data
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Return the data as JSON
echo json_encode($events);

// Close the connection
$conn->close();
?>
