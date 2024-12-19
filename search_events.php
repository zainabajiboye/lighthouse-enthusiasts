<?php
// Database connection
$servername = "zainabsproject";  
$username = "root";         
$password = "";             
$dbname = "lighthouse_enthusiasts_db";  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the AJAX request
$query = isset($_GET['q']) ? $_GET['q'] : '';

// Prepare the SQL query to search events 
$sql = "SELECT * FROM events WHERE event_name LIKE ? OR location LIKE ? ORDER BY event_date";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch all matching events
$events = array();
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

// Return the results as JSON
echo json_encode($events);

// Close the database connection
$conn->close();
?>
