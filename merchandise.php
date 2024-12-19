<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link rel="stylesheet" href="css/navstyles.css">
    <link rel="stylesheet" href="css/merch.css">
    
    

    <!-- jQuery for AJAX functionality -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // AJAX call to add item to cart
            $(".add-to-cart-btn").click(function() {
                var itemId = $(this).data("id");
                
                // Send AJAX request to add to cart
                $.ajax({
                    url: "add_to_cart.php",
                    method: "POST",
                    data: { item_id: itemId },
                    success: function(response) {
                        // Update the cart notification 
                        $("#cart-message").html(response);
                    }
                });
            });
        });
    </script>

</head>

<header>
<nav class="navbar">
           <div class="logo">
               <img src="images/zalogo.jpg" alt="Logo">
           </div>
           <ul class="nav-links">
               <li><a href="index.html">Login</a></li>
               <li><a href="lighthouses.php">Lighthouses</a></li>
               <li><a href="events.php">Events</a></li>
               <li><a href="merchandise.php">Merchandise</a></li>
               <li><a href="cart.php">Shopping Cart</a></li>
           </ul>
       </nav>


</div>
    </header>
    <body>
    
    <main>
        <h1>Merchandise</h1>
        
        <!-- Cart Update Message -->
        <div id="cart-message"></div>

        <div class="merchandise-list">
            <?php
            
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

            // Fetch all merchandise
            $sql = "SELECT item_id, name, description, price, stock_quantity FROM merchandise";
            $result = $conn->query($sql);

            // Display merchandise
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='merch-item'>
                        
                        <h3>" . $row['name'] . "</h3>
                        <p>" . $row['description'] . "</p>
                        <p>Price: $" . number_format($row['price'], 2) . "</p>
                        <p>Stock: " . $row['stock_quantity'] . "</p>
                        <button class='add-to-cart-btn' data-id='" . $row['item_id'] . "'>Add to Cart</button>
                    </div>";
                }
            } else {
                echo "<p>No merchandise available.</p>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy;  2024 Lighthouse Enthusiasts</p>
    </footer>

</body>
</html>
