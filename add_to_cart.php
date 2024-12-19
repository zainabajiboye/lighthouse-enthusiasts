<?php
session_start();

// Database connection 
$servername = "zainabsproject";
$username = "root";
$password = "";
$dbname = "lighthouse_enthusiasts_db";

// Check if item_id is received
if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch merchandise details
    $sql = "SELECT item_id, name, price, stock_quantity FROM merchandise WHERE item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    // Check if the chosen item is already in the cart
    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id]['quantity']++;
    } else {
        // Add item to cart
        $_SESSION['cart'][$item_id] = array(
            "name" => $item['name'],
            "price" => $item['price'],
            "quantity" => 1
        );
    }

    // Return success message
    echo "<p>" . $item['name'] . " added to cart.</p>";

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
