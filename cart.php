<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/navstyles.css">
    <link rel="stylesheet" href="css/cartstyles.css">

</head>
<body>

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
    </header>

    <main class="shopping-cart-container">
        <h1>Your Shopping Cart</h1>

        <?php
        // Initialize $total to ensure no "undefined variable" errors
        $total = 0;

        if (!empty($_SESSION['cart'])) {
            echo "<div class='cart-item-container'>";
            
            //calculate the total
            foreach ($_SESSION['cart'] as $id => $item) {
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal; 

                echo "
                <div class='cart-item'>
                    <div class='cart-item-details'>
                        <h4>" . htmlspecialchars($item['name']) . "</h4>
                        <p class='price'>$" . number_format($item['price'], 2) . "</p>
                        <p>Quantity: " . htmlspecialchars($item['quantity']) . "</p>
                    </div>
                    <div class='cart-item-actions'>
                        <p class='total'>$" . number_format($itemTotal, 2) . "</p>
                        <a href='update_cart.php?action=remove&id=" . urlencode($id) . "'><button>Remove</button></a>
                    </div>
                </div>";
            }

            // Display the total cost
            echo "
            <div class='cart-total'>
                <strong>Total: $" . number_format($total, 2) . "</strong>
            </div>";
            echo "</div>"; // End of cart-item-container

        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy;  2024 Lighthouse Enthusiasts</p>
    </footer>

</body>
</html>
